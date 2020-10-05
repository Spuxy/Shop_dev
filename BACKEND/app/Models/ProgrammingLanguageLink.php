<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguageLink extends Model
{
  use HasFactory;
  protected $fillable = ['repository_id', 'programming_language_id'];

  public function lang()
  {
    return $this->belongsTo(ProgrammingLanguage::class);
  }
  public function repo()
  {
    return $this->belongsTo(Repository::class);
  }
}
