<?php

namespace App\Livewire\Support\Projects;

use App\Http\Services\Image\ImageService;
use App\Livewire\Forms\ProjectForm;
use App\Models\Group;
use App\Models\Media;
use App\Models\Project\Project;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class EditProject extends Component
{
    use LivewireAlert, WithFileUploads;

    public ProjectForm $form;
    public int $mediaID;
    public Project $project;
    public string $prevPath = '';

    public int $formStep = 1;

    public function mount(Project $project)
    {
        $this->prevPath = URL::previousPath();

        $this->form->title = $project->title;
        $this->form->client = $project->client;
        $this->form->priority = $project->priority;
        $this->form->price = priceFormat($project->price);
        $this->form->end_date = jalaliDate($project->end_date);
        $this->form->group_id = $project->group_id;
        $this->form->description = $project->description;
    }

    protected $validationAttributesFromOutside = [
        'form.images.*' => 'تصاویر پروژه',
        'form.images' => 'تصاویر پروژه'
    ];

    public function rules()
    {
        return [
            'form.images' => 'nullable|array|max:3',
            'form.images.*' => 'nullable|distinct|image|mimes:jpeg,png,jpg|max:4096'
        ];
    }

    public function render()
    {
        $groups = Group::with(['groupLeader'])->get();

        $title = 'ویرایش ' . $this->project->title;
        return view('livewire.support.projects.edit-project', [
            'project' => $this->project->with(['group', 'medias']),
            'groups' => $groups
        ])->title($title);
    }

    public function firstStepForm()
    {
        if (Str::contains('<script>', $this->project->description, true)) {
            $this->addError('form.description', 'از تگ اسکریپت در توضیحات نمیتوان استفاده کرد');
        }
        $this->form->price = str_replace(',', '', $this->form->price);
        $this->form->validate();

        $this->formStep = 2;
    }

    protected function dateFormat()
    {
        if (Carbon::hasFormat($this->form->end_date, 'Y/m/d')) {
            $date = Jalalian::fromFormat('Y/m/d', $this->form->end_date)->toCarbon()->toDateTimeString();
        } else {
            $date = $this->project->end_date;
        }
        return $date;
    }

    protected function uploadImages($input_images)
    {
        $images = [];

        if ($this->project->medias->count() > 0) {
            foreach ($this->project->medias as $media) {
                array_push($images, $media->file);
            }
        }

        $length = (count($images) - 3) * -1;

        if (count($images) < 3) {
            foreach (array_slice($input_images, 0, $length) as $image) {
                $uploadedImage = $image->store('uploads/project/images', 'real_public');
                array_push($images, $uploadedImage);
            }
        } else {
            $error_msg = 'حداکثر ۳ فایل قابل بارگذاری است لطفا از تصاویر بالا حذف کنید سپس مجددا بارگذاری کنید';
            return $error_msg;
        }

        return $images;
    }

    public function update(ImageService $imageService)
    {
        if (!empty($this->errorBagExcept('form.images'))) {
            $this->reset('formStep');
        }

        $this->form->validate();
        $inputs = $this->form->all();

        $inputs['end_date'] = $this->dateFormat();

        if (str_contains('<script>', $inputs['description'])) {
            $this->addError('form.description', 'از تگ اسکریپت در توضیحات نمیتوان استفاده کرد');
        }

        if ($inputs['logo']) {
            !empty($this->project->logo) ? $imageService->deleteImage($this->project->logo) : null;

            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR . 'logo');

            $logo = $imageService->save($inputs['logo']);

            if (!$logo) {
                $this->alert('error', 'در بارگذاری تصویر خطا رخ داده است لطفا دوباره تلاش کنید', [
                    'position' => 'bottom-start',
                    'customClass' => [
                        'title' => 'text-white',
                        'popup' => 'bg-danger',
                    ],
                    'timerProgressBar' => true,
                    'timer' => '4000',
                    'toast' => true,
                ]);
            }
            $inputs['logo'] = $logo;
        } else {
            $inputs['logo'] = $this->project->logo;
        }
        if (count($inputs['images']) > 0) {
            $data = $this->uploadImages($inputs['images']);
            if (is_string($data)) {
                $inputs['images'] = [];
                return $this->addError('form.images', $data);
            } else {
                $inputs['images'] = $data;
            }
        }
        DB::transaction(function () use ($inputs) {
            $this->project->update(Arr::except($inputs, ['images']));

            foreach ($inputs['images'] as $image) {
                Media::updateOrCreate(['file' => $image], [
                    'file' => $image,
                    'mediable_id' => $this->project->id,
                    'mediable_type' => Project::class
                ]);
            }
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '3500',
            'toast' => false,
            'text' => 'پروژه با موفقیت ویرایش شد',
        ]);

        $this->redirect($this->prevPath);
    }


    public function showConfirmDelete($id)
    {
        $this->mediaID = $id;

        $this->alert('question', 'آیا از انجام عملیات مطمئن هستید؟', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'برای همیشه حذف شود',
            'showCancelButton' => true,
            'reverseButtons' => true,
            'cancelButtonText' => 'خیر, دستم خورد',
        ]);
    }

    #[On('confirmed')]
    public function removeMedia(ImageService $imageService)
    {
        $media = Media::findOrFail($this->mediaID);
        $imageService->deleteImage($media->file);

        $media->delete();

        $this->alert('success', 'تصویر برای همیشه حذف شد', [
            'position' => 'bottom-start',
            'timer' => '4000',
            'customClass' => [
                'title' => 'text-white',
                'popup' => 'bg-success',
            ],
            'timerProgressBar' => true,
            'toast' => true,
        ]);
    }
}
