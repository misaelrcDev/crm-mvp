<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opportunity::create([
            'stage_id' => 1,
            'contact_id' => 1,
            'title' => 'Venda de Software XYZ',
            'value' => 1500.00,
            'notes' => 'Cliente interessado em planos anuais.',
        ]);

        Opportunity::create([
            'stage_id' => 2,
            'contact_id' => 2,
            'title' => 'Consultoria Financeira',
            'value' => 3000.00,
            'notes' => 'Cliente quer orçamento detalhado.',
        ]);

    }
}
