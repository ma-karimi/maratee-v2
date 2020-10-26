<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 3/8/2018
 * Time: 1:33 PM
 */

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SeedWeightExport implements FromView, ShouldAutoSize
{
    private $result;
    private $model;


    /**
     * FloraExport constructor.
     * @param $result
     * @param $model
     */
    public function __construct($result, $model)
    {
        $this->result = $result;
        $this->model = $model;
    }

    public function view(): View
    {
        ini_set('max_execution_time', 9000);
        ini_set('memory_limit', '-1');
        $result = $this->result;
        $model = $this->model;
        return view("excels.${model}", ['result' => $result, 'keys' => \request('keys')]);
    }
}
