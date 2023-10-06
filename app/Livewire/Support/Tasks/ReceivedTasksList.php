<?php

namespace App\Livewire\Support\Tasks;


use App\Models\Status;
use App\Models\tasks\Task;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ReceivedTasksList extends Component
{
    use WithPagination, LivewireAlert;

    #[Rule('required|numeric|exists:statuses,id')]
    public int $status_id = 1;

    public int $taskID;
    public $removedTasks = [];
    public $perPage = 10, $search = '', $task_type = '', $priority_type = '', $sortBy = 'created_at', $sortDir = 'DESC';


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->authorize('show-tasks');

        $tasks = Task::search($this->search)
            ->when($this->task_type !== '', fn($query) => $query->where('type', $this->task_type))
            ->when($this->priority_type !== '', fn($query) => $query->where('priority', $this->priority_type))
            ->orderBy($this->sortBy, $this->sortDir)
            ->with(['users', 'status'])
            ->paginate($this->perPage);

        return view('livewire.support.tasks.received-tasks-list', [
            'tasks' => $tasks,
            'statuses' => Status::where('type', 0)->get()
        ])->title('لیست تســک های دریافتی');
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
        $this->authorize('update-tasks');

        $this->validateOnly($this->status_id);
        $task = Task::findOrFail($this->taskID);

        $task->update([
            'status_id' => $this->status_id
        ]);
        $title = $task->status->title;

        $this->dispatch('hide-changeStatus');

        $message = "وضعیت تسک به $title تغییر یافت.";
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
        $this->authorize('delete-tasks');

        Task::destroy($this->taskID);
    }

    public function recycleBin()
    {
        $this->removedTasks = Task::onlyTrashed()->get();

        $this->dispatch('show-recycleBin');
    }

    public function forceDelete(int $id)
    {
        $task = Task::withTrashed()->findOrFail($id);

        $task->forceDelete();

        $this->removedTasks = Task::onlyTrashed()->get();

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
        $user = Task::withTrashed()->findOrFail($id);

        $user->restore();

        $this->removedTasks = Task::onlyTrashed()->get();

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
