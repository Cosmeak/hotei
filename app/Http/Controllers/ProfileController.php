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
        if (LemonSqueezySubscription::where('billable_id', $user->getAuthIdentifier())->get()->last() !== null) {
            $subscriptionsId = LemonSqueezySubscription::where('billable_id', $user->getAuthIdentifier())->get()->last()->getAttribute('product_id');
            $subscription = LemonSqueezyOrder::where('product_id', $subscriptionsId)->get()->last()->getAttribute('total');
            $priceInEuros = $subscription / 100;
            $formattedPrice = number_format($priceInEuros, 2, ',', '');
        }

        $courseOrders = Order::where('user_id', $user->getAuthIdentifier())->whereNotNull('course_id')->get();
        $courses = [];
        foreach ($courseOrders as $courseOrder) {
            $courseData = Course::where('id', $courseOrder->getAttribute('course_id'))->get()->first();
            $course = [$courseData->getAttribute('title'), 'Cours', 'Non commencé'];
            $courses[] = $course;
        }
        $projectOrders = Order::where('user_id', $user->getAuthIdentifier())->whereNotNull('project_id')->get();
        foreach ($projectOrders as $projectOrder) {
            $projectData = Course::where('id', $projectOrder->getAttribute('course_id'))->get()->first();
            $project = ['Title', 'Projet', 'Non commencé'];
            $courses[] = $project;
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'craftman' => $craftman,
            'history' => $orders,
            'subscription_price' => $formattedPrice ?? 0,
            'course_orders' => $courses,
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
