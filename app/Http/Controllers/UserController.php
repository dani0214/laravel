<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Rules\NifNie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('auth.user');
    }

    /**
     * Devolvemos la vista de edicion del usuario
     * @param Request $request
     * @return
     */
    public function edit(User $user) {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    /**
    * Realizamos la actualizacion de los datos del usuario una vez validados 
    */
    public function update(User $user) {
        $user = Auth::user();
        $this->validate(request(), [
            'usuario' => ['required', 'string', 'string', 'max:20'.Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'.Rule::unique('users')->ignore($user->id)],
            'nif' => [new NifNie, 'required', 'string', 'max:45'],
            'direccion' => ['required', 'string', 'max:255'],
        ]);
        $user->usuario = request('usuario');
        $user->name = request('name');
        $user->email = request('email');
        $user->dni = request('nif');
        $user->direccion = request('direccion');
        $user->save();
        return view('auth.user', compact('user'));
    }
    /**
    * Mostramos la ventana de confirmacion de la eliminacion de la cuenta 
    */
    public function confirmDelete(User $user) {
        $user = Auth::user();
        return view('auth.confirmdelete', compact('user'));
    }
    /**
    * Realizamos la eliminacion de la cuenta del usuario 
    */
    public function delete(User $user) {
        $user = Auth::user();
        $user->delete();
        return redirect('/');
    }


}