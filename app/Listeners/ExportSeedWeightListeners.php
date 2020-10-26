<?php


namespace App\Listeners;


use App\Events\ExportSeedWeight;
use App\Exports\ExcelExport;
use Cache;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportSeedWeightListeners implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 0;


    /**
     * Determine whether the listener should be queued.
     *
     * @param ExportSeedWeight $event
     * @return bool
     */
    public function handle(ExportSeedWeight $event)
    {
        ini_set('max_execution_time', 9000);
        ini_set('memory_limit', '-1');
        $name = Str::singular(Str::studly($event->class));
        $repo = 'App\\Repositories\\' . $name . 'Repository';
        $repo = resolve($repo);

        $result = $repo->all()->load(collect(Arr::flatten($repo->model()::getAllRelations()))->filter(function ($value) {
            return $value != 'audits';
        })->all());


        $model = $event->model;
        $model = Str::ucfirst($model);
        $file_excel = "Export${model}List-" . date('Y-m-d-H-i-s') . '.xlsx';
        Excel::store(new ExcelExport($result, $model), 'public/' . $file_excel, null, 'Xlsx');
        return Cache::put('seed_weight_excel', Storage::url($file_excel), 3600);
    }
}
