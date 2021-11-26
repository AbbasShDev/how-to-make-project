<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manual\CreateManualRequest;
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

    public function store(CreateManualRequest $request): RedirectResponse
    {

        $manual = Manual::create([
            'user_id'       => auth()->id(),
            'title'         => $request->title,
            'logo'          => $request->logo,
            'banner'        => $request->banner,
            'description'   => $request->description,
            'manual_status' => $request->manual_status,

        ]);

        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $manual->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            }
        }

        $routeToManual = "<a style='color: #18603a;font-weight: 700;' href='" . route('dashboard.manual.edit', $manual) . "'>$manual->title</a>";

        return redirect()->route('home')->with('success', "تم انشاء الكتيب بنجاح، انتقل للوحة التحكم لاضافات الارشادات الخاصة بك الى الكتيب ({$routeToManual}).");
    }

    public function show(Manual $manual): View
    {
        if ($manual->isPrivate() && $manual->user_id !== auth()->id()) {
            abort(401);
        }

        $manual->load('tags', 'user', "tutorials");

        return view('manual.show', compact('manual'));
    }
}
