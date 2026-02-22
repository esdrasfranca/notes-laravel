<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {

        if(session()->get('user')) {
            return redirect('/');
        }
        
        return view('login');
    }

    public function loginSubmit(Request $request) {
        
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
        ], [
            'text_username.required' => 'O E-mail é obrigatório',
            'text_username.email' => 'O email é inválido',
            'text_password.required' => 'A senha é obrigatória',
            'text_password.min' => 'A senha deve ter no mínimo :min caracteres',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres'
        ]);

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('user_name', $username)
            ->where('deleted_at', NULL)
            ->first();

        // Valida Usuário
        if(!$user) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('login_error', 'Usuário/senha inválido.');
        }

        // Valida Senha
        if(!password_verify($password, $user->password)) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('login_error', 'Usuário/senha inválido.');
        }

        // Atualiza last login usuário
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session(['user' => $user]);

        // Redireciona pada form
        return redirect('/');

        
    }

    public function logout() {
        session()->flush();
        return redirect('/login');
    }
}
