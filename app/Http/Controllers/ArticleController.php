<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateArticleRequest;
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


    public function store(CreateArticleRequest $request): RedirectResponse
    {

        $article = Article::create([
            'user_id'        => auth()->id(),
            'title'          => $request->title,
            'main_image'     => $request->main_image,
            'description'    => $request->description,
            'article'        => Purifier::clean($request->article),
            'article_status' => $request->article_status,
        ]);

        if ($request->tags){
            foreach ($request->tags as $tag) {
                $article->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            }
        }

        return redirect()->route('home')->with('success', 'تم انشاء المقالة بتجاح.');
    }


    public function show(Article $article) : View
    {
        $article->load('tags', 'user');

        return view('article.show', compact('article'));
    }

}
