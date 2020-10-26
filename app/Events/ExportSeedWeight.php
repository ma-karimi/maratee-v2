<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportSeedWeight
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $class;
    public $model;

    /**
     * Create a new event instance.
     *
     * @param $class
     * @param $model
     */
    public function __construct($class, $model)
    {
        //
        $this->class = $class;
        $this->model = $model;
    }
}
