<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'motor_type_id',
        'name',
        'description',
        'solution'
    ];
    
    public $timestamps = false;

    // Relasi Many-to-One: 1 Disease milik 1 MotorType
    public function motorType()
    {
        return $this->belongsTo(MotorType::class);
    }

    // Relasi Many-to-Many (melalui tabel 'rules'): Disease terhubung ke Symptom
    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'rules', 'disease_id', 'symptom_id');
    }
}
