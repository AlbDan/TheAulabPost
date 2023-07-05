<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ArticleController extends Controller
{
    
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $articles = Article::where('is_accepted',true)->orderBy('created_at','desc')->paginate(4);
        
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
            'slug' => Str::slug($request->title),
        ]);
        
        $tags = explode(', ', $request->tags);
        
        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => strtolower($tag),
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
        return view('article.edit', compact('article'));
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Article $article)
    {
        
        $messages = [
            'title.required' => 'Il titolo è richiesto',
            'title.min' => 'Il titolo deve contenere almeno 5 caratteri',
            'subtitle.required' => 'Il sottotitolo è richiesto',
            'subtitle.min' => 'Il sottotitolo deve contenere almeno 5 caratteri',
            'id.exists' => 'Scelta non valida',
            'body.required' => 'Il body è richiesto',
            'body.min' => 'Il body deve contenere almeno 10 caratteri',
            'image.required' => "L'immagine è richiesta",
            'image.mimes' => "Il formato non è valido, (formati validi: jpg, bmp e png)",
            'tags.required' => "Inserisci almeno un tag",
        ];
        
        Validator::make($request->all(), [
            'title' => 'required|min:5|unique:articles,title,' .$article->id,
            'subtitle' => 'required|min:5|unique:articles,subtitle,' .$article->id,
            'id' => Rule::exists(Category::class),
            'body' => 'required|min:10',
            'image' => 'mimes:jpg,bmp,png',
            'tags' => 'required'
        ], $messages)->validate();
        
        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->id,
            'slug' => Str::slug($request->title),
        ]);
        
        if ($request->image) {
            Storage::delete($article->image);
            $article->update([
                'image' => $request->file('image')->store('public/imgs'),
            ]);
        }
        
        $tags = explode(', ', $request->tags);
        
        $newTags = [];
        
        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => strtolower($tag),
            ]);
            $newTags[] = $newTag->id;
        }
        
        $article->tags()->sync($newTags);
        
        return redirect(route('writer.dashboard'))->with('status','Articolo aggiornato correttamente!');
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Article $article)
    {
        foreach ($article->tags as $tag) {
            $article->tags()->detach($tag);
        }
        
        $article->delete();
        
        return redirect(route('writer.dashboard'))->with('status','Articolo eliminato correttamente!');
    }
    
    public function byCategory (Category $category){
        if (count($category->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $category->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-category', compact('articles', 'category'));
        } else {
            return view ('article.none-by-category');
        }
    }
    
    public function byEditor (User $user){
        if (count($user->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $user->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-editor', compact('articles', 'user'));
        } else {
            return view ('article.none-by-user');
        }
    }
    
    public function indexByOldestArticles(){
        $articles = Article::where('is_accepted',true)->orderBy('created_at','asc')->paginate(4);
        return view('article.index', compact('articles'));
    }
    
    public function indexByNewestArticles(){
        $articles = Article::where('is_accepted',true)->orderBy('created_at','desc')->paginate(4);
        return view('article.index', compact('articles'));
    }
    
    public function byCatOldestArticles (Category $category){
        if (count($category->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $category->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','asc')->paginate(4);
            return view('article.by-category', compact('articles', 'category'));
        } else {
            return view ('article.none-by-category');
        }
    }
    
    public function byCatNewestArticles (Category $category){
        if (count($category->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $category->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-category', compact('articles', 'category'));
        } else {
            return view ('article.none-by-category');
        }
    }
    
    public function byEditorOldestArticles (User $user){
        if (count($user->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $user->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','asc')->paginate(4);
            return view('article.by-editor', compact('articles', 'user'));
        } else {
            return view ('article.none-by-user');
        }
    }
    
    public function byEditorNewestArticles (User $user){
        if (count($user->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $user->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-editor', compact('articles', 'user'));
        } else {
            return view ('article.none-by-user');
        }
    }
    
    public function articleSearch(Request $request){
        
        $query = $request->input('query');
        
        $articles_t = Article::where('is_accepted',true)->get();
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
        
        $articles_s = Article::search($query)->where('is_accepted',true)->get();
        
        $articles = $articles_w_searchedTag->merge($articles_s)->sortByDesc('created_at');
        
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
        
        $total=count($articles);
        $per_page = 4;
        $current_page = $request->input("page") ?? 1;
        
        $starting_point = ($current_page * $per_page) - $per_page;
        
        $articles = $articles->all();
        $articles = array_slice($articles, $starting_point, $per_page, true);
        
        $articles = new Paginator($articles, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        
        return view('article.search-index', compact('articles','query'));
    }
    
    public function articleSearchByNewest ($query, Request $request) {
        
        $articles_t = Article::where('is_accepted',true)->get();
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
        
        $articles_s = Article::search($query)->where('is_accepted',true)->get();
        
        $articles = $articles_w_searchedTag->merge($articles_s)->sortByDesc('created_at');
        
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
        
        $total=count($articles);
        $per_page = 4;
        $current_page = $request->input("page") ?? 1;
        
        $starting_point = ($current_page * $per_page) - $per_page;
        
        $articles = $articles->all();
        $articles = array_slice($articles, $starting_point, $per_page, true);
        
        $articles = new Paginator($articles, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        
        return view('article.search-index', compact('articles','query'));
        
    }
    
    public function articleSearchByOldest ($query, Request $request) {
        
        $articles_t = Article::where('is_accepted',true)->get();
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
        
        $articles_s = Article::search($query)->where('is_accepted',true)->get();
        
        $articles = $articles_w_searchedTag->merge($articles_s)->sortBy('created_at');
        
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
        
        $total=count($articles);
        $per_page = 4;
        $current_page = $request->input("page") ?? 1;
        
        $starting_point = ($current_page * $per_page) - $per_page;
        
        $articles = $articles->all();
        $articles = array_slice($articles, $starting_point, $per_page, true);
        
        $articles = new Paginator($articles, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        
        return view('article.search-index', compact('articles','query'));
        
    }
    
    public function byTag(Tag $tag){
        if (count($tag->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $tag->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-tag', compact('articles', 'tag'));
        } else {
            return view ('article.none-by-tag');
        }
    }
    
    public function byTagOldestArticles(Tag $tag){
        if (count($tag->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $tag->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','asc')->paginate(4);
            return view('article.by-tag', compact('articles', 'tag'));
        } else {
            return view ('article.none-by-tag');
        }
    }
    
    public function byTagNewestArticles(Tag $tag){
        if (count($tag->articles->filter(function($article){
            return $article->is_accepted == true;
        }))!=0) {
            $articles = $tag->articles->filter(function($article){
                return $article->is_accepted == true;
            })->toQuery()->orderBy('created_at','desc')->paginate(4);
            return view('article.by-tag', compact('articles', 'tag'));
        } else {
            return view ('article.none-by-tag');
        }
    }
}
