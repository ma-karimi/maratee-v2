<?php

namespace App\Jobs;

use App\Models\ImportJobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProcessExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $excelName, public $fileName, public $jobId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            ini_set('max_execution_time', 360000);
            Excel::import(app("App\\Imports\\" . $this->excelName), public_path('/importExcel/' . $this->fileName));
            ImportJobs::find($this->jobId)->update(['status' => 'success']);
            DB::commit();
        } catch (\Exception $e) {
            ImportJobs::find($this->jobId)->update([
                'status' => 'failed',
                'description' => $e->getMessage()
            ]);
        }
    }
}
