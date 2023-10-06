<?php

namespace App\Livewire\Support\Tasks;

use App\Http\Services\File\FileService;
use App\Http\Services\Image\ImageService;
use App\Models\Media;
use App\Models\tasks\Task;
use App\Models\tasks\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class EditTask extends Component
{
    use LivewireAlert, WithFileUploads;

    public Task $task;

    #[Rule('required|min:2|max:255', as: "موضوع")]
    public $subject;
    #[Rule('required|min:2', as: "متن")]
    public $description;
    #[Rule('required|numeric|in:0,1', as: "نوع")]
    public $type;
    #[Rule('required|numeric|in:0,1,2', as: "الویت")]
    public $priority;
    #[Rule('nullable|numeric|exists:task_statuses,id', as: "وضعیت")]
    public $status_id;
    #[Rule('required|date', as: "تاریخ مهلت")]
    public $due_date;
    public $files = [];
    public $receivers = [];
    protected $validationAttributesFromOutside = [
        'files.*' => 'فایل پروژه',
        'files' => 'فایل پروژه',
        'receivers' => 'گیرندگان',
        'receivers.*' => 'گیرنده',

    ];

    public function rules()
    {
        return [
            'files' => 'nullable|array|max:3',
            'files.*' => 'nullable|distinct|file|mimes:jpeg,png,jpg,zip,pdf|max:10240',
            'receivers' => 'required|array',
            'receivers.*' => 'required|distinct|numeric|exists:users,id'
        ];
    }

    #[Rule('integer|in:1,2,3')]
    public int $formStep = 1;
    #[Rule('string', as: 'جستجو')]
    public string $searchUser = '';
    #[Rule('integer|in:0,1,2')]
    public int $user_type = 1;
    public $prevPath = '';
    public int $mediaID;


    public function mount(Task $task)
    {
        $this->prevPath = URL::previousPath();

        $this->subject = $task->subject;
        $this->description = $task->description;
        $this->type = $task->type;
        $this->priority = $task->priority;
        $this->due_date = jalaliDate($task->due_date);
        $this->receivers = $task->users()->where('is_owner', 0)->pluck('id')->toArray();
    }

    public function render()
    {
        $users = User::search($this->searchUser)->where('user_type', $this->user_type)->with('roles')->get()->except(auth()->user()->id);
        $title = "ویرایش " . $this->task->subject;
        return view('livewire.support.tasks.edit-task', [
            'users' => $users,
        ])->title($title);
    }


    public function firstStepForm()
    {
        $this->due_date = $this->dateFormat();

        $this->validate([
            'subject' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'type' => 'required|numeric|in:0,1',
            'priority' => 'required|numeric|in:0,1,2',
            'due_date' => 'required|date|after:' . now()
        ]);

        $this->formStep = 2;
    }

    public function secondStepForm()
    {
        $this->due_date = $this->dateFormat();

        if (!empty($this->errorBagExcept('files'))) {
            $this->reset('formStep');
        }
        $this->validate([
            'subject' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'type' => 'required|numeric|in:0,1',
            'priority' => 'required|numeric|in:0,1,2',
            'due_date' => 'required|date|after:' . now(),
            'files' => 'nullable|array|max:3',
            'files.*' => 'nullable|distinct|file|mimes:jpeg,png,jpg,zip,pdf|max:10240',
        ]);


        $this->formStep = 3;
    }


    protected function dateFormat()
    {
        if (Carbon::hasFormat($this->due_date, 'Y/m/d')) {
            $date = Jalalian::fromFormat('Y/m/d', $this->due_date)->toCarbon()->toDateTimeString();
        } else {
            $date = ($this->due_date === jalaliDate($this->task->due_date)) ? $this->task->due_date : $this->due_date;
        }
        return $date;
    }

    protected function uploadFiles($input_files)
    {
        $files = [];

        if ($this->task->medias->count() > 0) {
            foreach ($this->task->medias as $media) {
                array_push($images, $media->file);
            }
        }

        $length = (count($files) - 3) * -1;

        if (count($files) < 3) {
            foreach (array_slice($input_files, 0, $length) as $file) {
                $uploadedfile = $file->store('uploads/tasks/files', 'real_public');
                array_push($files, $uploadedfile);
            }
        } else {
            $error_msg = 'حداکثر ۳ فایل قابل بارگذاری است لطفا از فایل های بالا حذف کنید سپس مجددا بارگذاری کنید';
            return $error_msg;
        }

        return $files;
    }

    public function update()
    {
        $this->due_date = $this->dateFormat();

        $validated = $this->validate();
        $inputs = Arr::except($validated, ['formStep', 'searchUser', 'user_type', 'status_id']);
        $inputs['due_date'] = $this->due_date;

        // check description
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
        $inputs['description'] = str_replace(PHP_EOL, '<br/>', $inputs['description']);

        // Upload File
        if (count($inputs['files']) > 0) {
            $data = $this->uploadFiles($inputs['files']);
            if (is_string($data)) {
                $inputs['files'] = [];
                return $this->addError('form.images', $data);
            } else {
                $inputs['files'] = $data;
            }
        }

        // update Receivers
        if (count($inputs['receivers']) > 0) {
            array_push($inputs['receivers'], auth()->user()->id);

            $pivotData = array_fill(0, count($inputs['receivers']), ['is_owner' => 0]);
            $pivotData[array_search(auth()->user()->id, $inputs['receivers'])] = ['is_owner' => 1];
            $receivers = array_combine($inputs['receivers'], $pivotData);
        }

        DB::transaction(function () use ($inputs, $receivers) {
            $this->task->update(Arr::except($inputs, ['files', 'receivers']));

            foreach ($inputs['files'] as $file) {
                Media::updateOrCreate(['file' => $file], [
                    'file' => $file,
                    'mediable_id' => $this->task->id,
                    'mediable_type' => Task::class
                ]);
            }

            $this->task->users()->sync($receivers);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '3500',
            'toast' => false,
            'text' => 'تسک با موفقیت ویرایش شد',
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
    public function removeMedia(ImageService $imageService, FileService $fileService)
    {

        $media = Media::findOrFail($this->mediaID);
        if (is_image($media->file)) {
            $imageService->deleteImage($media->file);
        } else {
            $fileService->deleteFile($media->file, false);
        }
        $media->delete();

        $this->alert('success', 'فایل برای همیشه حذف شد', [
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
