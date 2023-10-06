<?php

use App\Http\Controllers\UserController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Support\Dashboard\Index;
use App\Livewire\Support\Group\AddGroup;
use App\Livewire\Support\Group\GroupsList;
use App\Livewire\Support\Group\OurGroupList;
use App\Livewire\Support\Permissions\PermissionList;
use App\Livewire\Support\Profile\EditProfile;
use App\Livewire\Support\Projects\AddProject;
use App\Livewire\Support\Projects\EditProject;
use App\Livewire\Support\Projects\MyProjectsList;
use App\Livewire\Support\Projects\ProjectsList;
use App\Livewire\Support\Roles\RolesList;
use App\Livewire\Support\Settings\SiteLogs;
use App\Livewire\Support\Settings\SiteSetting;
use App\Livewire\Support\Tasks\AddTask;
use App\Livewire\Support\Tasks\EditTask;
use App\Livewire\Support\Tasks\ReceivedTasksList;
use App\Livewire\Support\Tasks\SentTasksList;
use App\Livewire\Support\Users\AddUser;
use App\Livewire\Support\Users\EditUser;
use App\Livewire\Support\Users\UsersList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('dashboard.home');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('/', Index::class)->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {
//        Route::get('/my-profile', UsersList::class)->name('index');
        Route::get('/edit-profile/{user}', EditProfile::class)->name('edit-profile');
    });

    //! Users Route::
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', UsersList::class)->name('index');
        Route::get('/add', AddUser::class)->name('add');
        Route::get('/edit/{user}', EditUser::class)->name('edit');
    });
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('/', GroupsList::class)->name('index');
        Route::get('/my-groups', OurGroupList::class)->name('my-groups');
        Route::get('/add', AddGroup::class)->name('add');
    });

    //! Tasks Routes::
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/received', ReceivedTasksList::class)->name('received');
        Route::get('/sent', SentTasksList::class)->name('sent');
        Route::get('/add', AddTask::class)->name('add');
        Route::get('/edit/{task}', EditTask::class)->name('edit');
    });

    //! Project Routes::
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', ProjectsList::class)->name('index');
        Route::get('/my-projects', MyProjectsList::class)->name('my-projects');
        Route::get('/add', AddProject::class)->name('add');
        Route::get('/edit/{project}', EditProject::class)->name('edit');
    });

    //! Roles & Permission's Routes::
    Route::get('roles', RolesList::class)->name('roles.index');
    Route::get('permissions', PermissionList::class)->name('permissions.index');

    //! settings Routes::
    Route::get('settings/logs', SiteLogs::class)->name('settings.logs');

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('auth')->middleware(['guest'])->name('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

