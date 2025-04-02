<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
      // Registro de usuarios
    //   public function register(Request $request)
    //   {
    //       $request->validate([
    //           'name' => 'required|string|max:255',
    //           'email' => 'required|string|email|max:255|unique:users',
    //           'password' => 'required|string|min:6|confirmed',
    //       ]);

    //       $user = User::create([
    //           'name' => $request->name,
    //           'email' => $request->email,
    //           'password' => Hash::make($request->password),
    //       ]);

    //       $token = $user->createToken('auth_token')->plainTextToken;

    //       return response()->json([
    //           'user' => $user,
    //           'token' => $token,
    //           'message' => 'Registro exitoso',
    //       ]);
    //   }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user' => $user
        ], 201);

    }

      // Cierre de sesión
      public function logout(Request $request)
      {
          $request->user()->tokens()->delete();

          return response()->json([
              'message' => 'Sesión cerrada correctamente',
          ]);
      }

      // Obtener usuario autenticado
      public function me(Request $request)
      {
          return response()->json($request->user());
      }

      public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Credenciales incorrectas'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
            'user' => $user
        ]);
    }
}
