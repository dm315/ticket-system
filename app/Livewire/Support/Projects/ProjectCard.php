<?php

namespace App\Livewire\Support\Projects;

use App\Http\Services\Image\ImageService;
use App\Models\Project\Project;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectCard extends Component
{

    use LivewireAlert;

    public Project $project;

    #[On('card-updated')]
    public function render()
    {
        return view('livewire.support.projects.project-card');
    }

    public function showConfirmDelete()
    {
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
    public function removeProject(ImageService $imageService)
    {
        if (!empty($this->project->logo)) {
            $imageService->deleteImage($this->project->logo);
        }
        foreach ($this->project->medias as $media) {
            $imageService->deleteImage($media->file);
            $media->delete();
        }
        $this->project->forceDelete();

        $this->dispatch('project_updated');
    }
}
