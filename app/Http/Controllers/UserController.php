<?php

namespace App\Http\Controllers;

use App\Mail\SenderPassword;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Session()->has('level') && Session()->get('level') == 1) {
            $users = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('type', 2);
                }
            )->skip(0)->take(5)->get();
            $f_n = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('nom_role', 'Fondateur');
                }
            )->count();

            $p_n = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('nom_role', 'Proviseur');
                }
            )->count();

            $c_n = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('nom_role', 'Censeur');
                }
            )->count();

            $s_n = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('nom_role', 'Surveillant');
                }
            )->count();


            return view('auth.index', compact('users', 'f_n', 'p_n', 'c_n', 's_n'));
        } elseif (Session()->has('level') && Session()->get('level') == 2) {
            $e_n = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('nom_role', 'Enseignant');
                }
            )->count();
            $users = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('type', 3);
                }
            )->skip(0)->take(5)->get();
            return view('auth.index', compact('users', 'e_n'));
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $level = $_GET['level'];
        if ($level == 1) {
            $roles = Role::where('type', 2)->get();
            return view('auth.admin-register');
        } elseif ($level == 2 && (Session()->has('level') && Session()->get('level') == 1)) {
            $roles = Role::where('type', 2)->get();
            return view('auth.user-l2-register', compact('roles'));
        } elseif ($level == 2 && (Session()->has('level') && Session()->get('level') == 2)) {
            $roles = Role::where('type', 3)->get();
            return view('auth.user-l2-register', compact('roles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->statut) {
            $validated = $request->validate([
                'statut' => 'required',
                'nom_user' => 'required|max:45',
                'email' => 'required|unique:users|max:45',
                'phrase_secrete' => 'required',
                'login' => 'required',
                'password' => 'required|max:45',
                'telephone' => 'required|max:45',
            ]);

            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            $user->roles()->attach(1);
            return redirect('/auth/login')->with('AUTHSAAD', 'L\'administrateur crée avec succès');
        } else {
            $validated = $request->validate([
                'nom_user' => 'required|max:45',
                'email' => 'required|unique:users|max:45',
                'phrase_secrete' => 'required',
                'login' => 'required',
                'password' => 'required|max:45',
                'telephone' => 'required|max:45',
            ]);

            try {
                //code...
                $user = User::create([
                    'nom_user' => $request->nom_user,
                    'email' => $request->email,
                    'phrase_secrete' => $request->phrase_secrete,
                    'login' => $request->login,
                    'password' => Hash::make($request->password),
                    'telephone' => $request->telephone,
                    'statut' => 1,
                ]);
                $user->statut = 1;
                $user->save();
                foreach ($request->roles as $role) {
                    $user->roles()->attach($role);
                }
                return back()->with('AUTHSAL2U', 'Création de l\'utilisateur réussit');
            } catch (\Exception $e) {
                //throw $th;

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            $user = User::find($id);
            $roles = Role::all();
            return view('auth.user-edit-l2', compact('user', 'roles'));
        } catch (\Exception $e) {
            //throw $th;

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updat(Request $request)
    {
        # code...

        $validated = $request->validate([
            'nom_user' => 'required|max:45',
            'email' => 'required|max:45',
            'phrase_secrete' => 'required',
            'login' => 'required',
            'telephone' => 'required|max:45',
        ]);
        try {

            $user = User::find($request->user_id);
            //$user->password = Hash::make($request->nouveau_password);
            $user->nom_user = $request->nom_user;
            $user->email = $request->email;
            $user->phrase_secrete = $request->phrase_secrete;
            $user->login = $request->login;
            $user->telephone = $request->telephone;
            $user->save();
            return redirect('/user/showlist')->with('AUTHSUL2U', 'Modification du user réussit...');
            /*            if (Hash::check($request->ancien_password, $user->password)) {
                # code...

            } else {

            }*/
        } catch (\Exception $e) {
            //throw $th;
            return back()->with('AUTHFUL2U', 'Problème de modification');
            dd('Erruer ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $user = User::find($id);
            $user->roles()->detach();
            $user->delete();
            return back()->with('AUTHSDL2U', 'Utilisateur supprimer avec succès...');
        } catch (\Exception $e) {
            dd('Erreur : ' . $e->getMessage());
        }
    }

    public function detail($id)
    {
        # code...
        try {
            $user = User::find($id);
            $roles = $user->roles;
            return view('auth.detail', compact('user', 'roles'));
        } catch (\Exception $e) {
            //throw $th;
            dd('Erreur : ' . $e->getMessage());
        }
    }

    public function login_form()
    {
        return view('login');
    }

    /* la fonction qui réalise la connexion d'un utilisateur
    * une fois l'utilisateur connecté, il sera redirigé en fonction de son niveau
    */
    public function login(Request $request)
    {

        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('login', '=', $request->login)->first();

        if ($user) {
            if ($user->statut == 1) {
                if (Hash::check($request->password, $user->password)) {
                    if ($user->first_connection == true) {
                        $erreur = false;
                        return view('auth.change-first', compact('user','erreur'));
                    } else {
                        $request->session()->put('user', $user);
                        if ($user->isAdmin()) {
                            $request->session()->put('level', 1);
                            return redirect('/dashbord');
                        } else if ($user->isLevelTwo()) {
                            if ($user->isSurveillant()) {
                                return "Bienvenue Surveillant";
                            }
                            $request->session()->put('level', 2);
                            return redirect('/dashbord');
                        } else if ($user->isTeacher()) {
                            $request->session()->put('level', 3);
                            return "Bienvenue Enseignant";
                        }
                    }
                } else {
                    return redirect('/auth/login')->with('AUTHPAAD', 'Mot de passe incorrecte');
                }
            } else {
                return redirect('/auth/login')->with('AUTHDAAD', 'Votre compte a été désactivé! contactez votre administrateur');
            }
        } else {
            return redirect('/auth/login')->with('AUTHUAAD', 'Utilisateur non reconnu par le système');
        }
    }

    public function rememberLater(Request $request, $id)
    {
        $user = User::find($id);
        $request->session()->put('user', $user);
        if ($user->isAdmin()) {
            $request->session()->put('level', 1);
            return redirect('/dashbord');
        } else if ($user->isLevelTwo()) {
            if ($user->isSurveillant()) {
                return "Bienvenue Surveillant";
            }
            $request->session()->put('level', 2);
            return redirect('/dashbord');
        } else if ($user->isTeacher()) {
            $request->session()->put('level', 3);
            return "Bienvenue Enseignant";
        }
    }

    public function showList()
    {
        # Pour le fondateur
        if($_GET['q']){
          /*  $users = User::query()
            ->where('title', 'like', "%{$key}%")
            ->orWhere('content', 'like', "%{$key}%")
            ->get();*/
        }
        if (Session()->has('level') && Session()->get('level') == 1) {
            $users = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('type', 2);
                }
            )->skip(0)->take(5)->get();
            #Pour les users de niveau 2
        } elseif (Session()->has('level') && Session()->get('level') == 2) {
            $users = User::whereHas(
                'roles',
                function ($q) {
                    $q->where('type', 3);
                }
            )->skip(0)->take(5)->get();
        }

        return view('auth.index-user-l2', compact('users'));
    }
    public function logout()
    {
        if (Session()->has('user')) {
            Session()->pull('user');
            return redirect('/auth/login')->with('AUTHOAAD', 'Déconnexion réussit');
        } else {
            return redirect('/auth/login')->with('AUTHCAAD', 'Je ne comprends rien');
        }
    }

    public function profil()
    {
        # code...
        if (Session()->has('user')) {
            $user = Session()->get('user');
            return view('auth.profil', compact('user'));
        }
    }

    public function editProfile()
    {
        # code...
        if (Session()->has('user')) {
            $user = Session()->get('user');
            return view('auth.profil-edit', compact('user'));
        }
    }

    public function storeEditProfile(Request $request)
    {
        $validated = $request->validate([
            'nom_user' => 'required|max:45',
            'email' => 'required|max:45',
            'phrase_secrete' => 'required',
            'login' => 'required',
            'telephone' => 'required|max:45',
        ]);
        try {
            if (Session()->has('user')) {
                $user = Session()->get('user');
            }
            $user->nom_user = $request->nom_user;
            $user->email = $request->email;
            $user->phrase_secrete = $request->phrase_secrete;
            $user->login = $request->login;
            $user->telephone = $request->telephone;
            $user->save();
            return redirect('/user/profil')->with('AUTHSEPU', 'Modification du profil utilisateur avec succès...');
        } catch (\Exception $e) {
            //throw $th;
            dd('Edition Failed : ' . $e->getMessage());
        }
    }

    public function changePasswordForm()
    {
        if (Session()->has('user')) {
            $user = Session()->get('user');
            
            return view('auth.change-password', compact('user'));
        }
    }

    public function storeChangePasswordForm(Request $request)
    {
        $validated = $request->validate([
            'new_password' => 'required|min:8|max:45',
            'old_password' => 'required|min:8|max:45',
        ]);

        try {
            if (Session()->has('user')) {
                $user = Session()->get('user');
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return redirect('/user/profil')->with('AUTHSEPASU', 'Modification du mot de passe réussit...');
                } else {
                    return redirect('/user/change-password')->with('AUTHFEPASU', 'Ancien mot de passe incorrecte...');
                }
            }
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    public function storeFirstChangePasswordForm(Request $request)
    {
        # code...

        $validated = $request->validate([
            'login' => 'required|max:45',
            'password' => 'required|min:8|max:45',
        ]);
        try {
            $user = User::find($request->user_id);
            if(Hash::check($request->password, $user->password)) {
                $erreur = "Le mot de passe doit etre different de l'ancien";
                return view('auth.change-first',compact('user','erreur'));
            }else{
                $user->password = Hash::make($request->password);
                $user->login = $request->login;
                $user->first_connection = false;
                $user->save();
                $request->session()->put('user', $user);
                if ($user->isAdmin()) {
                    $request->session()->put('level', 1);
                    return redirect('/dashbord');
                } else if ($user->isLevelTwo()) {
                    if ($user->isSurveillant()) {
                        return "Bienvenue Surveillant";
                    }
                    $request->session()->put('level', 2);
                    return redirect('/dashbord');
                } else if ($user->isTeacher()) {
                    $request->session()->put('level', 3);
                    return redirect('/dashbord');
                }
            }
            
        } catch (\Exception $e) {
            //throw $th;
            dd('Impossible de changer vos identifiants');
        }
    }

    public function forgotPassword(Request $request)
    {
        # code...
        try {
            //code...
            if ($request->session()->has('AUTHRPEI')) {
                $request->session()->forget('AUTHRPEI');
            } elseif ($request->session()->has('user_changing')) {
                $request->session()->forget('user_changing');
            } elseif ($request->session()->has('AUTHRPCI')) {
                $request->session()->forget('AUTHRPCI');
            } elseif ($request->session()->has('AUTHRSPD')) {
                $request->session()->forget('AUTHRSPD');
            }
        } catch (\Exception $e) {
            //throw $th;
        }
        return view('auth.options');
    }

    public function forgotPasswordCheckIdentifier(Request $request)
    {
        if ($request->option == 2) {
            $request->session()->put('option', 2);
        } elseif ($request->option == 3) {
            $request->session()->put('option', 3);
        } else {
            $request->session()->put('option', 1);
        }
        return view('auth.reset-password');
    }

    public function restore(Request $request)
    {
        if ($request->session()->get('option') == 2) {
            # code...
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $code = (rand(50000000, 90000000));
                # On déclenche l'envoi du mail
                $request->session()->put('code', $code);
                $request->session()->put('user_changing', $user);
                try {
                    Mail::to($user->email)->send(new SenderPassword($code));
                    return view('auth.input-code');
                } catch (\Exception $e) {
                    //throw $th;
                    dd('Email non envoyer');
                }
            } else {
                $request->session()->put('AUTHRPEI', 'adresse mail non trouvé');
                return view('auth.reset-password');
            }
        } elseif ($request->session()->get('option') == 3) {
            # code...
            return "Hiiiiiiiiiii";
        } elseif ($request->session()->get('option') == 1) {
            # code...
            $user = User::where('phrase_secrete', $request->phrase_secrete)->first();

            if ($user) {
                $request->session()->put('user_changing', $user);
                return view('auth.input-reset-password');
            } else {
                $request->session()->put('AUTHRPEI', 'Phrase secrète incorrecte');
                return view('auth.reset-password');
            }
        }


        #return view('auth.reset-password');
    }

    public function resend()
    {
        # code...
        if (session()->get('user_changing')) {
            $code = (rand(50000000, 90000000));
            Mail::to(session()->get('user_changing')->email)->send(new SenderPassword($code));
            return view('auth.input-code');
        }
    }


    public function checkCode(Request $request)
    {
        # code...
        $validated = $request->validate([
            'code' => 'required|min:8',
        ]);

        if ($request->code == $request->session()->get('code')) {
            return view('auth.input-reset-password');
        } else {
            $request->session()->put('AUTHRPCI', 'Le code entrer est incorrect...');
            return view('auth.input-code');
        }
    }
    public function restoreChange(Request $request)
    {
        # code...
        if (session()->get('user_changing')->password == Hash::make($request->password)) {
            $request->session()->put('AUTHRSPD', 'Votre nouveau mot de passe est identique à l\'ancien');
            return view('auth.input-reset-password');
        } else {
            session()->get('user_changing')->password = Hash::make($request->password);
            session()->get('user_changing')->save();
            return redirect('/auth/login');
        }
    }

    public function samePassword()
    {
        # code...
        return view('auth.input-reset-password');
    }

    public function search(Request $request)
    {
        # code...

        $key = trim($request->get('q'));

        if($request->session()->get('level') == 1){
            $user = User::query()
            ->where('nom_user', 'like', "%{$key}%")
            ->orWhere('login', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return view('auth.input-reset-password');
    }
    
}
