<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            ->paginate(100)
            ->withQueryString();

        return Inertia::render('BackOffice/User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->validated();
        $user = new User($inputs);
        $user->save();

        return redirect()->route('backoffice.user.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id)
    {
        $inputs = $request->validated();
        $user->fill($inputs);
        $user->save();

        return redirect()->route('backoffice.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('backoffice.user.index');
    }
}
