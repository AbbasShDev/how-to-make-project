<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller {

    public function index(): View
    {
        $tutorialsCount = auth()->user()->tutorials->count();
        $articlesCount = auth()->user()->articles->count();
        $manualsCount = auth()->user()->manuals->count();

        return view('dashboard.index', compact("tutorialsCount", "articlesCount", "manualsCount"));
    }
}
