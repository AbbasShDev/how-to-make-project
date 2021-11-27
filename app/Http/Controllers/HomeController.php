<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Manual;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller {

    public function index(): View
    {
        $tutorials = Tutorial::latest()->where("tutorial_status", "public")->get();
        $articles = Article::latest()->where("article_status", "public")->get();
        $manuals = Manual::latest()->where("manual_status", "public")->get();

        $posts = $tutorials->concat($articles)->concat($manuals)->sortByDesc(function($item){
            return $item->created_at;
        });

        return view('home', compact("posts"));
    }
}
