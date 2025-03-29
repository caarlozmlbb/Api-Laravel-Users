<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::all();

        return $usuarios;
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $e = User::create($inputs);
        return response()->json([
            'data' => $e,
            'mensaje' => 'Registrado con exito',
        ]);
    }

    public function show(string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            return response()->json([
                'data' => $e,
                'mensaje' => 'Encontrado con exito',
            ]);
        }else{
            return response()->json([
                'error' => true,
                'mensaje' => 'No exite',
            ]);
        }
    }


    public function update(Request $request, string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            $e->name = $request->name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password);
            if($e->save()){
                return response()->json([
                    'data'=>$e,
                    'mensaje' => " Actualizado con exito.",
                ]);
            }
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' => "No se actualizo el estudiante",
            ]);
        }
    }

    public function destroy(string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            $res = User::destroy($id);
            if(isset($res)){
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'Eliminado con exito',
                ]);
            }else{
                return response()->json([
                    'data' => [],
                    'mensaje' => 'No exite',
                ]);
            }

        }else{
            return response()->json([
                'error' => true,
                'mensaje' => 'No exite',
            ]);
        }
    }
}
