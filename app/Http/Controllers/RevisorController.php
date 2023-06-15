<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function dashboard(){

        $pendingArticles = Article::where('is_accepted', NULL)->get();
        $accepterArticles = Article::where('is_accepted', true)->get();
        $rejectedArticles = Article::where('is_accepted', false)->get();

        return view('revisor.dashboard', compact('pendingArticles','accepterArticles','rejectedArticles'));
    }

    public function acceptArticle(Article $article){
        $article->update([
            'is_accepted' => true,
        ]);
        return redirect(route('revisor.dashboard'))->with('status','Articolo pubblicato');
    }

    public function rejectArticle(Article $article){
        $article->update([
            'is_accepted' => false,
        ]);
        return redirect(route('revisor.dashboard'))->with('status','Articolo rifiutato');
    }

    public function undoArticle(Article $article){
        $article->update([
            'is_accepted' => NULL,
        ]);
        return redirect(route('revisor.dashboard'))->with('status','Articolo riportato in revisione');
    }
}
