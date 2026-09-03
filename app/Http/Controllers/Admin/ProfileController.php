<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'about_1' => 'nullable|string',
            'about_2' => 'nullable|string',
            'about_3' => 'nullable|string',
            'short_bio' => 'nullable|string',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $profile = Profile::firstOrNew([]);
        $profile->fill($request->only([
            'name', 'headline', 'about_1', 'about_2', 'about_3', 'short_bio',
            'github_url', 'linkedin_url', 'email', 'whatsapp',
        ]));

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo from public disk if not default
            if ($profile->photo_path && file_exists(public_path($profile->photo_path)) && $profile->photo_path !== 'images/fotoshot.png') {
                @unlink(public_path($profile->photo_path));
            }
            $file = $request->file('photo');
            $filename = 'photo_'.time().'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('images');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $profile->photo_path = 'images/'.$filename;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            if ($profile->cv_path && file_exists(public_path($profile->cv_path))) {
                @unlink(public_path($profile->cv_path));
            }
            $file = $request->file('cv');
            $filename = 'cv_'.time().'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('pdf');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $profile->cv_path = 'pdf/'.$filename;
        }

        $profile->save();

        return redirect()->route('admin.dashboard', ['tab' => 'profile'])
            ->with('success', 'Profil dan CV berhasil diperbarui!');
    }
}
