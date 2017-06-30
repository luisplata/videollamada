<?php

use Illuminate\Database\Seeder;
use App\Empresa;
use App\Root;
use Illuminate\Support\Facades\Hash;

class Empresas_roots_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creacion de la primera empresa
        $empresa = new Empresa();
        $empresa->nombre = "Nabu";
        $empresa->email = "nabu@nabu.com.co";
        $empresa->telefono = "3015086264";
        $empresa->pass = Hash::make("nabu");
        $empresa->save();
        
        //Creando el primer root
        $root = new Root();
        $root->user = "luisplata";
        $root->pass = Hash::make("luisplata");
        $root->save();
        
    }
}
