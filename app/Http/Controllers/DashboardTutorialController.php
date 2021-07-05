<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tutorial\UpdateTutorialRequest;
use App\Models\Tag;
use App\Models\Tutorial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class DashboardTutorialController extends Controller
{
    public function index(): View
    {

        $tutorials = Tutorial::where('user_id', auth()->id())->withCount('steps')->get();

        return view('tutorial.index', compact('tutorials'));
    }


    public function edit(Tutorial $tutorial): View
    {
        $tutorial->load('tags', 'steps', 'user');

        return view('tutorial.edit', compact('tutorial'));

    }


    public function update(UpdateTutorialRequest $request, Tutorial $tutorial) : RedirectResponse
    {
        $tutorial->update([
            'user_id'              => auth()->id(),
            'title'                => $request->title,
            'main_image'           => $request->main_image,
            'description'          => $request->description,
            'difficulty'           => $request->difficulty,
            'duration'             => $request->duration,
            'duration_measurement' => $request->duration_measurement,
            'area'                 => $request->area,
            'introduction'         => Purifier::clean($request->introduction),
            'introduction_video'   => $request->introduction_video ? getYoutubeId($request->introduction_video) : "",
            'tutorial_status'      => $request->tutorial_status,
        ]);


        foreach ($request->tags as $tag) {
            $tutorial->tags()->sync(Tag::firstOrCreate(['name' => $tag]));
        }

        $tutorial->steps()->delete();

        foreach ($request->steps as $step) {
            $tutorial->steps()->create([
                'order'       => $step['step_order'],
                'title'       => $step['step_title'],
                'content'     => Purifier::clean($step['step_content']),
                'images'      => $step['step_images'] ?? null,
                'tutorial_id' => $tutorial->id
            ]);
        }

        return redirect()->route('home')->with('success', 'تم تعديل الإرشادات بتجاح.');
    }


    public function destroy(Tutorial $tutorial): RedirectResponse
    {
        $tutorial->tags()->detach();
        $tutorial->delete();

        return redirect()->back()->with('success', 'تم حذف الإرشادات بتجاح.');
    }

}
