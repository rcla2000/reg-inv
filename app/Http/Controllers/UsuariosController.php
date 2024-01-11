<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function inicio() {
        $usuarios = User::select('id', 'name', 'username', 'user_type', 'email')->paginate(15);
        return view('usuarios.inicio', compact('usuarios'));
    }

    function reestablecerPassword($id) {
        $usuario = User::findOrFail($id);
        return view('usuarios.reestablecer-password', compact('usuario'));
    }

    function actualizarPassword(Request $request) {
        $request->validate([
            'password' => 'required|string|min:6',
            'password_2' => 'required|string|min:6'
        ]);

        $usuario = User::find($request->id_usuario);

        if ($usuario === null) {
            Alert::error('Error', 'No se encontró el usuario especificado');
            return back();
        }

        if ($request->password !== $request->password_2) {
            Alert::error('Error', 'Las contraseñas ingresadas no coinciden');
            return back();
        }

        try {
            $usuario->password = Hash::make($request->password);
            $usuario->save();
            Alert::success('Información', 'Se reestableció la contraseña correctamente');
        } catch(Exception) {
            Alert::error('Error', 'No se pudo reestablecer la contraseña');
        } finally {
            return back();
        }
    }

    function eliminar(Request $request) {
        $usuario = User::find($request->id_usuario);

        if ($usuario === null) {
            return response()->json(['message' => 'No se encontró el usuario especificado'], 404);
        }

        try {
            User::destroy($request->id_usuario);
            return response()->json(['message' => 'El registro del usuario ha sido eliminado exitosamente']);
        } catch(Exception) {
            return response()->json(['Error', 'No se pudo eliminar el usuario'], 500);
        } 
    }
}
