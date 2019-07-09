<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaleontologyMedias extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_medias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'credential_correspondence_id', 'credential_expense_id', 'credential_fair_id', 'credential_gift_id', 'credential_purchase_id', 'deleted_at', 'exchange_id', 'media_id', 'paleontology_id', 'updated_at', 'user_id'];

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
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

}
