<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManualController extends Controller {

    public function create(Request $request): View
    {
        $attributes = $request->validate([
            'title' => ['required']
        ]);

        return view('manual.create', ['title' => $attributes['title']]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'title'         => ['required'],
            'logo'          => ['nullable'],
            'banner'        => ['nullable'],
            'description'   => ['nullable'],
            'tags'          => ['array'],
            'tags.*'        => ['required', 'string'],
            'manual_status' => ['required'],
        ]);

        $manual = Manual::create([
            'user_id'       => auth()->id(),
            'title'         => $request->title,
            'logo'          => $request->logo,
            'banner'        => $request->banner,
            'description'   => $request->description,
            'manual_status' => $request->manual_status,

        ]);

        foreach ($request->tags as $tag) {
            $manual->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
        }

        return redirect()->route('home')->with('success', 'تم انشاء الكتيب بتجاح، انتقل للوحة التحكم لاضافات الارشادات الخاصة بك الى الكتيب.');
    }
}
