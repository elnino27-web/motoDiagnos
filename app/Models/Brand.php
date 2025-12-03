<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;
    
    // Relasi One-to-Many: 1 Brand memiliki banyak MotorType
    public function motorTypes()
    {
        return $this->hasMany(MotorType::class);
    }
}
