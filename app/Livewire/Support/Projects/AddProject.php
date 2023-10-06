<?php

namespace App\Livewire\Support\Projects;

use App\Http\Services\Image\ImageService;
use App\Livewire\Forms\ProjectForm;
use App\Models\Group;
use App\Models\Media;
use App\Models\Project\Project;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class AddProject extends Component
{
    use LivewireAlert, WithFileUploads;

    public ProjectForm $form;
    public int $formStep = 1;

    protected $validationAttributesFromOutside = [
        'form.images.*' => 'تصاویر پروژه',
        'form.images' => 'تصاویر پروژه'
    ];

    public function rules()
    {
        return [
            'form.images' => 'nullable|array|size:3',
            'form.images.*' => 'nullable|distinct|image|mimes:jpeg,png,jpg|max:4096'
        ];
    }


    public function render()
    {
        $groups = Group::with('groupLeader')->get();
        return view('livewire.support.projects.add-project', [
            'groups' => $groups
        ])->title('تعریف پروژه جدید');
    }

    public function firstStepForm()
    {
        $this->form->price = str_replace(',', '', $this->form->price);
        $this->form->validate();

        $this->formStep = 2;
    }

    public function store(ImageService $imageService)
    {
        if (!empty($this->errorBagExcept('form.images'))) {
            $this->reset('formStep');
        }

        $this->form->validate();

        $inputs = $this->form->all();
        $inputs['end_date'] = Jalalian::fromFormat('Y/m/d', $this->form->end_date)->toCarbon()->toDateTimeString();
        if (str_contains('<script>', $inputs['description'])) {
            $this->alert('error', 'از تگ اسکریپت در توضیحات نمیتوان استفاده کرد', [
                'position' => 'bottom-start',
                'timer' => '4000',
                'customClass' => [
                    'title' => 'text-white',
                    'popup' => 'bg-danger',
                ],
                'timerProgressBar' => true,
                'toast' => true,
            ]);
        }
        if ($inputs['logo']) {
            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR . 'logo');
            $logo = $imageService->save($inputs['logo']);

            if ($logo == false) {
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
        }
        if (count($inputs['images']) > 0) {
            $images = [];
            foreach (array_slice($this->form->images, 0, 3) as $image) {
                $uploadedImage = $image->store('uploads/project/images', 'real_public');
                array_push($images, $uploadedImage);
            }
            $inputs['images'] = $images;
        }
        DB::transaction(function () use ($inputs) {
            $project = Project::create(Arr::except($inputs, ['images']));

            foreach ($inputs['images'] as $image) {
                Media::create([
                    'file' => $image,
                    'mediable_id' => $project->id,
                    'mediable_type' => Project::class
                ]);
            }
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '3500',
            'toast' => false,
            'text' => 'پروژه جدید با موفقیت تعریف شد',
        ]);

        $this->redirectRoute('dashboard.projects.index');
    }
}
