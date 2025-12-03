<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorType extends Model
{
    use HasFactory; 

    // Wajib: Mengizinkan Mass Assignment untuk foreign key dan field 'name'
    protected $fillable = [
        'brand_id',
        'name'
    ];
    
    // Wajib: Menonaktifkan timestamps agar sinkron dengan skema database Anda
    public $timestamps = false; 

    /**
     * Relasi: Tipe Motor dimiliki oleh satu Brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi: Satu Tipe Motor memiliki banyak Gejala.
     */
    public function symptoms()
    {
        return $this->hasMany(Symptom::class);
    }

    /**
     * Relasi: Satu Tipe Motor memiliki banyak Penyakit.
     */
    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }
}