<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'curso';
    protected $fillable = [
        'nome_curso',
        'descricao_curso',
        'modcurso_id',

    ];
}
