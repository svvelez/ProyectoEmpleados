<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleRol extends Model
{
    protected $table ='empleadosrol';

    use HasFactory;

    static $rules =[

        'empleado_id' => 'require',
        'rol_id' => 'require',
        ];

        protected $perpage =20;

    protected $fillable =[
        'empleado_id',
        'rol_id'
        ];


/*         public function roles(){
            return $this ->hasMany(Role::class,'area_id');
        }
 */

public function Emple(){
    return $this ->BelongsToMany(Emple::class,'empleado_id');
}
public function roles(){
    return $this ->BelongsToMany(Role::class,'rol_id');
}


}
