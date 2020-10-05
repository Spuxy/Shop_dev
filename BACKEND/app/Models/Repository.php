<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_private', 'url', 'id'];

    public function languages()
    {
        return $this->belongsToMany(ProgrammingLanguage::class, 'programming_language_links');
    }
}
