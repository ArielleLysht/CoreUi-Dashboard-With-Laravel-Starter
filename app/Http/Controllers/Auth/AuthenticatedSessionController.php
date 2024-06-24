<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Compte;
use App\Models\Salary;
use App\Models\User;
use App\Models\Struct;
use App\Models\Role;
use App\Models\Admin;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    public function createAccount(): View
    {
        return view('auth.addAccount');
    }

    public function createAccount1(): View
    {
        return view('auth.addAccount1');
    }

    public function createAccount2(): View
    {
        return view('auth.addAccount2');
    }

    public function account(): View
    {
        // $compte = session('compte_email');
        // dd($compte);
        return view('auth.compte');
    }

    public function addAccount(Request $request)
    {
       $user = Compte::where('email', $request->email)->where('matricule', $request->matricule)->first();
       if($user!=NULL){
        // session(['compte_id' => $user->id, 'compte_email' =>$user->email]);
        return redirect()->route('compte')->withInput(['compte_id' => $user->id, 'compte_email' => $user->email]);
       }else{
        return redirect()->route('addAccount');
       }
    }

    public function addAccount1(Request $request)
    {
       $user = Admin::where('email', $request->email)->first();
       if($user!=NULL){
        // session(['compte_id' => $user->id, 'compte_email' =>$user->email]);
        return redirect()->route('compte')->withInput(['compte_id' => $user->id, 'compte_email' => $user->email]);
       }else{
        return redirect()->route('addAccount1');
       }
    }

    public function addAccount2(Request $request)
    {
        $struct = Struct::where('code', $request->code)->value('id');
        
        // dd($role);
       $user = Salary::where('email', $request->email)->first();
       $role = Role::where('structure_id', $struct)->where('id', $user->id)->get();

    //    dd($role);
       if($user!=NULL && $role!=NULL){
        // session(['compte_id' => $user->id, 'compte_email' =>$user->email]);
        return redirect()->route('compte')->withInput(['compte_id' => $user->id, 'compte_email' => $user->email]);
       }else{
        return redirect()->route('addAccount2');
       }
    }


    public function addCompt(Request $request)
    {
        $student=Compte::where('email',$request->input('compte_email'))->value('id');
        $salary=Salary::where('email',$request->input('compte_email'))->value('id');
        $admin=Admin::where('email',$request->input('compte_email'))->value('id');

        // dd($student,$salary,$admin);
       $user = new User();
       $user->compte_id = $request->input('compte_id');
       $user->email = $request->input('compte_email');
       $user->username = $request->input('username');
       $user->password = $request->input('password');
       if ($student!=NULL) {
        $user->role = "Student";
       }elseif ($salary!=NULL) {
        $user->role = "Salary";
       }elseif ($admin!=NULL) {
        $user->role = "Admin";
       }
    //    dd($user->compte_id);
       $user->save();
       return redirect()->route('login');
    }


    


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();
        // dd($user);


        // Redirection en fonction du rôle de l'utilisateur
        if ($user->role=="Salary") {
            return redirect()->route('requete');
        } elseif ($user->role=="Student") {
            return redirect()->route('allReq');
        } elseif ($user->role=="Admin") {
            return redirect()->route('viewType');
        } 

        // return redirect()->intended(RouteServiceProvider::HOME);
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
