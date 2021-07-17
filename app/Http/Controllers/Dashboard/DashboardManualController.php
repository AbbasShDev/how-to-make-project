<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manual\UpdateManualRequest;
use App\Models\Manual;
use App\Models\Tag;
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

//    public function any()
//    {
//        $manual = Manual::create([
//            'user_id'       => auth()->id(),
//            'title'         => $request->title,
//            'logo'          => $request->logo,
//            'banner'        => $request->banner,
//            'description'   => $request->description,
//            'manual_status' => $request->manual_status,
//
//        ]);
//
//        if ($request->tags){
//            foreach ($request->tags as $tag) {
//                $manual->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
//            }
//        }
//
//        return redirect()->route('home')->with('success', 'تم انشاء الكتيب بتجاح، انتقل للوحة التحكم لاضافات الارشادات الخاصة بك الى الكتيب.');
//    }

    public function update(UpdateManualRequest $request, Manual $manual): RedirectResponse
    {
        $manual->update([
            'user_id'       => auth()->id(),
            'title'         => $request->title,
            'logo'          => $request->logo,
            'banner'        => $request->banner,
            'description'   => $request->description,
            'manual_status' => $request->manual_status,

        ]);

        if ($request->tags) {
            $manual->tags()->detach();
            foreach ($request->tags as $tag) {
                $manual->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            }
        }

        if ($request->tutorials) {

            foreach ($request->tutorials as $tutorial) {
                $manual->tutorials()->attach($tutorial['tutorial_id'],['tutorial_order' => $tutorial['tutorial_order']]);
            }
        }

        return redirect()->route('dashboard.manual.index')->with('success', 'تم تعديل الكتيب بنجاح.');

    }

    public function destroy(Manual $manual): RedirectResponse
    {
        $manual->tags()->detach();
        $manual->tutorials()->detach();
        $manual->delete();

        return redirect()->back()->with('success', 'تم حذف الكتيب بنجاح.');
    }
}
