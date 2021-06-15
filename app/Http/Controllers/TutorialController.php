<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Mews\Purifier\Facades\Purifier;

class TutorialController extends Controller {

    public function index()
    {

    }


    public function create(Request $request): View
    {
        $attributes = $request->validate([
            'title' => ['required']
        ]);

        return view('tutorial.create', ['title' => $attributes['title']]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'title'                => ['required'],
            'main_image'           => ['required'],
            'difficulty'           => ['required'],
            'duration'             => ['required'],
            'duration_measurement' => ['required'],
            'tags'                 => ['array'],
            'tags.*'               => ['required', 'string'],
            'area'                 => ['required'],
            'introduction'         => ['string'],
            'introduction_video'   => ['string'],
            'steps'                => ['array'],
            'steps.*.step_images'  => ['nullable'],
            'steps.*.step_order'   => ['required', 'numeric'],
            'steps.*.step_title'   => ['required', 'string'],
            'steps.*.step_content' => ['required', 'string'],
            'tutorial_status'      => ['required'],
        ]);


        $Tutorial = Tutorial::create([
            'user_id'              => 1,
            'title'                => $request->title,
            'main_image'           => $request->main_image,
            'difficulty'           => $request->difficulty,
            'duration'             => $request->duration,
            'duration_measurement' => $request->duration_measurement,
            'area'                 => $request->area,
            'introduction'         => Purifier::clean($request->introduction),
            'introduction_video'   => $request->introduction_video,
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
                'images'      => json_encode($step['step_images'] ?? null),
                'tutorial_id' => $Tutorial->id
            ]);
        }

        return redirect()->route('home')->with('success', 'تم انشاء الإرشادات بتجاح.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
