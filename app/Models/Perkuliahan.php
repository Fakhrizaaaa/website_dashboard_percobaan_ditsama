<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perkuliahan extends Model
{
    protected $table = 'perkuliahan';

    protected $fillable = [
        'mata_kuliah_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'semester',
    ];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }
}