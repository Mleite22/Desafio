<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAluno extends Model
{
    use HasFactory;
    protected $table = 'cursoaluno';
    protected $fillable = [
        'nome_curso',
        'descricao_curso',
        // 'modcurso_id',
    ];
}
