<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;

// ─── Public Pages ────────────────────────────────────────────────────────────

Route::get('/', function () {
    $profile          = Profile::first();
    $experiences      = Experience::orderBy('sort_order')->get();
    $homeProjects     = Project::where('show_on_home', true)->orderBy('sort_order')->get();
    $certifications   = Certification::where('is_active', true)->orderBy('sort_order')->get();

    return view('welcome', compact('profile', 'experiences', 'homeProjects', 'certifications'));
})->name('home');

Route::get('/projects', function () {
    $profile  = Profile::first();
    $projects = Project::orderBy('sort_order')->get();
    return view('projects', compact('projects', 'profile'));
})->name('projects');

Route::get('/download-cv', function () {
    $profile = Profile::first();
    $cvPath = $profile && $profile->cv_path
        ? public_path($profile->cv_path)
        : base_path('pdf/Bimo_Aditya_Pangestu_CV.pdf');

    if (!file_exists($cvPath)) abort(404);

    return response()->file($cvPath, [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="CV.pdf"',
    ]);
})->name('download.cv');

// ─── Admin Auth ───────────────────────────────────────────────────────────────

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// ─── Admin Protected Routes ───────────────────────────────────────────────────

Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Profile
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Experience
    Route::post('/admin/experience', [ExperienceController::class, 'store'])->name('admin.experience.store');
    Route::put('/admin/experience/{experience}', [ExperienceController::class, 'update'])->name('admin.experience.update');
    Route::delete('/admin/experience/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experience.destroy');

    // Projects
    Route::post('/admin/project', [ProjectController::class, 'store'])->name('admin.project.store');
    Route::put('/admin/project/{project}', [ProjectController::class, 'update'])->name('admin.project.update');
    Route::delete('/admin/project/{project}', [ProjectController::class, 'destroy'])->name('admin.project.destroy');
});
