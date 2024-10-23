<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Operador extends Model
{
    use HasRoles, HasFactory;
    protected $guard_name = 'web';

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function eventos()
    {
        return $this->hasMany(Event::class);
    }
}
