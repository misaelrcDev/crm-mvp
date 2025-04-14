<?php

namespace Database\Seeders;

use App\Models\SalesFunnel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesFunnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesFunnel::create([
            'name' => 'Venda de Produtos',
            'description' => 'Processo para venda de produtos premium.',
        ]);

        SalesFunnel::create([
            'name' => 'Consultoria Empresarial',
            'description' => 'Funil para serviços de consultoria.',
        ]);

    }
}
