<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public $timestamps = false;
    protected $fillable = ['isbn', 'titulo', 'autor', 'num_ejemplares', 'nivel'];

    //hasMany = tiene muchos
    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_libro');
    }
}
