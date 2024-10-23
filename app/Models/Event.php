<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

        // Relación inversa con el modelo Cliente
        public function cliente()
        {
            return $this->belongsTo(Cliente::class, 'placa', 'placa');
        }
    
        // Relación inversa con el modelo Parqueo
        public function parqueo()
        {
            return $this->belongsTo(Parqueo::class);
        }
    
        // Relación inversa con el modelo Operador
        public function operador()
        {
            return $this->belongsTo(Operador::class);
        }

}
