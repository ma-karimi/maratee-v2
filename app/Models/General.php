<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="General",
 *      required={"name","type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class General extends BaseModel
{
    use GeneralScope;
    public static $linguistically = ['name' => false, 'description' => false];
    public static $rules = array(
        'type' => 'required|string',
        'parent_id' => 'integer',
    );

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $table = 'generals';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Author::class, 'morph_author')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function genusParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function speciesParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function subspeciesParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function varietyParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->withDefault();
    }

    /**
     * @return HasMany
     */
    public function familyChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function genusChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function speciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }

    /**
     * @return HasMany
     */
    public function subspeciesChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->where('type', 'genus');
    }
}
