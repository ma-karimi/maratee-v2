<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @SWG\Definition(
 *      definition="SeedExchange",
 *      required={"seed_collection_id"},
 * )
 */
class SeedExchange extends BaseModel implements HasMedia, AuditableContract
{
    use InteractsWithMedia, Auditable, AuditTrait;

    const ORGANIZATION = ['name_en' => '', 'city' => '', 'phone' => '', 'fax' => '', 'email' => '', 'department_name' => ''];
    const SPECIMEN_TYPE_COLLECTION_NAME = [
        'Seed in Active Collection' => 'Active Collection',
        'Fruit in Active Collection' => 'Active Collection',
        'Seed in Base Collection' => 'Base Collection',
        'Fruit in Base Collection' => 'Base Collection',
        'Seed in Duplicate Collection' => 'Duplicate Collection',
        'Fruit in Duplicate Collection' => 'Duplicate Collection',
        'Regenerated seed in Active Collection' => 'Regenerated in Active Collection',
        'Regenerated fruit in Active Collection' => 'Regenerated in Active Collection',
        'Regenerated seed in Base Collection' => 'Regenerated in Base Collection',
        'Regenerated fruit in Base Collection' => 'Regenerated in Base Collection',
        'Regenerated seed in Duplicate Collection' => 'Regenerated in Duplicate Collection',
        'Regenerated  fruit in Duplicate Collection' => 'Regenerated in Duplicate Collection',
    ];
    public static $rules = [
//        'accession_code' => 'required | string',
//        'collection_id' => 'required | exists:seed_generals,id',
//        'specimen_type_id' => 'nullable | exists:seed_generals,id',
        'seed_weight_id' => 'required | exists:seed_weights,id',
        'seed_weight_value' => 'nullable | numeric',
        'fruit_weight_value' => 'nullable | numeric',
        'delivery_date' => 'nullable | date',
        'recipient_name' => 'nullable | string',
//        'recipient_phone' => 'required | string',
        'request_no' => 'nullable | string',
    ];
    protected $casts = ['organization' => 'json'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchanges';
//    protected $appends = ['last_audit'];
//    protected $with = ['audits'];

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(
            array(
                'organization' => json_encode(self::ORGANIZATION, JSON_THROW_ON_ERROR),
            ), true
        );
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedCollection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeedCollection::class, 'accession_code', 'accession_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specimenType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 28);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seed_weight(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeedWeight::class, 'seed_weight_id');
    }


    protected function processOrganizationNameFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->name_en', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationCityFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->city', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationPhoneFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->phone', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationFaxFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->fax', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationEmailFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->email', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationDepartmentFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->department_name', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }
}
