<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardTutorialController extends Controller
{
    public function index(): View
    {

        $tutorials = Tutorial::where('user_id', auth()->id())->withCount('steps')->get();

        return view('tutorial.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Tutorial $tutorial): View
    {
        $tutorial->load('tags', 'steps', 'user');

        return view('tutorial.edit', compact('tutorial'));

    }


    public function update(Request $request, Tutorial $tutorial) : RedirectResponse
    {
        dd($request->all());
    }


    public function destroy(Tutorial $tutorial): RedirectResponse
    {
        $tutorial->tags()->detach();
        $tutorial->delete();

        return redirect()->back()->with('success', 'تم حذف الإرشادات بتجاح.');
    }

}
