<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $articles = Article::where('is_accepted',true)->orderBy('created_at','desc')->get();
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
        $article = Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'category_id' => $request->id,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/imgs'),
            'user_id' => Auth::id(),
        ]);
        
        $tags = explode(',', $request->tags);
        
        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => $tag
            ]);
            $article->tags()->attach($newTag);
        }
        
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
        $articles = $category->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-category', compact('articles', 'category'));
    }
    
    public function byEditor (User $user){
        $articles = $user->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-editor', compact('articles', 'user'));
    }
    
    public function indexByOldestArticles(){
        $articles = Article::where('is_accepted',true)->orderBy('created_at','asc')->get();
        return view('article.index', compact('articles'));
    }
    
    public function indexByNewestArticles(){
        $articles = Article::where('is_accepted',true)->orderBy('created_at','desc')->get();
        return view('article.index', compact('articles'));
    }
    
    public function byCatOldestArticles (Category $category){
        $articles = $category->articles->sortBy('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-category', compact('articles', 'category'));
    }
    
    public function byCatNewestArticles (Category $category){
        $articles = $category->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-category', compact('articles', 'category'));
    }
    
    public function byEditorOldestArticles (User $user){
        $articles = $user->articles->sortBy('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-editor', compact('articles', 'user'));
    }
    
    public function byEditorNewestArticles (User $user){
        $articles = $user->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted == true;
        });
        return view('article.by-editor', compact('articles', 'user'));
    }
    
    public function articleSearch(Request $request){

        $query = $request->input('query');
        
        $articles_t = Article::where('is_accepted',true)->orderBy('created_at','desc')->get();
        $articles_w_tags = new Collection([]);
        $articles_w_searchedTag= new Collection([]);
        
        foreach ($articles_t as $article_t) {
            if (count($article_t->tags)!=0) {
                $articles_w_tags->push($article_t);
            }
        }
        
        foreach ($articles_w_tags as $article_w_tags) {
            foreach ($article_w_tags->tags as $article_tag) {
                if ($article_tag->name == strtolower($query)) {
                    $articles_w_searchedTag->push($article_w_tags);
                }
            }
        }        
        
        $articles_s = Article::search($query)->where('is_accepted',true)->orderBy('created_at','desc')->get();
        
        $articles = $articles_w_searchedTag->merge($articles_s);
        
        $article_id;
        for ($i=0; $i < count($articles) ; $i++) {
            if (isset($articles[$i])) {
                $article_id = $articles[$i]->id;
                for ($j=$i+1; $j < count($articles); $j++) { 
                    if (isset($articles[$j]) && $article_id == ($articles[$j]->id)) {
                        $id = $articles[$j]->id;
                        $key = $articles->search(function($i) use($id) {
                            return $i->id === $id;
                        });
                        $articles->forget($key);
                    }
                }
            }
        }
        
        return view('article.search-index', compact('articles','query'));
    }
}
