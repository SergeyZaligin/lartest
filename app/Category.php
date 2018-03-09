<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // Mass assigned
    protected $fillable = [
        'title', 
        'slug', 
        'parent_id', 
        'published', 
        'created_by', 
        'modified_by'
    ];

    // Mutators
    public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    /**
     * Поиск дочерних категорий
     */
    public function children()
    {
        /** 
         * В начале указывается ссылка на текущую модель 
         * App\category или self::class
        */
        return $this->hasMany(self::class, 'parent_id');
    }
}
