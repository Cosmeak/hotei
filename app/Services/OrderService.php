<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use LemonSqueezy\Laravel\Checkout;

class OrderService
{
    protected LemonSqueezyService $lemonSqueezyService;

    public function __construct(LemonSqueezyService $lemonSqueezyService)
    {
        $this->lemonSqueezyService = $lemonSqueezyService;
    }

    public function buy($productId): Checkout
    {
        $user = Auth::user();

        $checkout = $user->checkout($productId);
        $userCredits = $user->getAttribute('credits');
        $newCredits = $this->lemonSqueezyService->productCredits(intval($productId));
        $user->setAttribute('credits', $userCredits + $newCredits);
        $user->save();

        return $checkout;
    }

    public function setCourseOrder(Course $course): RedirectResponse
    {
        $user = Auth::user();

        if (($user->credits - $course->cost) >= 0) {
            Order::query()->create([
                'user_id' => $user->id,
                'course_id' => $course->id,
            ]);

            $user->credits = $user->credits - $course->cost;
            $user->save();
        }

        return redirect()->route('courses.show', ['course' => $course->id]);
    }

    public function setProjectOrder(Project $project): RedirectResponse
    {
        $user = Auth::user();

        if (($user->credits - $project->cost) >= 0) {
            Order::query()->create([
                'user_id' => $user->id,
                'project_id' => $project->id,
            ]);

            $user->credits = $user->credits - $project->cost;
            $user->save();
        }

        return redirect()->route('projects.show', ['project' => $project->id]);
    }
}
