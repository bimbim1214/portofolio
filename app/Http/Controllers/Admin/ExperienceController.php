<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'company_url' => 'nullable|url|max:255',
            'description' => 'required|string',
            'tags'        => 'nullable|string',
        ]);

        $tags = $this->parseTags($request->tags);
        
        $start = \Carbon\Carbon::parse($request->start_date)->format('M Y');
        $end = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('M Y') : 'Present';
        $date_range = $start . ' — ' . $end;

        Experience::create([
            'date_range'  => $date_range,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'title'       => $request->title,
            'company'     => $request->company,
            'company_url' => $request->company_url,
            'description' => $request->description,
            'tags'        => $tags,
            'sort_order'  => Experience::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'experience'])
            ->with('success', 'Experience berhasil ditambahkan!');
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'company_url' => 'nullable|url|max:255',
            'description' => 'required|string',
            'tags'        => 'nullable|string',
        ]);

        $tags = $this->parseTags($request->tags);
        
        $start = \Carbon\Carbon::parse($request->start_date)->format('M Y');
        $end = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('M Y') : 'Present';
        $date_range = $start . ' — ' . $end;

        $experience->update([
            'date_range'  => $date_range,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'title'       => $request->title,
            'company'     => $request->company,
            'company_url' => $request->company_url,
            'description' => $request->description,
            'tags'        => $tags,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'experience'])
            ->with('success', 'Experience berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'experience'])
            ->with('success', 'Experience berhasil dihapus!');
    }

    private function parseTags(?string $tags): array
    {
        if (!$tags) return [];
        return array_values(array_filter(array_map('trim', explode(',', $tags))));
    }
}
