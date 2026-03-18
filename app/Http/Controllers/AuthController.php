<?php

namespace App\Http\Controllers;

Use App\Models\User;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //metodo para regresar vista del formulario
    public function registerForm(){
        return view('auth.register');
    }

    //metodo para guardar la informacion en la bd
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required |email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request -> has('is_admin'),
        ]);

        //Iniciar sesion de forma automatica
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    //Metodo para regresar vista de inicio de sesion
    public function loginForm(){
        return view('auth.login');
    }

    //Metodo para verificar el inicio de sesion
    public function login(Request $request){
        //Validar los datos q se obtienen del formulario
        $data = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Se realiza una validacion para generar la sesion
        if(Auth::attempt($data)){
            //Generar la sesion
            $request -> session()->regenerate();

            //Redireccionar al usuario a cualquier ruta del sistema
            return redirect()->route('libros.index');
        }

        return back()->withErrors([
            'email'=> 'Datos incorrectos',
        ]);
    }

    public function logout(Request $request){
        //Cierre de sesion
        Auth::logout();

        //Cierre de credenciales en sesiones
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/acceso');

    }

    public function adminDashboard(){
        return view('admin.dashboard');

    }

    
}
