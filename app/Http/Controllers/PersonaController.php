<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class PersonaController extends Controller
{

    public function index()
    {
        $personas = Persona::all();
        return $personas;
    }


    public function store(Request $request)
    {
        $inputs = $request->input();
        $persona = Persona::create($inputs);

        return response()->json([
            'data' => $persona,
            'mensaje' => 'Persona creada con exito'
        ]);
    }


    public function show(string $id)
    {

    }


    public function update(Request $request, string $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json([
                'error' => 'Persona no encontrada',
            ], 404);
        }

        if ($request->has('nombre')) {
            $persona->nombre = $request->nombre;
        }
        if ($request->has('apellido')) {
            $persona->apellido = $request->apellido;
        }
        if ($request->has('carnet')) {
            $persona->carnet = $request->carnet;
        }
        if ($request->has('edad')) {
            $persona->edad = $request->edad;
        }

        if ($persona->save()) {
            return response()->json([
                'data' => $persona,
                'mensaje' => 'Persona actualizada con éxito.',
            ]);
        } else {
            return response()->json([
                'error' => 'Ocurrió un error al actualizar la persona',
            ], 500);
        }
    }


    public function destroy(string $id)
    {
        $persona = Persona::find($id);

        if($persona){
            $p = Persona::find($id);
            $p->delete();
            return response()->json([
                'data' => $persona,
                'mensaje' => 'Eliminado con exito'
            ]);
        }else{
            return response()->json([
                'error' => [],
                'mensaje' => 'Persona no encontrada',
            ]);
        }
    }
}
