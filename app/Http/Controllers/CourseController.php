<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Craftman;
use App\Models\Project;
use Illuminate\Support\Facades\Artisan;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Course/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): \Inertia\Response
    {
        $craftman = $this->getCraftmanWithUser($course->craftman_id);
        $project = $this->getProject($course);
        $materials = $this->prepareMaterials($course);

        return Inertia::render('Course/Show', [
            'course' => $this->prepareCourseData($course, $materials),
            'craftman' => $this->prepareCraftmanData($craftman),
            'project' => $this->prepareProjectData($project),
        ]);
    }

    /**
     * Get Artisan by the user.
     */
    private function getCraftmanWithUser(string $craftmanId)
    {
        return Craftman::with('user')->findOrFail($craftmanId);
    }

    /**
     * Get Project
     */
    private function getProject(Course $course)
    {
        return Project::where('craftman_id', $course->craftman_id)
            ->where('craftsmanship_id', $course->craftsmanship_id)
            ->first();
    }

    /**
     * Prepare materials
     */
    private function prepareMaterials(Course $course): \Illuminate\Support\Collection
    {
        return collect($course->materials)->map(function ($material, $index) {
            return [
                'id' => $index + 1,
                'image' => "/images/materials/{$material}.jpg",
                'quantity' => rand(1, 5),
                'content' => ucfirst($material),
                'url' => "https://example.com/materials/{$material}",
            ];
        });
    }

    /**
     * Prepare course data.
     */
    private function prepareCourseData(Course $course, $materials): array
    {
        return [
            'title' => $course->title,
            'description' => $course->description,
            'duration' => $course->duration,
            'materials' => $materials,
        ];
    }

    /**
     * Prepare artisan data
     */
    private function prepareCraftmanData($craftman): ?array
    {
        return $craftman ? [
            'avatar' => $craftman->avatar,
            'firstname' => $craftman->user->firstname,
            'lastname' => $craftman->user->lastname,
            'description' => $craftman->description,
            'categories' => $craftman->categories ?? [],
        ] : null;
    }

    /**
     * Prepare project data
     */
    private function prepareProjectData($project): ?array
    {
        return $project ? [
            'title' => $project->title ?? 'Untitled Project',
            'description' => $project->description ?? 'No description available',
        ] : null;
    }
}
