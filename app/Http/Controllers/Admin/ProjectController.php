<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date',
            'title'        => 'required|string|max:255',
            'made_at'      => 'nullable|string|max:255',
            'url'          => 'nullable|url|max:255',
            'link_label'   => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'tags'         => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'show_on_home' => 'nullable|boolean',
        ]);

        $tags = $this->parseTags($request->tags);
        $imagePath = null;
        
        $start_year = \Carbon\Carbon::parse($request->start_date)->format('Y');
        $end_year = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('Y') : 'Present';
        $year = $start_year === $end_year || $end_year === 'Present' ? $start_year : $start_year . ' — ' . $end_year;

        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $filename  = 'project_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $imagePath = 'images/projects/' . $filename;
        }

        Project::create([
            'year'         => $year,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'title'        => $request->title,
            'made_at'      => $request->made_at,
            'url'          => $request->url,
            'link_label'   => $request->link_label,
            'description'  => $request->description,
            'tags'         => $tags,
            'image_path'   => $imagePath,
            'show_on_home' => $request->boolean('show_on_home'),
            'sort_order'   => Project::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'projects'])
            ->with('success', 'Project berhasil ditambahkan!');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date',
            'title'        => 'required|string|max:255',
            'made_at'      => 'nullable|string|max:255',
            'url'          => 'nullable|url|max:255',
            'link_label'   => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'tags'         => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'show_on_home' => 'nullable|boolean',
        ]);

        $tags = $this->parseTags($request->tags);
        
        $start_year = \Carbon\Carbon::parse($request->start_date)->format('Y');
        $end_year = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('Y') : 'Present';
        $year = $start_year === $end_year || $end_year === 'Present' ? $start_year : $start_year . ' — ' . $end_year;

        if ($request->hasFile('image')) {
            if ($project->image_path && file_exists(public_path($project->image_path))) {
                unlink(public_path($project->image_path));
            }
            $file      = $request->file('image');
            $filename  = 'project_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $project->image_path = 'images/projects/' . $filename;
        }

        $project->update([
            'year'         => $year,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'title'        => $request->title,
            'made_at'      => $request->made_at,
            'url'          => $request->url,
            'link_label'   => $request->link_label,
            'description'  => $request->description,
            'tags'         => $tags,
            'image_path'   => $project->image_path,
            'show_on_home' => $request->boolean('show_on_home'),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'projects'])
            ->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->image_path && file_exists(public_path($project->image_path))) {
            unlink(public_path($project->image_path));
        }
        $project->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'projects'])
            ->with('success', 'Project berhasil dihapus!');
    }

    private function parseTags(?string $tags): array
    {
        if (!$tags) return [];
        return array_values(array_filter(array_map('trim', explode(',', $tags))));
    }
}
