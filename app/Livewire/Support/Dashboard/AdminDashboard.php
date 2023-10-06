<?php

namespace App\Livewire\Support\Dashboard;

use App\Models\Project\Project;
use App\Models\tasks\Task;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.support.dashboard.admin-dashboard', [
            'allTasksCount' => Task::count(),
            'tasksReadCount' => Task::where('status_id', 2)->count(),
            'archivedTasksCount' => Task::where('status_id', 4)->count(),
            'pendingTasks' => Task::where('status_id', 1)->paginate(7),
            'projectsCount' => Project::count(),
            'completedProjectsCount' => Project::where('status_id', 6)->count(),
            'onGoingProjects' => Project::where('status_id', 5)->paginate(7),
            'expiredProjectsCount' => Project::where('end_date', '<', now())->count()
        ]);
    }
}
