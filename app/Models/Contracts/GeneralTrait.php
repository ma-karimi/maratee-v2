<?php


namespace App\Models\Contracts;


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
}
