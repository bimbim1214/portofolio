<?php

use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\CvFileController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\AdminAuth;
use App\Models\Certification;
use App\Models\CvFile;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// ─── Public Pages ────────────────────────────────────────────────────────────

Route::get('/', function () {
    $profile = Profile::first();
    $experiences = Experience::orderBy('sort_order')->get();
    $homeProjects = Project::where('show_on_home', true)->orderBy('sort_order')->get();
    $allProjectsCount = Project::count();
    $certifications = Certification::where('is_active', true)->orderBy('sort_order')->get();
    $cvFile = CvFile::getCurrent();

    return view('welcome', compact('profile', 'experiences', 'homeProjects', 'allProjectsCount', 'certifications', 'cvFile'));
})->name('home');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/projects', function () {
    $profile = Profile::first();
    $projects = Project::orderBy('sort_order')->get();

    return view('projects', compact('projects', 'profile'));
})->name('projects');

/**
 * Serve CV aktif dari tabel cv_files.
 * Fallback ke file bawaan jika tabel kosong.
 */
Route::get('/download-cv', function () {
    $cvFile = CvFile::getCurrent();
    $cvPath = null;

    if ($cvFile && file_exists(public_path($cvFile->file_path))) {
        $cvPath = public_path($cvFile->file_path);
        $downloadName = Str::slug(pathinfo($cvFile->original_name, PATHINFO_FILENAME), '_').'.pdf';
    } elseif (file_exists(public_path('pdf/Bimo_Aditya_Pangestu_CV.pdf'))) {
        $cvPath = public_path('pdf/Bimo_Aditya_Pangestu_CV.pdf');
        $downloadName = 'Bimo_Aditya_Pangestu_CV.pdf';
    } elseif (file_exists(base_path('pdf/Bimo_Aditya_Pangestu_CV.pdf'))) {
        $cvPath = base_path('pdf/Bimo_Aditya_Pangestu_CV.pdf');
        $downloadName = 'Bimo_Aditya_Pangestu_CV.pdf';
    }

    if (! $cvPath || ! file_exists($cvPath)) {
        abort(404, 'CV file not found.');
    }

    return response()->file($cvPath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.$downloadName.'"',
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Sun, 02 Jan 1990 00:00:00 GMT',
    ]);
})->name('download.cv');

// ─── Admin Auth ───────────────────────────────────────────────────────────────

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// ─── Protected Admin Routes ───────────────────────────────────────────────────
Route::middleware(AdminAuth::class)->group(function () {

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

    // CV Manager
    Route::post('/admin/cv', [CvFileController::class, 'store'])->name('admin.cv.store');
    Route::delete('/admin/cv', [CvFileController::class, 'destroy'])->name('admin.cv.destroy');
});
