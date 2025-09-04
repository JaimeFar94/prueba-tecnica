<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companie;
use Illuminate\Support\Facades\Validator;

class companieController extends Controller
{
    public function index()
    {
        $companie = companie::all();

        $data = [
            'companie' => $companie,
            'status' => 200

        ];

        return response()->json($data, 200);
    }
    //Agregar información de la empresa
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nit' => 'required|unique:compani,nit',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'error al validar la información',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $companie = Companie::create([
            'nit' => $request->nit,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'estado' => 'Activo'
        ]);

        if (!$companie) {
            $data = [
                'message' => 'Error al crear una Empresa',
                'status' => 500

            ];
            return response()->json($data, 500);
        }
        $data = [
            'companie' => $companie,
            'status' => 201
        ];
        return response()->json($data, 201);
    }


    // Buscar una empresa

    public function show($id)
    {
        $companie = Companie::find($id);

        if (!$companie) {
            $data = [
                'message' => 'Empresa No Encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'companie' => $companie,
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    //Eliminar una empresa

    public function destroy($id)
    {
        $companie = Companie::find($id);

        if (!$companie) {
            $data = [
                'message' => 'Empresa No Encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        if ($companie->estado !== 'Inactivo') {
            $data = [
                'message' => 'Solo se pueden eliminar empresas inactivas',
                'status' => 400
            ];
             return response()->json($data, 400);
        }

        $companie->delete();
        $data = [
            'message' => 'Empresa Eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);


    }

    //Actualizar información
    public function update(Request $request, $id)
    {
        $companie = Companie::find($id);

        if (!$companie) {
            return response()->json([
                'message' => 'Empresa No Encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nit' => 'required|unique:compani,nit,' . $id,
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'estado' => 'in:Activo,Inactivo'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al validar los datos',
                'errores' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $companie->nit = $request->nit;
        $companie->nombre = $request->nombre;
        $companie->direccion = $request->direccion;
        $companie->telefono = $request->telefono;

        if ($request->has('estado')) {
            $companie->estado = $request->estado;
        }

        $companie->save();

        return response()->json([
            'companie' => $companie,
            'status' => 200
        ], 200);
    }


    //actualizar una parte de la información
    public function updatePartial(Request $request, $id)
    {
        $companie = Companie::find($id);

        if (!$companie) {
            $data = [
                'message' => 'Empresa No Encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nit' => 'sometimes|unique:compani,nit,' . $id,
            'nombre' => 'sometimes|string|max:255',
            'direccion' => 'sometimes|string|max:255',
            'telefono' => 'sometimes|string|max:20',
            'estado' => 'sometimes|in:Activo,Inactivo'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'error al validar la información',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Asignar solo los campos que vienen en la petición

        if ($request->has('nit')) {
            $companie->nit = $request->nit;
        }

        if ($request->has('nombre')) {
            $companie->nombre = $request->nombre;
        }

        if ($request->has('direccion')) {
            $companie->direccion = $request->direccion;
        }

        if ($request->has('telefono')) {
            $companie->telefono = $request->telefono;
        }
        if ($request->has('estado')) {
            $companie->estado = $request->estado;
        }
        $companie->save();

        $data = [
            'message' => 'Empresa Actualizada',
            'companie' => $companie,
            'status' => 200
        ];

        return response()->json($data, 200);

    }


}
