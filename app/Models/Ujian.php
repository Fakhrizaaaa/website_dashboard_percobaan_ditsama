<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ujian extends Model
{
    protected $table = 'ujian';

    protected $fillable = [
        'mata_kuliah_id', 'jenis', 'tanggal', 'jam_mulai', 'jam_selesai', 'ruangan',
    ];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }
}