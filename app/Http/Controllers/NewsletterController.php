<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Store a new newsletter subscriber.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:newsletter,email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $newsletter = Newsletter::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscriber added successfully',
            'data' => $newsletter,
        ], 201);
    }

    public function index(): Collection
    {
        return Newsletter::all();
    }
}
