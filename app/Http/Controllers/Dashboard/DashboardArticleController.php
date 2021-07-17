<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Mews\Purifier\Facades\Purifier;

class DashboardArticleController extends Controller {

    public function index(): View
    {

        $articles = Article::where('user_id', auth()->id())->get();

        return view('dashboard.article.index', compact('articles'));
    }

    public function edit(Article $article): View
    {
        $article->load('tags');

        return view('dashboard.article.edit', compact('article'));

    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update([
            'user_id'        => auth()->id(),
            'title'          => $request->title,
            'main_image'     => $request->main_image,
            'description'    => $request->description,
            'article'        => Purifier::clean($request->article),
            'article_status' => $request->article_status,
        ]);

        if ($request->tags) {
            $article->tags()->detach();
            foreach ($request->tags as $tag) {
                $article->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            }
        }

        return redirect()->route('dashboard.article.index')->with('success', 'تم تعديل المقالة بنجاح.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->tags()->detach();
        $article->delete();

        return redirect()->back()->with('success', 'تم حذف المقالة بنجاح.');
    }
}
