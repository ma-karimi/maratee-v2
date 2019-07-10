<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ArticleHub;
use App\Models\Chromosome;
use App\Models\PaleontologyCitations;
use App\Models\MedicinalPlants;
use App\Models\Plants;

class Article extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['authors', 'created_at', 'deleted_at', 'journal_name', 'journal_no', 'page_no', 'title', 'type', 'updated_at', 'year'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['title' => 'json', 'type' => 'json', 'authors' => 'json', 'journal_name' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'year'];

    /**
     * @return HasMany
     */
    public function articleHubs(): HasMany
    {
        return $this->hasMany(ArticleHub::class);
    }

    /**
     * @return HasMany
     */
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class);
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlants::class);
    }

    /**
     * @return HasMany
     */
    public function paleontologyCitations(): HasMany
    {
        return $this->hasMany(PaleontologyCitations::class);
    }

    /**
     * @return HasMany
     */
    public function plants(): HasMany
    {
        return $this->hasMany(Plants::class);
    }
}
