<?php

use App\Http\Controllers\RolesAndPermissionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Users\Index as UserIndex;
use App\Livewire\Users\Create as UserCreate;
use App\Livewire\Users\Edit as UserEdit;

use App\Livewire\Building\Index as BuildingIndex;
use App\Livewire\Building\Create as BuildingCreate;
use App\Livewire\Building\Edit as BuildingEdit;

use App\Livewire\RolesAndPermissions\Index as RolesAndPermissionsIndex;
use App\Livewire\RolesAndPermissions\Create as RolesAndPermissionsCreate;
use App\Livewire\RolesAndPermissions\Edit as RolesAndPermissionsEdit;

use App\Livewire\Workflow\Index as WorkflowIndex;
use App\Livewire\Workflow\Create as WorkflowCreate;
use App\Livewire\Workflow\Edit as WorkflowEdit;

use App\Livewire\Form\Index as FormIndex;
use App\Livewire\Form\Create as FormCreate;
use App\Livewire\Form\Edit as FormEdit;

use App\Livewire\SupplyEquipment\Index as SupplyEquipmentIndex;
use App\Livewire\SupplyEquipment\Create as SupplyEquipmentCreate;
use App\Livewire\SupplyEquipment\Edit as SupplyEquipmentEdit;

use App\Livewire\Reports\Index as ReportIndex;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:access profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:edit profile');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('permission:edit profile');

    Route::middleware('permission:access users')->group(function () {
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/users/create', UserCreate::class)->name('users.create');
        Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');
    });

    Route::middleware('permission:access buildings')->group(function () {
        Route::get('/buildings', BuildingIndex::class)->name('buildings.index');
        Route::get('/buildings/create', BuildingCreate::class)->name('buildings.create');
        Route::get('/buildings/{building}/edit', BuildingEdit::class)->name('buildings.edit');
    });

    Route::middleware('permission:access roles')->group(function () {
        Route::get('roles-and-permissions', RolesAndPermissionsIndex::class)->name('roles.permissions');
        Route::get('roles-and-permissions/create', RolesAndPermissionsCreate::class)->name('roles.permissions.create');
        Route::get('roles-and-permissions/{roleId}/edit', RolesAndPermissionsEdit::class)->name('roles.permissions.edit');
    });

    Route::middleware('permission:access workflows')->group(function () {
        Route::get('/workflows', WorkflowIndex::class)->name('workflows.index');
        Route::get('/workflows/create', WorkflowCreate::class)->name('workflows.create');
        Route::get('/workflows/{workflow}/edit', WorkflowEdit::class)->name('workflows.edit');
    });

    Route::middleware('permission:access forms')->group(function () {
        Route::get('/forms', FormIndex::class)->name('forms.index');
        Route::get('/forms/create', FormCreate::class)->name('forms.create');
        Route::get('/forms/{workflow}/edit', FormEdit::class)->name('forms.edit');
    });

    Route::middleware('permission:access supply and equipments')->group(function () {
        Route::get('/supply-and-equipments', SupplyEquipmentIndex::class)->name('supply-and-equipments.index');
        Route::get('/supply-and-equipments/create', SupplyEquipmentCreate::class)->name('supply-and-equipments.create');
        Route::get('/supply-and-equipments/{se}/edit', SupplyEquipmentEdit::class)->name('supply-and-equipments.edit');
    });

    Route::middleware('permission:access reports')->group(function () {
        Route::get('/reports', ReportIndex::class)->name('reports.index');
    });

    // // Routes for managing workflows
    // Route::middleware('permission:access workflows')->group(function () {
    //     Route::resource('workflows', WorkflowController::class);
    // });

    // // Routes for managing forms (submissions)
    // Route::middleware('permission:access forms')->group(function () {
    //     Route::resource('forms', FormController::class);
    // });
});


require __DIR__ . '/auth.php';
