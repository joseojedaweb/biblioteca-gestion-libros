<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_libro', 'id_curso', 'fecha', 'nombre_alumno', 'apellido1_alumno', 'apellido2_alumno'];


    //pertenece a = 1 a 1
    public function libro(){
        return $this->belongsTo(Libro::class, 'id_libro');
    }


    //pertenece a = 1 a 1
    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso');

    }
}
