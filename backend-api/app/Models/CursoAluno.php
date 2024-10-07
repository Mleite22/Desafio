<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class CursoAluno extends Model
{
    use HasFactory;
    protected $table = 'cursoaluno';
    protected $fillable = [
        'curso_id',
        'user_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
