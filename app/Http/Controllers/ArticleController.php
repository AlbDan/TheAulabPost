<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function __construct(){
        return $this->middleware('auth')->except('index','show','byCategory','byEditor','indexByOldestArticles','indexByNewestArticles');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->get();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'category_id' => $request->id,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/imgs'),
            'user_id' => Auth::id(),
        ]);

        return redirect(route('article.create'))->with('status','Articolo inserito correttamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view ('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }

    public function byCategory (Category $category){
        $articles = $category->articles->sortByDesc('created_at');
        return view('article.by-category', compact('articles', 'category'));
    }

    public function byEditor (User $user){
        $articles = $user->articles->sortByDesc('created_at');
        return view('article.by-editor', compact('articles', 'user'));
    }

    public function indexByOldestArticles(){
        $articles = Article::orderBy('created_at','asc')->get();
        return view('article.index', compact('articles'));
    }

    public function indexByNewestArticles(){
        $articles = Article::orderBy('created_at','desc')->get();
        return view('article.index', compact('articles'));
    }

    public function byCatOldestArticles (Category $category){
        $articles = $category->articles->sortBy('created_at');
        return view('article.by-category', compact('articles', 'category'));
    }

    public function byCatNewestArticles (Category $category){
        $articles = $category->articles->sortByDesc('created_at');
        return view('article.by-category', compact('articles', 'category'));
    }

    public function byEditorOldestArticles (User $user){
        $articles = $user->articles->sortBy('created_at');
        return view('article.by-editor', compact('articles', 'user'));
    }

    public function byEditorNewestArticles (User $user){
        $articles = $user->articles->sortByDesc('created_at');
        return view('article.by-editor', compact('articles', 'user'));
    }

}