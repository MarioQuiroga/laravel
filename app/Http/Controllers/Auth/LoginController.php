<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Usos incluidos en el tutorial
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegisterUsers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth){
        $this->auth = $auth;
        $this->middleware('guest')->except('logout');
    }

// Login
    protected function getLogin(){
        return view('login');
    
    }
// Procesar los datos enviados en el login
    protected function postLogin(Request $request){
            return Validator::make($request, [
                'name' => 'required',
                'password' => 'required',
            ]);
            
        $credenciales = $request->only('name', 'password');

        if ($this->auth->attempt($credenciales, $request->has('remember'))){
            return view($redirectTo);
        }
        return view(login);
    }

// Registrarse en el sistema
    protected function getRegister(){
        return view('registro');    
    }

    protected function postRegister(Request $request){
        return Validator::make($request, [
                'name' => 'required',
                'email'=>'required',
                'password' => 'required',
            ]);
        $data = $request;

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        if($user->save()){
            return "Se ha registrado correctamente el usuario";
        }

    }
// LogOut
    protected function getLogout(){
        $this->auth->logout();
        Session::flush();
        return redirect('login');
    }    

}
