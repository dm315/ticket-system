<section>

    @can('show-admin-dashboard')
        <livewire:support.dashboard.admin-dashboard/>
    @else
        <livewire:support.dashboard.user-dashboard/>
    @endcan

</section>
