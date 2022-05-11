<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emple;
use App\Models\Area;
use App\Models\Role;
use App\Models\EmpleRol;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class EmpleadoController extends Controller
{

    public function index()
    {

        $empleados = Emple::all();
return view('empleados.index',compact('empleados'));

    }

    public function create()
    {

     $empleados = Emple::all();

     /*$areas = Area::pluck('nombre','id'); */
     $areas =Area::all();
     $roles =Role::all();
     $emplerol = EmpleRol::all();

        return view('empleados.create',compact('areas','empleados','roles','emplerol'));

    }

    public function store(Request $request)
    {
        //Validación de reglas
        $empleadoValidate = new Emple();
        $validator = validator()->make($request->all(), $empleadoValidate->rules, $empleadoValidate->messages);

        //dd($validator);

        if ($validator->fails()) {
            return response()->json(['success' => 'false', 'mensaje' => $validator->errors()->first()]);
        }
        $emplead = Emple::create([
            'nombre'=>$request->nombre,
            'email'=>$request->email,
            'sexo'=>$request->sexo,
            'area_id'=>$request->area_id,
            'boletin'=>$request->boletin,
            'descripcion'=>$request->descripcion,
            'archivo'=> "",
        ]);
        foreach ($request->roles as $rol) {
            $emplerol = EmpleRol::create([
                'rol_id' => $rol,
                'empleado_id' => $emplead->id

            ]);
        }
        return response()->json(['success' => 'true', 'mensaje' =>'hola']);
    }



    public function show($id)
    {
        return view('empleados.show',compact('id'));

    }


    public function edit($id)
    {
        /* dd($id); */
         $empleados = Emple::findOrFail($id);
         $areas =Area::all();
        $roles = Role::all();
        $rolesEmpleado =  DB::table('empleadosrol')->where('empleado_id', $id)->get();


        return view('empleados.edit',compact('empleados','areas','roles','rolesEmpleado'));

    }


    public function update(Request $request, $id)
    {

        //Validación de reglas
        $empleadoValidate = new Emple();
        $validator = validator()->make($request->all(), $empleadoValidate->rules, $empleadoValidate->messages);

        //dd($validator);

        if ($validator->fails()) {
            return response()->json(['success' => 'false', 'mensaje' => $validator->errors()->first()]);
        }
        $emplead = Emple::findOrFail($id);
        $emplead->update([
              'nombre'=>$request->nombre,
              'email'=>$request->email,
              'sexo'=>$request->sexo,
              'area_id'=>$request->area_id,
              'boletin'=>$request->boletin,
              'descripcion'=>$request->descripcion
        ]);
        EmpleRol::where('empleado_id',$emplead->id)->delete();

        foreach ($request->roles as $rol){
            $emplerol = EmpleRol::create([
                'rol_id'=>$rol,
                'empleado_id'=>$emplead->id

            ]);
        }

        return response()->json(['success' => 'true', 'mensaje' =>'hola']);

    }


    public function destroy($id)
    {
        $emplead = Emple::findOrFail($id);

        $emplead->delete();

        return redirect()->route('empleados.index')->with('eliminar','ok');
    }
}
