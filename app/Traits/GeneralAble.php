<?php


namespace App\Traits;


use App\Models\General;

trait GeneralAble
{

    // use update because parent_id is different

    public function getGeneralId(string $type, $name, int $parent_id = null)
    {
        if (empty($name))
            return null;
        $name = trim($name);
        $general = General::firstOrCreate(compact('type', 'name'));
        $general->update(compact('parent_id'));
        return $general->id;
    }
}
