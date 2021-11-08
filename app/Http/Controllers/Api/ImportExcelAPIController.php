<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ListQueueAPIRequest;
use App\Http\Requests\UploadExcelAPIRequest;
use App\Jobs\ProcessExcel;
use App\Models\ImportJobs;
use App\Repositories\ImportJobsRepository;

class ImportExcelAPIController extends AppBaseController
{
    // upload file in public and create new record in import-jobs table
    public function importFile(UploadExcelAPIRequest $request)
    {
        $fileName = $this->uploadFile($request->file);
        $job = app(ImportJobsRepository::class)->create([
            'name' => $fileName,
            'status' => 'process',
            'modelable_type' => "App\Models\\$request->modelName"
        ]);

        ProcessExcel::dispatch($request->excelName, $fileName, $job->id);
//        ProcessExcel::dispatch($request->excelName, $fileName, $job)->onQueue('excel');

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
        $jobs = ImportJobs::where('modelable_type', "App\Models\\$request->modelName")->get();
        return $this->sendResponse($jobs, 'success');
    }
}
