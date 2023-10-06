<?php

namespace App\Livewire\Support\Tasks;

use App\Models\Status;
use App\Models\tasks\Task;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SentTasksList extends Component
{
    use LivewireAlert, WithPagination;

    #[Rule('required|numeric|exists:statuses,id')]
    public int $status_id = 1;
    public int $taskID;

    #[Url]
    public string $search = '';
    public $removedTasks = [];
    public $perPage = 10, $task_type = '', $priority_type = '', $sortBy = 'created_at', $sortDir = 'DESC', $is_owner = 1;


    public function render()
    {
        $tasks = Auth::user()->tasks()->search($this->search)
            ->where('is_owner', $this->is_owner)
            ->when($this->task_type !== '', fn($query) => $query->where('type', $this->task_type))
            ->when($this->priority_type !== '', fn($query) => $query->where('priority', $this->priority_type))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);


        $pageTitle = "لیست تسک های " . Auth::user()->fullName;
        return view('livewire.support.tasks.sent-tasks-list', [
            'tasks' => $tasks,
            'statuses' => Status::where('type', 0)->get()
        ])->title($pageTitle);
    }


    public function setSorting($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }


    public function showChangeStatusModal(int $id)
    {
        $this->taskID = $id;

        $this->dispatch('show-changeStatus');
    }

    public function changeStatus()
    {
        $this->validateOnly($this->status_id);
        $task = Task::findOrFail($this->taskID);


        if ($task->owner()->id === Auth::user()->id) {
            $this->dispatch('hide-changeStatus');
            return false;
        } else {
            $task->update([
                'status_id' => $this->status_id
            ]);
            $title = $task->status->title;
            $message = "وضعیت تسک به $title تغییر یافت.";
        }
        $this->dispatch('hide-changeStatus');
        $this->alert('success', $message, [
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

    public function showConfirmDelete($id)
    {
        $this->taskID = $id;

        $this->alert('question', 'آیا از انجام عملیات مطمئن هستید؟', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'حذف کنید',
            'showCancelButton' => true,
            'reverseButtons' => true,
            'onDismissed' => '',
            'cancelButtonText' => 'خیر, دستم خورد',
        ]);
    }

    #[On('confirmed')]
    public function removeTask()
    {
        $task = Auth::user()->tasks()->find($this->taskID);

//        check is admin or not
        $task->delete();
    }

    public function recycleBin()
    {
        $this->removedTasks = Auth::user()->tasks()->onlyTrashed()->get();

        $this->dispatch('show-recycleBin');
    }

    public function forceDelete(int $id)
    {
        $task = Auth::user()->tasks()->withTrashed()->findOrFail($id);

        dd($task);

        $task->forceDelete();

        $this->removedTasks = Auth::user()->tasks()->onlyTrashed()->get();

        $this->alert('success', 'تسک برای همیشه پاک شد', [
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

    public function restore(int $id)
    {
        $user = Auth::user()->tasks()->withTrashed()->findOrFail($id);

        $user->restore();

        $this->removedTasks = Auth::user()->tasks()->onlyTrashed()->get();

        $this->alert('success', 'تسک با موفقیت بازیابی شد', [
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
