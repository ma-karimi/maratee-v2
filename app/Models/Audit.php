<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class Audit extends \OwenIt\Auditing\Models\Audit
{
    public const STATUS = [0 => 'In Progress', 1 => 'Verified', 2 => 'Declined'];
    protected $appends = ['message', 'status', 'variant'];
    protected $with = ['user'];
    protected $hidden = ['old_values', 'new_values', 'url', 'ip_address', 'user_agent', 'tags', 'user_type', 'user_id', 'user', 'auditable_type', 'auditable_id', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function (Builder $builder) {
            $builder->latest('id');
        });
    }

    public function getStatusAttribute()
    {
        return Arr::get(self::STATUS, $this->status_id);
    }

    public function getMessageAttribute()
    {

        $user_name = $this->user->name;
        $time = $this->created_at;
        if ($this->status_id == 0) {
            return "This Record Modified By ${user_name} at ${time}";
        } elseif ($this->status_id == 1) {
            return "This Record Approved By ${user_name} at ${time}";
        } else {
            return "This Record Declined By ${user_name} at ${time}";

        }


    }

    public function getVariantAttribute()
    {

        if ($this->status_id == 0) {
            return 'warning';
        } elseif ($this->status_id == 1) {
            return 'success';
        } else {
            return 'danger';

        }


    }
}
