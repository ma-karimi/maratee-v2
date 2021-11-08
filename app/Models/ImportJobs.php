<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportJobs extends Model
{
    use HasFactory;

    protected $table = "import_jobs";

    protected $fillable = [
        'name' , 'status' , 'modelable_type', 'modelable_id', 'description'
    ];

    public $status = [
        'process' => 'در حال پردازش',
        'faild' => 'ناموفق',
        'success' => 'موفق'
    ];
}

