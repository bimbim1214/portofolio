<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issuer_full' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'issued_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        Certification::create([
            'title' => $request->title,
            'issuer' => $request->issuer,
            'issuer_full' => $request->issuer_full,
            'icon' => $request->icon ?? 'verified_user',
            'credential_id' => $request->credential_id,
            'credential_url' => $request->credential_url,
            'issued_date' => $request->issued_date,
            'expiry_date' => $request->expiry_date,
            'sort_order' => Certification::max('sort_order') + 1,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'certifications'])
            ->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issuer_full' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'issued_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $certification->update([
            'title' => $request->title,
            'issuer' => $request->issuer,
            'issuer_full' => $request->issuer_full,
            'icon' => $request->icon ?? 'verified_user',
            'credential_id' => $request->credential_id,
            'credential_url' => $request->credential_url,
            'issued_date' => $request->issued_date,
            'expiry_date' => $request->expiry_date,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'certifications'])
            ->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'certifications'])
            ->with('success', 'Sertifikat berhasil dihapus!');
    }
}
