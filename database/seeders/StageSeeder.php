<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stage::create([
            'sales_funnel_id' => 1, // Funil de Produtos
            'name' => 'Contato Inicial',
            'order' => 1,
        ]);

        Stage::create([
            'sales_funnel_id' => 1,
            'name' => 'Proposta Enviada',
            'order' => 2,
        ]);

        Stage::create([
            'sales_funnel_id' => 2, // Funil de Consultoria
            'name' => 'Contato Inicial',
            'order' => 1,
        ]);

    }
}
