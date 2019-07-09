<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessments extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assessments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['abnormality', 'created_at', 'date', 'deleted_at', 'description', 'dropped', 'dry_material_rate', 'dry_unit_weight', 'hard_seed', 'hollow', 'losses', 'purity', 'repeat', 'root_length', 'root_stem_rate', 'seed_length', 'seed_qt', 'seed_width', 'seedling_length', 'sprout', 'sprout_index', 'sprout_rate', 'stem_length', 'treatment', 'updated_at', 'vigor', 'vigor_index', 'weight_k', 'wet_uint_weight'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

}
