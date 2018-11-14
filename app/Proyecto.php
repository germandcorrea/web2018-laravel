<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class,'proyecto_id', 'id');
    }
}
