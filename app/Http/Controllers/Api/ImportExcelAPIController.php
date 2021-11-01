<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ListQueueAPIRequest;
use App\Jobs\ProcessExcel;
use App\Models\ImportJobs;
use App\Repositories\ImportJobsRepository;
use Illuminate\Http\Request;

class ImportExcelAPIController extends AppBaseController
{
    // upload file in public and create new record in import-jobs table
    public function importFile(ListQueueAPIRequest $request)
    {
        $fileName = $this->uploadFile($request->file);
        app(ImportJobsRepository::class)->create([
            'name' => $fileName,
            'status' => 'process',
            'modelable_type' => "App\Models\\$request->tableName"
        ]);

        ProcessExcel::dispatch()->onQueue('excel');

        return $this->sendResponse([], 'فایل ارسالی در وضعیت process در صف قرار گرفت. ');
    }

    // upload excel sent in public folder
    public function uploadFile($file)
    {
        $imageName = time().'.'.$file->getClientOriginalName();
        $file->move(public_path('/importExcel'), $imageName);
        return $imageName;
    }

    public function listQueue(ListQueueAPIRequest $request)
    {
        $jobs = ImportJobs::where('modelable_type', "App\Models\\$request->tableName")->get();
        return $this->sendResponse($jobs, 'success');
    }
}
