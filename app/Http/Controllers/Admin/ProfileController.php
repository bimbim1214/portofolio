<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'headline'     => 'required|string|max:255',
            'about_1'      => 'nullable|string',
            'about_2'      => 'nullable|string',
            'about_3'      => 'nullable|string',
            'short_bio'    => 'nullable|string',
            'github_url'   => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'email'        => 'nullable|email|max:255',
            'whatsapp'     => 'nullable|string|max:50',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv'           => 'nullable|mimes:pdf|max:10240',
        ]);

        $profile = Profile::firstOrNew([]);
        $profile->fill($request->only([
            'name', 'headline', 'about_1', 'about_2', 'about_3', 'short_bio',
            'github_url', 'linkedin_url', 'email', 'whatsapp',
        ]));

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo from public disk
            if ($profile->photo_path && file_exists(public_path($profile->photo_path))) {
                unlink(public_path($profile->photo_path));
            }
            $file = $request->file('photo');
            $filename = 'fotoshot.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $profile->photo_path = 'images/' . $filename;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            if ($profile->cv_path && file_exists(public_path($profile->cv_path))) {
                unlink(public_path($profile->cv_path));
            }
            $file = $request->file('cv');
            $filename = 'cv_' . time() . '.pdf';
            $file->move(public_path('pdf'), $filename);
            $profile->cv_path = 'pdf/' . $filename;
        }

        $profile->save();

        return redirect()->route('admin.dashboard', ['tab' => 'profile'])
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
