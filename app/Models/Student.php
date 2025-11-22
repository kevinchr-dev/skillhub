<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = ['name', 'email', 'phone'];

    public function newUniqueId()
    {
        return (string) Str::uuid7();
    }

    // Relasi: Seorang Student bisa memiliki banyak Course
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
}
