<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;
    public $table = 'cursos';

    protected $fillable = [
        'nombre',
        'horas',
    ];

    public $timestamps = true;

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, "curso_estudiante");
    }
}
