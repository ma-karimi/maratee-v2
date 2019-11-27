<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CryoBankAPIRequest;
use App\Models\CryoBank;
use App\Repositories\CryoBankRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class CryoBankController
 * @package App\Http\Controllers\Api
 */
class CryoBankAPIController extends AppBaseController
{
    /** @var  CryoBankRepository */
    private $cryoBankRepository;

    public function __construct(CryoBankRepository $cryoBankRepo)
    {
        $this->cryoBankRepository = $cryoBankRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryo_banks",
     *      summary="Get a listing of the CryoBanks.",
     *      tags={"CryoBank"},
     *      description="Get all CryoBanks",
     *      produces={"application/json"},
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/CryoBank")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $cryoBanks = $this->cryoBankRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getFieldRelations()
        );

        return $this->sendResponse($cryoBanks->toArray(), 'Cryo Banks retrieved successfully');
    }

    /**
     * @param CryoBankAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cryo_banks",
     *      summary="Store a newly created CryoBank in storage",
     *      tags={"CryoBank"},
     *      description="Store CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="sample_type_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="genotype_code",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="proposal_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="tank",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="cell",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="row",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="rack",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="proposal_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_values",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
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
     *                  ref="#/definitions/CryoBank"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CryoBankAPIRequest $request)
    {

        $cryoBank = $this->cryoBankRepository->create($request);

        return $this->sendResponse($cryoBank->toArray(), 'Cryo Bank saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryo_banks/{id}",
     *      summary="Display the specified CryoBank",
     *      tags={"CryoBank"},
     *      description="Get CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
     *          type="integer",
     *          required=true,
     *          in="path"
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
     *                  ref="#/definitions/CryoBank"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id, $this->getFieldRelations());

        if ($cryoBank === null) {
            return $this->sendError('Cryo Bank not found');
        }

        return $this->sendResponse($cryoBank->toArray(), 'Cryo Bank retrieved successfully');
    }

    /**
     * @param int $id
     * @param CryoBankAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cryo_banks/{id}",
     *      summary="Update the specified CryoBank in storage",
     *      tags={"CryoBank"},
     *      description="Update CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="sample_type_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="genotype_code",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="proposal_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="tank",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="cell",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="row",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="rack",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="proposal_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_values",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
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
     *                  ref="#/definitions/CryoBank"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, CryoBankAPIRequest $request)
    {

        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id);

        if ($cryoBank === null) {
            return $this->sendError('Cryo Bank not found');
        }

        $cryoBank = $this->cryoBankRepository->update($request, $id);

        return $this->sendResponse($cryoBank->toArray(), 'CryoBank updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/cryo_banks/{id}",
     *      summary="Remove the specified CryoBank from storage",
     *      tags={"CryoBank"},
     *      description="Delete CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
     *          type="integer",
     *          required=true,
     *          in="path"
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id);

        if ($cryoBank === null) {
            return $this->sendError('Cryo Bank not found');
        }

        $cryoBank->delete();

        return $this->sendResponse($id, 'Cryo Bank deleted successfully');
    }

    /**
     * @return array
     */
    private function getFieldRelations(): array
    {
        return ['taxonomy', 'protection', 'location', 'treatment', 'research', 'collect'];
    }

}
