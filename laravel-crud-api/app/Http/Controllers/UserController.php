<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * * Muestra la lista de los usuarios
     */
    public function index(Request $request): View
    {
        $users = User::paginate();

        $inspiration = exec('php artisan inspire');
        
        return view('user.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * * Muestra el formulario para crear un usuario
     */
    public function create(): View
    {
        $user = new User();

        return view('user.create', compact('user'));
    }

    /**
     * * Guarda un usuario y lo almacena
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password; // La contraseña se encriptará automáticamente en el modelo
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * * Muestra el usuario
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * * Función para editar un usuario.
     */
    public function edit($id): View
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * * Función para actualizar un usuario.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return Redirect::route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * * Función para borrar un usuario
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        return Redirect::route('users.index')
            ->with('success', 'Usuario borrado exitosamente');
    }
}
