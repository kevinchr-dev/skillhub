<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = ['name', 'description', 'instructor'];

    public function newUniqueId()
    {
        return (string) Str::uuid7();
    }

    // Relasi: Sebuah Course bisa dimiliki banyak Student
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }
}
