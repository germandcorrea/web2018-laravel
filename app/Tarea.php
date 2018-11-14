<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
   public function proyecto()
   {
       return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id');
   }
}
