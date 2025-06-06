<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;

class OrderService
{
    public function setCourseOrder($userId, $courseId): void
    {
        $user = User::query()->find($userId);
        $course = Course::query()->find($courseId);

        $userCredits = $user->getAttribute('credits');
        $courseCost = $course->getAttribute('cost');

        if (($userCredits - $courseCost) >= 0) {
            Order::query()->create([
                'user_id' => $userId,
                'course_id' => $courseId,
            ]);

            $user->setAttribute('credits', $userCredits - $courseCost)->save();
        }
    }

    public function setProjectOrder($userId, $projectId): void
    {
        $user = User::query()->find($userId);
        $project = Project::query()->find($projectId);

        $userCredits = $user->getAttribute('credits');
        $projectCost = 0;
        foreach ($project->courses()->get() as $course) {
            $projectCost += $course->getAttribute('cost');
        }

        if (($userCredits - $projectCost) >= 0) {
            Order::query()->create([
                'user_id' => $userId,
                'project_id' => $projectId,
            ]);
            $user->setAttribute('credits', $userCredits - $projectCost)->save();
        }
    }
}
