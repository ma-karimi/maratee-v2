<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertChar
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $fields = $this->arrayConvert($request->all());
        $request->replace($fields);

        return $next($request);
    }

    /**
     * recursive convert data
     *
     * @param $items
     *
     * @return array
     */
    public function arrayConvert($items)
    {
        $data = [];
        foreach ($items as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->arrayConvert($value);
            } else {
                $data[$key] = toPersianCharsRequest($value);
            }
        }

        return $data;
    }
}

