<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\CareerContactRMail;
use Illuminate\Support\Facades\Mail;

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

}
