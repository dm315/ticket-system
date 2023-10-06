<?php

namespace App\Livewire\Support\Tasks;

use App\Models\Media;
use App\Models\tasks\Task;
use App\Models\tasks\TaskStatus;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class AddTask extends Component
{
    use LivewireAlert, WithFileUploads;

    #[Rule('required|min:2|max:255', as: "موضوع")]
    public $subject;
    #[Rule('required|min:2', as: "متن")]
    public $description;
    #[Rule('required|numeric|in:0,1', as: "نوع")]
    public $type = 0;
    #[Rule('required|numeric|in:0,1,2', as: "الویت")]
    public $priority = 0;
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

    public function render()
    {
        $users = User::search($this->searchUser)->where('user_type', $this->user_type)->with('roles')->get()->except(auth()->user()->id);
        return view('livewire.support.tasks.add-task', [
            'users' => $users,
        ])->title('ایجاد تســک');
    }

    public function firstStepForm()
    {
        $this->validate([
            'subject' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'type' => 'required|numeric|in:0,1',
            'priority' => 'required|numeric|in:0,1,2',
            'due_date' => 'required|date'
        ]);

        $this->formStep = 2;
    }

    public function secondStepForm()
    {
        if (!empty($this->errorBagExcept('files'))) {
            $this->reset('formStep');
        }
        $this->validate([
            'subject' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'type' => 'required|numeric|in:0,1',
            'priority' => 'required|numeric|in:0,1,2',
            'due_date' => 'required|date',
            'files' => 'nullable|array|max:3',
            'files.*' => 'nullable|distinct|file|mimes:jpeg,png,jpg,zip,pdf|max:10240',
        ]);
        $this->formStep = 3;
    }


    public function store()
    {
        $validated = $this->validate();
        $inputs = Arr::except($validated, ['formStep', 'searchUser', 'user_type', 'status_id']);
        $inputs['due_date'] = Jalalian::fromFormat('Y/m/d', $inputs['due_date'])->toCarbon()->toDateTimeString();
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

        if (count($inputs['files']) > 0) {
            $files = [];
            foreach (array_slice($inputs['files'], 0, 3) as $file) {
                $uploadedFile = $file->store('uploads/tasks/files', 'real_public');
                array_push($files, $uploadedFile);
            }
            $inputs['files'] = $files;
        }

        if (count($inputs['receivers']) > 0) {
            array_push($inputs['receivers'], auth()->user()->id);

            $pivotData = array_fill(0, count($inputs['receivers']), ['is_owner' => 0]);
            $pivotData[array_search(auth()->user()->id, $inputs['receivers'])] = ['is_owner' => 1];
            $receivers = array_combine($inputs['receivers'], $pivotData);
        }


        DB::transaction(function () use ($inputs, $receivers) {
            $task = Task::create(Arr::except($inputs, ['files', 'receivers']));

            foreach ($inputs['files'] as $file) {
                Media::create([
                    'file' => $file,
                    'mediable_id' => $task->id,
                    'mediable_type' => Task::class
                ]);
            }

            $task->users()->sync($receivers);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '3500',
            'toast' => false,
            'text' => 'تسک جدید با موفقیت تعریف شد',
        ]);

        $this->redirectRoute('dashboard.tasks.sent');
    }
}
