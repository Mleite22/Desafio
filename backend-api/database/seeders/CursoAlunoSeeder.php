<?php

namespace Database\Seeders;

use App\Models\CursoAluno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoAlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CursoAluno::create([
            'curso_id' => 1,
            'user_id' => 2,
        ]);

        CursoAluno::create([
            'curso_id' => 2,
            'user_id' => 1,
        ]);


    }
}
