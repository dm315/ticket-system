<?php

namespace App\Livewire\Support\Projects;

use App\Models\Project\Project;
use App\Models\Status;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectsList extends Component
{
    use LivewireAlert;

    #[Rule('required|numeric|exists:statuses,id')]
    public int $status_id = 5;
    public int $perPage = 6, $projectID;
    #[Url]
    public string $search = "";

    #[On('project_updated')]
    public function render()
    {
        $this->authorize('show-projects');

        $projects = Project::search($this->search)->with(['group', 'medias', 'status'])->limit($this->perPage)->get();
        return view('livewire.support.projects.projects-list', [
            'projects' => $projects,
            'statuses' => Status::where('type', 1)->limit(3)->get()
        ]);
    }


    public function showChangeStatusModal(int $id)
    {
        $this->projectID = $id;

        $this->dispatch('show-changeStatus');
    }

    public function changeStatus()
    {
        $this->validateOnly($this->status_id);
        $project = Project::findOrFail($this->projectID);


        $project->update([
            'status_id' => $this->status_id
        ]);
        $title = $project->status->title;
        $message = "وضعیت پروژه به $title تغییر یافت.";

        $this->dispatch('card-updated');
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

}
