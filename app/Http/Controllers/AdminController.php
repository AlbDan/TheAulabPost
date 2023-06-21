<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\CareerContactRMail;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CategoryRequest;

class AdminController extends Controller
{
    public function dashboard(){

        $revisorRequests = User::where('is_revisor', NULL)->get();
        $writerRequests = User::where('is_writer', NULL)->get();
        $adminRequests = User::where('is_admin', NULL)->get();

        return view('admin.dashboard', compact('revisorRequests', 'writerRequests', 'adminRequests'));
    }

    public function setRevisor(User $user){
        $user->update([
            'is_revisor' => true,
        ]);

        $role = "revisore";
        $outcome = "accettata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente abilitato correttamente');
    }

    
    public function setWriter(User $user){
        $user->update([
            'is_writer' => true,
        ]);

        $role = "scrittore";
        $outcome = "accettata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente abilitato correttamente');
    }

    public function setAdmin(User $user){
        $user->update([
            'is_admin' => true,
        ]);

        $role = "amministratore";
        $outcome = "accettata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente abilitato correttamente');
    }

    public function dontsetRevisor(User $user){
        $user->update([
            'is_revisor' => false,
        ]);

        $role = "revisore";
        $outcome = "rifiutata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente non abilitato correttamente');
    }

    
    public function dontsetWriter(User $user){
        $user->update([
            'is_writer' => false,
        ]);

        $role = "scrittore";
        $outcome = "rifiutata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente non abilitato correttamente');
    }

    public function dontsetAdmin(User $user){
        $user->update([
            'is_admin' => false,
        ]);

        $role = "amministratore";
        $outcome = "rifiutata";

        Mail::to($user->email)->send(new CareerContactRMail(compact('user','role','outcome')));

        return redirect(route('admin.dashboard'))->with('status','Utente non abilitato correttamente');
    }

    public function editTag(Tag $tag, TagRequest $request){

        $tag->update([
            'name' => strtolower($request->name),
        ]);
        return redirect(route('admin.dashboard'))->with('status','Tag modificato correttamente');
    }

    public function deleteTag(Tag $tag){

        foreach ($tag->articles as $article) {
            $article->tags()->detach($tag);
        }

        $tag->delete();
        return redirect(route('admin.dashboard'))->with('status','Tag eliminato correttamente');
    }

    public function editCategory(Category $category, CategoryRequest $request){

        $category->update([
            'name' => strtolower($request->name),
        ]);
        return redirect(route('admin.dashboard'))->with('status','Categoria modificata correttamente');
    }

    public function deleteCategory(Category $category){

        foreach ($category->articles as $article) {
            $article->update([
                'category_id'=>NULL,
            ]);
        }

        $category->delete();
        return redirect(route('admin.dashboard'))->with('status','Categoria eliminata correttamente');
    }

    public function storeCategory(CategoryRequest $request){
        Category::create([
            'name' => strtolower($request->name),
        ]);

        return redirect(route('admin.dashboard'))->with('status','Categoria inserita correttamente!');
    }

}
