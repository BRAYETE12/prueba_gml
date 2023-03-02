<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persona extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','categoria_id','nombres','apellidos','cedula','email','celular','pais','direccion'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
    
}
