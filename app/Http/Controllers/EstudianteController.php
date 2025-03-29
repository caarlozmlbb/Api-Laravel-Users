<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index(){
        return Estudiante::all();
    }

    public function store(Request $request){
        $inputs = $request->input();
        $e = Estudiante::create($inputs);

        return response()->json([
            'data' => $e,
            'mensaje' => 'Estudiante creado con exito',
        ]);
    }

    public function update(Request $request, $id){
        $e = Estudiante::find($id);
        if(isset($e)){
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if($e->save()){
                return response()->json([
                    'data'=>$e,
                    'mensaje' => "Estudiante Actualizado con exito.",
                ]);
            }
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' => "No se actualizo el estudiante",
            ]);
        }
    }

    public function show($id){
        $e = Estudiante::find($id);
        if(isset($e)){
            return response()->json([
                'data' => $e,
                'mensaje' => 'Estudiante Encontrado con exito',
            ]);
        }else{
            return response()->json([
                'error' => true,
                'mensaje' => 'Estudiante no exite',
            ]);
        }
    }

    public function destroy($id){
        $e = Estudiante::find($id);
        if(isset($e)){
            $res = Estudiante::destroy($id);
            if(isset($res)){
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'Estudiante eliminado con exito',
                ]);
            }else{
                return response()->json([
                    'data' => [],
                    'mensaje' => 'Estudiante no exite',
                ]);
            }

        }else{
            return response()->json([
                'error' => true,
                'mensaje' => 'Estudiante no exite',
            ]);
        }
    }
}
