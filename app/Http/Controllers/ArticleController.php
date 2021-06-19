<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ArticleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $request): View
    {
        $attributes = $request->validate([
            'title' => ['required']
        ]);

        return view('article.create', ['title' => $attributes['title']]);
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'          => ['required'],
            'main_image'     => ['required'],
            'description'    => ['required'],
            'tags'           => ['array'],
            'tags.*'         => ['required', 'string'],
            'article'        => ['string'],
            'article_status' => ['required'],
        ]);

        $article = Article::create([
            'user_id'        => auth()->id(),
            'title'          => $request->title,
            'main_image'     => $request->main_image,
            'article'        => Purifier::clean($request->article),
            'article_status' => $request->article_status,
        ]);

        foreach ($request->tags as $tag) {
            $article->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
        }

        return redirect()->route('home')->with('success', 'تم انشاء المقالة بتجاح.');
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
