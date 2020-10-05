<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    use HasFactory;
	protected $fillable = ['name'];

	public function repositories() {
		return $this->belongsToMany(Repository::class, 'programming_language_links_table');
	}
}
