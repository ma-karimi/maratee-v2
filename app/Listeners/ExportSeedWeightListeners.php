<?php


namespace App\Listeners;


use App\Events\ExportSeedWeight;
use App\Exports\ExcelExport;
use Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportSeedWeightListeners
{
    public function handle(ExportSeedWeight $event)
    {
        Excel::store(new ExcelExport($event->result, \request('model')), 'public/' . $event->file, null, 'Xlsx');
        return Cache::put('seed_weight_excel', Storage::url($event->file), 3600);
    }
}
