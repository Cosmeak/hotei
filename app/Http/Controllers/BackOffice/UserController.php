<?php

namespace App\Http\Controllers\BackOffice;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::query()
            ->when(request()->query('trashed') == true, function ($query) {
                $query->withTrashed();
            })
            ->when(! empty(request()->query('email')), function ($query) {
                $query->where('email', 'like', '%'.request()->query('email').'%');
            })
            ->orderBy('email')
            ->paginate(25)
            ->withQueryString();

        return Inertia::render('BackOffice/User/Index', [
            'users' => $users,
            'roles' => UserRole::cases(),
        ]);
    }

    /**
     * Update the role for a specified user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $inputs = $request->validate(['role' => ['required', 'string']]);
        $user->fill($inputs);
        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}
