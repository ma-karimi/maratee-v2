<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HerbariumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'herbarium_id' => $this->id,
            'herbarium_number' => $this->number,
            'herbarium_name' => $this->name,
            'herbarium_department' => $this->department->name ?? null,
            'herbarium_division' => $this->division->name ?? null,
            'herbarium_samples_count' => $this->samples_no,
            'herbarium_sheets_count' => $this->sheets_no,
            'herbarium_tips_count' => $this->tip_qt,
            'herbarium_tip_type' => $this->tip_type,
            'herbarium_physical_tip_count' => $this->physical_tip_qt,
            'herbarium_tip_location_count' => $this->herbarium_tip_location,
            'herbarium_flowering' => $this->flowering,
            'herbarium_collecting_note' => $this->actionHubs('collect:id,description'),
            'herbarium_collecting_date' => $this->actionHubs('collect:id,date'),
            'herbarium_collecting_people' => $this->actionHubs('collect.user'),
            'herbarium_collecting_determinator' => $this->actionHubs('determinator.user'),
            'herbarium_ecology'=>'NOT IMPLEMENT',
            'herbarium_ecology_description'=>'NOT IMPLEMENT',
            'herbarium_habitat'=>'NOT IMPLEMENT',
            'herbarium_habitat_description'=>'NOT IMPLEMENT',
            'herbarium_phytogeography'=>$this->generalPhytogeography->name,
            'herbarium_phenology'=>$this->generalPhenology->name,
            'herbarium_protection'=>$this->protection->name,
            'attendances'=>AttendanceResource::collection($this->attendances),
            'borrow'=>BorrowResource::collection($this->borrows),
            'exchange'=>'NOT IMPLEMENT',
        ];
    }
}
