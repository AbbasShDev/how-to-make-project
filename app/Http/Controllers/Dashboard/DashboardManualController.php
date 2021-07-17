<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Manual;
use App\Models\Tutorial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardManualController extends Controller
{
    public function index(): View
    {

        $manuals = Manual::where('user_id', auth()->id())->get();

        return view('dashboard.manual.index', compact('manuals'));
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

    public function edit(Manual $manual): View
    {
        $manual->load('tags');

        $tutorials = Tutorial::select('title', 'id as id')->where('user_id', auth()->id())->get();

        return view('dashboard.manual.edit', compact('manual', 'tutorials'));

    }

    public function update(Request $request, Manual $manual): RedirectResponse
    {
        dd($request->all());
    }

    public function destroy(Manual $manual): RedirectResponse
    {
        $manual->tags()->detach();
        $manual->delete();


        return redirect()->back()->with('success', 'تم حذف الكتيب بنجاح.');
    }
}
