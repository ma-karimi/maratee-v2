<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ListQueueAPIRequest;
use App\Http\Requests\UploadExcelAPIRequest;
use App\Jobs\ProcessExcel;
use App\Models\ImportJobs;
use App\Repositories\ImportJobsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImportExcelAPIController extends AppBaseController
{
    // upload file in public and create new record in import-jobs table
    /**
     * @param UploadExcelAPIRequest $request
     * @return mixed
     */
    public function importFile(UploadExcelAPIRequest $request): mixed
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

    /**
     * @param $file
     * @return string
     */
    public function uploadFile($file): string
    {
        $imageName = time().'.'.$file->getClientOriginalName();
        $file->move(public_path('/importExcel'), $imageName);
        return $imageName;
    }

    /**
     * @param ListQueueAPIRequest $request
     * @return mixed
     */
    public function listQueue(ListQueueAPIRequest $request): mixed
    {
        $jobs = ImportJobs::where('modelable_type', "App\Models\\$request->modelName")->get();
        return $this->sendResponse($jobs, 'success');
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function getDownloadExcel(Request $request): BinaryFileResponse
    {
        $file= public_path(). "/excels/".$request->filename.".xlsx";
        return Response::download($file, "$request->filename.xlsx");
    }
}
