<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="TransactionEvidence",
 *      required={"transaction_id","description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="transaction_id",
 *          description="transaction_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="src",
 *          description="src",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="end_time",
 *          description="end_time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="type_id",
 *          description="'1: visit, 2: borrow, 3: exchange, 4:gift, 5:fair 6:expense 7:correspondence'",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="archive_no",
 *          description="archive_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="purpose",
 *          description="purpose",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="visit",
 *          description="1: Sample, 2: All/Museum",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="peoples_no",
 *          description="peoples_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="person_position",
 *          description="person_position",
 *         type="array",
 *          @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class TransactionEvidence extends Model
{
    //
}
