<?php


namespace App\Traits;


use App\Models\General;

trait GeneralAble
{

    // use update because parent_id is different

    public function getGeneralId(string $type, $name, int $parent_id = null): int
    {
        if (empty($name))
            return null;
        $name = trim($name);
        $general = General::where(['name->en', $name])->first();
        if ($general instanceof General)
            return $general->id;
        $name = ['en' => $name];
        $general = General::create(compact('type', 'name'));
        $general->update(compact('parent_id'));
        return $general->id;
    }
}
