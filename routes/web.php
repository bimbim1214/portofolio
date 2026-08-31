<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ContactController;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;

// ─── Public Pages ────────────────────────────────────────────────────────────

Route::get('/', function () {
    $profile               = Profile::first();
    $experiences           = Experience::orderBy('sort_order')->get();
    $homeProjects          = Project::where('show_on_home', true)->orderBy('sort_order')->get();
    $allProjectsCount      = Project::count();
    $certifications        = Certification::where('is_active', true)->orderBy('sort_order')->get();

    return view('welcome', compact('profile', 'experiences', 'homeProjects', 'allProjectsCount', 'certifications'));
})->name('home');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/projects', function () {
    $profile  = Profile::first();
    $projects = Project::orderBy('sort_order')->get();
    return view('projects', compact('projects', 'profile'));
})->name('projects');

Route::get('/download-cv', function () {
    $profile = Profile::first();
    $cvPath  = null;

    if ($profile && $profile->cv_path && file_exists(public_path($profile->cv_path))) {
        $cvPath = public_path($profile->cv_path);
    } elseif (file_exists(public_path('pdf/Bimo_Aditya_Pangestu_CV.pdf'))) {
        $cvPath = public_path('pdf/Bimo_Aditya_Pangestu_CV.pdf');
    } elseif (file_exists(base_path('pdf/Bimo_Aditya_Pangestu_CV.pdf'))) {
        $cvPath = base_path('pdf/Bimo_Aditya_Pangestu_CV.pdf');
    }

    if (!$cvPath || !file_exists($cvPath)) abort(404);

    return response()->file($cvPath, [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="Bimo_Aditya_Pangestu_CV.pdf"',
    ]);
})->name('download.cv');

// ─── Admin Auth ───────────────────────────────────────────────────────────────

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

use App\Http\Controllers\Admin\CertificationController;

// ─── Protected Admin Routes ───
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

    // Certifications
    Route::post('/admin/certification', [CertificationController::class, 'store'])->name('admin.certification.store');
    Route::put('/admin/certification/{certification}', [CertificationController::class, 'update'])->name('admin.certification.update');
    Route::delete('/admin/certification/{certification}', [CertificationController::class, 'destroy'])->name('admin.certification.destroy');
});
