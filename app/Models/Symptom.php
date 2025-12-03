<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'motor_type_id',
        'name'
    ];
    
    public $timestamps = false;

    // Relasi Many-to-One: 1 Symptom milik 1 MotorType
    public function motorType()
    {
        return $this->belongsTo(MotorType::class);
    }

    // Relasi Many-to-Many (melalui tabel 'rules'): Symptom terhubung ke Disease
    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'rules', 'symptom_id', 'disease_id');
    }
}
