<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Income;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['label'=>'1/2 Pollo adobado', 'unit_price'=> '60','unit'=>'piece'],
            ['label'=>'1/2 Pollo clásico', 'unit_price'=> '55','unit'=>'piece'],
            ['label'=>'Adobo extra', 'unit_price'=> '10','unit'=>'piece'],
            ['label'=>'Aguacate', 'unit_price'=> '70','unit'=>'kg'],
            ['label'=>'Arroz', 'unit_price'=> '25','unit'=>'piece'],
            ['label'=>'Bolsa CH', 'unit_price'=> '3','unit'=>'piece'],
            ['label'=>'Bolsa G', 'unit_price'=> '5','unit'=>'piece'],
            ['label'=>'Chicharrón CH', 'unit_price'=> '20','unit'=>'piece'],
            ['label'=>'Chicharrón G', 'unit_price'=> '30','unit'=>'piece'],
            ['label'=>'Cebolla', 'unit_price'=> '20','unit'=>'kg'],
            ['label'=>'Chilaquiles', 'unit_price'=> '60','unit'=>'piece'],
            ['label'=>'Chiles', 'unit_price'=> '20','unit'=>'piece'],
            ['label'=>'Flautas Ahogadas', 'unit_price'=> '35','unit'=>'piece'],
            ['label'=>'Frijoles', 'unit_price'=> '25','unit'=>'piece'],
            ['label'=>'Gordita/Tlacoyo', 'unit_price'=> '20','unit'=>'piece'],
            ['label'=>'Masa', 'unit_price'=> '16','unit'=>'kg'],
            ['label'=>'Masa Mayoreo', 'unit_price'=> '10','unit'=>'piece'],
            ['label'=>'Mayoreo $13', 'unit_price'=> '13','unit'=>'piece'],
            ['label'=>'Mayoreo $14', 'unit_price'=> '14','unit'=>'piece'],
            ['label'=>'Mayoreo $15', 'unit_price'=> '15','unit'=>'piece'],
            ['label'=>'Medio Kg tienda', 'unit_price'=> '14','unit'=>'piece'],
            ['label'=>'Membresía', 'unit_price'=> '150','unit'=>'piece'],
            ['label'=>'Arroz G', 'unit_price'=> '45','unit'=>'piece'],
            ['label'=>'Kachi Papas', 'unit_price'=> '30','unit'=>'piece'],
            ['label'=>'Papitas 1/4x$30', 'unit_price'=> '120','unit'=>'kg'],
            ['label'=>'Paquete Chico', 'unit_price'=> '75','unit'=>'piece'],
            ['label'=>'Paquete Completo', 'unit_price'=> '170','unit'=>'piece'],
            ['label'=>'Paquete Grande', 'unit_price'=> '120','unit'=>'piece'],
            ['label'=>'Pescuezos 5x$10', 'unit_price'=> '10','unit'=>'piece'],
            ['label'=>'Platanitos', 'unit_price'=> '15','unit'=>'piece'],
            ['label'=>'Pollo Adobado', 'unit_price'=> '110','unit'=>'piece'],
            ['label'=>'Pollo Clásico', 'unit_price'=> '99','unit'=>'piece'],
            ['label'=>'Pollo Promoción', 'unit_price'=> '89','unit'=>'piece'],
            ['label'=>'Salchicha Extra', 'unit_price'=> '4','unit'=>'piece'],
            ['label'=>'Salchicha 3x$10', 'unit_price'=> '10','unit'=>'piece'],
            ['label'=>'Salsa', 'unit_price'=> '18','unit'=>'piece'],
            ['label'=>'Salsa aceite', 'unit_price'=> '20','unit'=>'piece'],
            ['label'=>'Torta de Pollo', 'unit_price'=> '35','unit'=>'piece'],
            ['label'=>'Torta de Especial', 'unit_price'=> '38','unit'=>'piece'],
            ['label'=>'Tortilla de Harina', 'unit_price'=> '20','unit'=>'piece'],
            ['label'=>'Tortilla Membresía', 'unit_price'=> '15','unit'=>'kg'],
            ['label'=>'Tortilla Monto', 'unit_price'=> '','unit'=>'amount'],
            ['label'=>'Tortilla KG', 'unit_price'=> '','unit'=>'amount'],
            ['label'=>'Totopos', 'unit_price'=> '18','unit'=>'piece'],
            ['label'=>'Totopos Mayoreo', 'unit_price'=> '36','unit'=>'kg'],
            ['label'=>'General', 'unit_price'=> '0','unit'=>'piece'],
        ];

        Product::insert($products);

        
    }
}

