<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $table ='areas';

    use HasFactory;
    static $rules =[

        'nombre' => 'require',
        ];

        protected $perpage =20;

        protected $fillable = ['nombre'];

        public function empleados(){
            return $this -> HasMany(Emple::class,'id');
        }

}
