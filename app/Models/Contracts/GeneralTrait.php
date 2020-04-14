<?php


namespace App\Models\Contracts;


use Illuminate\Support\Str;

trait GeneralTrait
{


    public function getActorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('authors') && $this->authors->count()) {
            $authors = $this->authors->implode('name', ' & ');
        }

        return $authors;
    }

    public function getNameAuthorAttribute()
    {
        $name = $this->name;

        if (!empty($this->actors)) {
            $name .= ' ' . $this->actors;
        }
        return $name;
    }

    public function getNameAttribute($value)
    {
        if (in_array($this->type, ['family', 'genus'])) {
            return Str::ucfirst($value);
        } elseif ($this->type === 'species') {
            return Str::lower($value);
        }

        return $value;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim($value);
    }
}
