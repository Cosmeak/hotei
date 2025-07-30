<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Course;
use App\Models\LemonSqueezyOrder;
use App\Models\LemonSqueezySubscription;
use App\Models\Order;
use App\Services\LemonSqueezyService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(protected LemonSqueezyService $lemonSqueezyService) {}

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = Auth::user();
        $craftman = $user->craftman;

        $orders = LemonSqueezyOrder::where('billable_id', $user->getAuthIdentifier())
            ->where('billable_type', get_class($user))
            ->get()
            ->map(fn ($order) => [
                'name' => $order->product_name ?? 'Commande #'.$order->order_number,
                'date' => $order->created_at->format('d/m/y'),
                'price' => number_format($order->total / 100, 2).'€',
            ]);

        $lastSubscription = LemonSqueezySubscription::where('billable_id', $user->getAuthIdentifier())
            ->latest()
            ->first();

        $formattedPrice = 0;
        if ($lastSubscription) {
            $lastOrder = LemonSqueezyOrder::where('product_id', $lastSubscription->product_id)
                ->latest()
                ->first();

            if ($lastOrder) {
                $formattedPrice = number_format($lastOrder->total / 100, 2, ',', '');
            }
        }

        $courseOrders = Order::where('user_id', $user->getAuthIdentifier())
            ->whereNotNull('course_id')
            ->get();

        $projectOrders = Order::where('user_id', $user->getAuthIdentifier())
            ->whereNotNull('project_id')
            ->get();

        $courseIds = $courseOrders->pluck('course_id')->merge($projectOrders->pluck('project_id'))->unique();

        $allCourses = Course::whereIn('id', $courseIds)->get()->keyBy('id');

        $courses = [];

        foreach ($courseOrders as $order) {
            $courseId = $order->course_id;
            if (isset($allCourses[$courseId])) {
                $courses[] = [$allCourses[$courseId]->title, 'Cours', 'Non commencé'];
            }
        }

        foreach ($projectOrders as $order) {
            $projectId = $order->project_id;
            if (isset($allCourses[$projectId])) {
                $courses[] = [$allCourses[$projectId]->title, 'Projet', 'Non commencé'];
            }
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'craftman' => $craftman,
            'history' => $orders,
            'subscriptionPrice' => $formattedPrice,
            'courseOrders' => $courses,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->craftman) {
            $user->craftman_id = null;
            $user->save();
            $user->craftman->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
