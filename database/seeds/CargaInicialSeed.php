<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Proyecto;
use App\Tarea;

class CargaInicialSeed extends Seeder
{

    function generarUsuarioAlAzar($email,$password){
        /*
        usamos Faker para generar datos al azar
        https://github.com/fzaninotto/Faker
        */
        $faker = Faker\Factory::create();

        //generamos un usuario
        $u=new User();
        $u->name=$faker->name; // nombre aleatorio
        $u->email=$email;
        $u->password=bcrypt($password); //cifrar la password
        $u->save(); // insert en la base de datos

        $totalProyectos=rand(5,10); //generar entre 5 y 10 proyectos
        for ($i=0; $i < $totalProyectos ; $i++) { 
            $p = new Proyecto;
            $p->nombre='Nombre Proyecto: '.$faker->name;
            $p->descripcion=$faker->text; // texto al azar de 200 caracteres
            $p->user_id=$u->id; // asociar el proyecto con el usuario
            $p->save();

            $totalTareas=rand(5,10); //generar entre 5 y 10 Tareas
            for ($j=0; $j < $totalTareas; $j++) { 
                $t = new Tarea();
                $t->descripcion=$faker->text; // texto al azar de 200 caracteres
                $t->proyecto_id=$p->id; // asociar la tarea al Proyecto
                $t->save();
            } //for ($j=0; $j < $totalTareas; $j++)
        } //for ($i=0; $i < $totalProyectos ; $i++)
        return $u;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Si no hay usuarios
        if(User::count()==0){
            $u1=$this->generarUsuarioAlAzar('usuario1@email.com','123456');
            $u2=$this->generarUsuarioAlAzar('usuario2@email.com','123456');
        } //if(User::count()==0)
    } //public function run
} //class CargaInicialSeed
