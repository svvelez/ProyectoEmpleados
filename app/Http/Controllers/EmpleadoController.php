<?php

namespace App\Http\Controllers;

use Faker\Core\File;
use Illuminate\Http\Request;
use App\Models\Emple;
use App\Models\Area;
use App\Models\Role;
use App\Models\EmpleRol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\NotificationMailable;
use Barryvdh\DomPDF\Facade\Pdf;


class EmpleadoController extends Controller
{

   public function index()
    {
       $empleados = Emple::all();
        return view('empleados.index', compact('empleados'));
    }
    public function create()
    {
        $empleados = Emple::all();
        /*$areas = Area::pluck('nombre','id'); */
        $areas = Area::all();
        $roles = Role::all();
        $emplerol = EmpleRol::all();
        return view('empleados.create', compact('areas', 'empleados', 'roles', 'emplerol'));
    }

    public function store(Request $request)
    {
        //Validación de reglas
        $empleadoValidate = new Emple();
        $validator = validator()->make($request->all(), $empleadoValidate->rules, $empleadoValidate->messages);

        if ($validator->fails()) {
            return response()->json(['success' => 'false', 'mensaje' => $validator->errors()->first()]);
        }

        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('archivos');
        }

        $emplead = Emple::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'sexo' => $request->sexo,
            'area_id' => $request->area_id,
            'boletin' => $request->boletin,
            'descripcion' => $request->descripcion,
            'archivo' => $path

        ]);
        foreach ($request->roles as $rol) {
            $emplerol = EmpleRol::create([
                'rol_id' => $rol,
                'empleado_id' => $emplead->id

            ]);

        }
        $destino_nombre=$request->nombre;
        $destino_email=$request->email;
        $email = new \App\Mail\NotificationMailable($emplead);
        Mail::to($destino_email)->send($email);

        return response()->json(['success' => 'true', 'mensaje' => 'hola']);
    }

    public function show($id)
    {
        return view('empleados.show', compact('id'));
    }

    public function edit($id)
    {
        /* dd($id); */
        $empleados = Emple::findOrFail($id);
        $areas = Area::all();
        $roles = Role::all();
        $rolesEmpleado = DB::table('empleadosrol')->where('empleado_id', $id)->get();
        return view('empleados.edit', compact('empleados', 'areas', 'roles', 'rolesEmpleado'));
   }

    public function update(Request $request, $id)
    {
        //Validación de reglas
        $empleadoValidate = new Emple();
        $validator = validator()->make($request->all(), $empleadoValidate->rules, $empleadoValidate->messages);

       if ($validator->fails()) {
            return response()->json(['success' => 'false', 'mensaje' => $validator->errors()->first()]);
        }
        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('archivos');
        }
        $emplead = Emple::findOrFail($id);
        $emplead->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'sexo' => $request->sexo,
            'area_id' => $request->area_id,
            'boletin' => $request->boletin,
            'descripcion' => $request->descripcion,
            'archivo' => $path
        ]);
        EmpleRol::where('empleado_id', $emplead->id)->delete();

        foreach ($request->roles as $rol) {
            $emplerol = EmpleRol::create([
                'rol_id' => $rol,
                'empleado_id' => $emplead->id

            ]);
        }
        return response()->json(['success' => 'true', 'mensaje' => 'hola']);
    }


    public function destroy($id)
    {
        $emplead = Emple::findOrFail($id);

        $emplead->delete();

        return redirect()->route('empleados.index')->with('eliminar', 'ok');
    }
    public function exportPdf(){
           $emplead = Emple::all();

           view()->share('emplead',$emplead);
           $pdf = PDF::loadView('empleados.downloandPdf');
           return $pdf->download('emplead.pdf');
   }
}
