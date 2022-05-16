<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emple extends Model
{

    protected $table ='empleados';

   use HasFactory;
    public $rules =[

        'area_id' => 'required',
        'nombre' => 'required',
        'email' => 'required|email',
        'sexo' => 'required',
        /*'boletin' => 'required',*/
        'descripcion' => 'required',
        //'archivo'=>'required',
        'roles' => 'required',

        ];

    public $messages =[
        'area_id.required' => 'Seleccione el área',
        'nombre.required' => 'Ingrese nombre',
        'email.required' => 'Ingrese Correo',
        'sexo.required' => 'Seleccione sexo',
        'descripcion.required' => 'Ingrese descripción',
        'roles.required' => 'Seleccione el rol',
        //'archivo.required'=>'Seleccione una imagen',
        'email.email' => 'ingrese un formato correcto de email',

    ];

   protected $perpage =20;

    protected $fillable =[

        'area_id',
        'nombre',
        'email',
        'sexo',
        'boletin',
        'descripcion',
        'archivo',

        ];

        public function areas(){
            return $this ->BelongsTo(Area::class,'area_id');
        }

        public function roles(){
            return $this ->BelongsToMany(EmpleRol::class,'id');
        }


}
