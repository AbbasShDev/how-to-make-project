<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tutorial\CreateTutorialRequest;
use App\Models\Tag;
use App\Models\Tutorial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Mews\Purifier\Facades\Purifier;

class TutorialController extends Controller {

    public function create(Request $request): View
    {
        $attributes = $request->validate([
            'title' => ['required']
        ]);

        return view('tutorial.create', ['title' => $attributes['title']]);
    }


    public function store(CreateTutorialRequest $request): RedirectResponse
    {

        $Tutorial = Tutorial::create([
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
            $Tutorial->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
        }

        foreach ($request->steps as $step) {
            $Tutorial->steps()->create([
                'order'       => $step['step_order'],
                'title'       => $step['step_title'],
                'content'     => Purifier::clean($step['step_content']),
                'images'      => $step['step_images'] ?? null,
                'tutorial_id' => $Tutorial->id
            ]);
        }

        return redirect()->route('home')->with('success', 'تم انشاء الإرشادات بتجاح.');
    }


    public function show(Tutorial $tutorial): View
    {
        $tutorial->load('tags', 'steps', 'user');

        return view('tutorial.show', compact('tutorial'));

    }
}
