<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Curso_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create([
            'nome_curso' => 'Desenvolvimento Web',
            'descricao_curso' => 'Desenvolvimento de sistemas web utilizando HTML, CSS e JavaScript',
            'modcurso_id' => 1,
        ]);
        Curso::create([
            'nome_curso' => 'Desenvolvimento Mobile',
            'descricao_curso' => 'Desenvolvimento de aplicativos móveis utilizando Java e Kotlin',
            'modcurso_id' => 2,
        ]);
        Curso::create([
            'nome_curso' => 'Desenvolvimento de Jogos',
            'descricao_curso' => 'Desenvolvimento de jogos utilizando Unity e C#',
            'modcurso_id' => 2,
        ]);
    }
}
