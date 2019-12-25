<?php


use Illuminate\Support\Facades\App;

function make_json($string)
{
    return ['fa' => $string, 'en' => $string, 'es' => $string];
}

if (!function_exists('generateRandomToken')) {
    function generateRandomToken($length = 6): int
    {
        if (App::environment('local') || App::environment('testing')) {
            $rand_id = str_pad('', $length, '1');
        } else {
            $faker = Faker\Factory::create();
            $rand_id = $faker->numerify(str_pad('', $length, '%'));
        }

        return (int)$rand_id;
    }

}

if (!function_exists('toPersianCharsRequest')) {
    function toPersianCharsRequest($string = null)
    {
        $chars = config('farsi.arabic_to_farsi');
        $arabicChars = array_keys($chars);
        $farsiChars = array_values($chars);

        return str_replace($arabicChars, $farsiChars, $string);
    }
}
if (!function_exists('toPersianChars')) {
    function toPersianChars($string = null)
    {
        $chars = config('farsi.arabic_to_farsi');
        $arabicChars = array_keys($chars);
        $farsiChars = array_values($chars);

        return str_replace($arabicChars, $farsiChars, $string);
    }
}
if (!function_exists('toPersianNumbers')) {
    function toPersianNumbers($string = null)
    {
        $chars = config('farsi.en_to_fa_numbers');
        $eng = array_keys($chars);
        $fa = array_values($chars);

        return str_replace($eng, $fa, $string);
    }
}
