<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $timestamps = false;
    protected $fillable = ['curso', 'grupo'];

    //hasMany = tiene muchos
    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_curso');
    }
}
