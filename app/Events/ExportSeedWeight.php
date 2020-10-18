<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportSeedWeight
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $result;
    public $file;

    /**
     * Create a new event instance.
     *
     * @param $result
     * @param $file
     */
    public function __construct($result, $file)
    {
        //
        $this->result = $result;
        $this->file = $file;
    }
}
