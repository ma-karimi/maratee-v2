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


class FloraExport implements FromView, ShouldAutoSize
{
    private $result;


    /**
     * FloraExport constructor.
     * @param $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    public function view(): View
    {
        $result = $this->result;
        return view("excels.flora", ['result' => $result, 'keys' => \request('keys')]);
    }
}
