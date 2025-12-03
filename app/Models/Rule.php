<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    // Nama tabel pivot
    protected $table = 'rules';

    // Jika Anda ingin mengizinkan mass assignment
    protected $fillable = [
        'disease_id',
        'symptom_id',
    ];

    // Relasi Many-to-One ke Disease
    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    // Relasi Many-to-One ke Symptom
    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}
