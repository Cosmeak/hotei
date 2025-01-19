<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class BackOfficeController extends Controller
{
    public function dashboard(): Response
    {
        return Inertia::render('BackOffice/Dashboard');
    }
}
