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


class ExcelExport implements FromView, ShouldAutoSize
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
        $result = $this->result;
        $model = $this->result;
        return view("excels.${model}", ['result' => $result, 'keys' => \request('keys')]);
    }
}
