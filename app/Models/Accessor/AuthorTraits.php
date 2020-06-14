<?php


namespace App\Models\Accessor;


trait AuthorTraits
{

    public function getSpeAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('species') && !empty($this->species) && $this->species->authors->count()) {
            $authors = $this->species->authors->implode('name', ' & ');
        }

        return $authors;
    }
    public function getSubSpeAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('subspecies') && !empty($this->subspecies) && $this->subspecies->authors->count()) {
            $authors = $this->subspecies->authors->implode('name', ' & ');
        }

        return $authors;
    }
    public function getVarAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('variety') && !empty($this->variety) && $this->variety->authors->count()) {
            $authors = $this->variety->authors->implode('name', ' & ');
        }

        return $authors;
    }
}
