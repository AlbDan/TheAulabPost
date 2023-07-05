<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
//use Illuminate\Support\Str; //Per dare lo slug a tutti gli articoli
use Illuminate\Http\Request;
use App\Mail\CareerContactMail;
use App\Mail\CareerRequestMail;
use App\Http\Requests\CareerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    
    public function homepage(){
        $articles = Article::where('is_accepted',true)->orderBy('created_at','desc')->take(4)->get();

        //Per dare lo slug a tutti gli articoli

        // $articles_toSlug = Article::all();
        // for ($i=0; $i < count($articles_toSlug) ; $i++) {
        //     $articles_toSlug[$i]->update([
        //         'slug' => Str::slug($articles_toSlug[$i]->title),
        //     ]);
        //     dump($articles_toSlug[$i]->slug);
        // }
        // dd($articles_toSlug);


        return view('welcome', compact('articles'));
    }
    
    public function careers(){
        return view('careers');
    }
    
    public function careersSubmit(CareerRequest $request){
        
        $user = Auth::user();
        
        $email = $request->email;
        $role = $request->role;
        $msg = $request->msg;
        
        switch ($role) {
            case 'revisor':
            $user->is_revisor=NULL;
            $ruolo = "revisore";
            break;
            case 'writer':
            $user->is_writer=NULL;
            $ruolo = "scrittore";
            break;
            case 'admin':
            $user->is_admin=NULL;
            $ruolo = "amministratore";
            break;
            default:
            break;
        }

        $user->update();

        if (User::where('id',$user->id)->get()[0]->is_revisor==NULL || 
            User::where('id',$user->id)->get()[0]->is_writer==NULL || 
            User::where('id',$user->id)->get()[0]->is_admin==NULL) {
            Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail(compact('email','role','msg')));
            Mail::to($email)->send(new CareerContactMail(compact('user','ruolo')));
        }



        return redirect(route('careers'))->with('status','Grazie per averci contattato!');
        
    }          
}
        