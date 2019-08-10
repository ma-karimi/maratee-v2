<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
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
            'borrow_id'=>$this->id,
            'borrow_user_first_name'=>$this->user->first_name,
            'borrow_user_last_name'=>$this->user->last_name,
            'sheets_no'=>$this->sheets_no,
            'borrows_date'=>$this->borrows_date,
            'deadline_date'=>$this->deadline,
            'return_date'=>$this->return,
            'borrow_media'=>$this->media->name,
        ];
    }
}
