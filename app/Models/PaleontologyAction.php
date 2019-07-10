<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Action;
use App\Models\Paleontology;
use App\Models\User;

class PaleontologyAction extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_actions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['action_id', 'created_at', 'date', 'deleted_at', 'description', 'paleontology_id', 'updated_at', 'user_id'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'=>'json',
        'description'=>'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paleontology()
    {
        return $this->belongsTo(Paleontology::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
