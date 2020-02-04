<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Models\Audit;
use App\Repositories\AuditRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class AuditAPIController
 * @package App\Http\Controllers\Api
 */
class AuditAPIController extends AppBaseController
{
    /** @var  AuditRepository */
    private $auditRepository;

    public function __construct(AuditRepository $auditRepo)
    {
        $this->auditRepository = $auditRepo;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/audits/{id}",
     *      summary="Update the specified Audit in storage",
     *      tags={"Audit"},
     *      description="Update Audit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Audit",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="status_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Audit")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *           description="",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Audit")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Audit"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Audit $audit */
        $audit = $this->auditRepository->find($id);

        if ($audit === null) {
            return $this->sendError('Audit not found');
        }
        $audit = $this->auditRepository->update($input, $id);

        return $this->sendResponse($audit->toArray(), 'Audit updated successfully');
    }
}
