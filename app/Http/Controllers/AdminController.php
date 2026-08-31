<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show login page
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput(['username' => $request->username]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }

    // Admin dashboard
    public function dashboard()
    {
        $profile        = Profile::first();
        $experiences    = Experience::orderBy('sort_order')->get();
        $projects       = Project::orderBy('sort_order')->get();
        $certifications = Certification::orderBy('sort_order')->get();
        $latestProjects = Project::latest()->take(3)->get();

        return view('admin.dashboard', compact('profile', 'experiences', 'projects', 'certifications', 'latestProjects'));
    }
}
