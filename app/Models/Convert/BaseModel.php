<?php


namespace App\Models\Convert;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'convert';
    protected $guarded = ['id'];
}
