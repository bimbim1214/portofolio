<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvFile;
use Illuminate\Http\Request;

class CvFileController extends Controller
{
    /**
     * Upload CV baru.
     * Logika: hapus CV lama (file + DB), lalu simpan yang baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:20480', // maks 20 MB
        ], [
            'cv.required' => 'Pilih file CV terlebih dahulu.',
            'cv.mimes' => 'File harus berformat PDF.',
            'cv.max' => 'Ukuran file maksimal 20 MB.',
        ]);

        // 1. Hapus CV lama jika ada
        $old = CvFile::getCurrent();
        if ($old) {
            $oldPath = public_path($old->file_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
            $old->delete();
        }

        // 2. Simpan file baru ke public/pdf/
        $file = $request->file('cv');
        $filename = 'cv_'.time().'.pdf';
        $targetDir = public_path('pdf');

        if (! file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        // 3. Simpan record ke database
        CvFile::create([
            'file_path' => 'pdf/'.$filename,
            'original_name' => $file->getClientOriginalName(),
            'file_size' => filesize(public_path('pdf/'.$filename)),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'cv'])
            ->with('success', 'CV berhasil diunggah dan diperbarui!');
    }

    /**
     * Hapus CV aktif.
     */
    public function destroy()
    {
        $cv = CvFile::getCurrent();

        if ($cv) {
            $path = public_path($cv->file_path);
            if (file_exists($path)) {
                @unlink($path);
            }
            $cv->delete();
        }

        return redirect()->route('admin.dashboard', ['tab' => 'cv'])
            ->with('success', 'CV berhasil dihapus.');
    }
}
