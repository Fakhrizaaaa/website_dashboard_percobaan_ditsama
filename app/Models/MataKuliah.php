<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = ['kode', 'nama', 'sks', 'dosen_id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function perkuliahan(): HasMany
    {
        return $this->hasMany(Perkuliahan::class);
    }

    public function ujian(): HasMany
    {
        return $this->hasMany(Ujian::class);
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'krs', 'mata_kuliah_id', 'user_id')->withTimestamps();
    }
}