<?php


use Illuminate\Support\Facades\App;

function make_json($string)
{
    return ['fa' => $string, 'en' => $string, 'es' => $string];
}

function make_slug($string, $separator = '-')
{
    $string = trim($string);
    $string = mb_strtolower($string, 'UTF-8');

    /*
        ء-ي standard letters
        پچژکگیۃۂۀہ other common letters
        ۰-۹ persian digits
        ٠-٩ arabic digits
        ٱ-ۓ non standard arabic
        ،-۹ all and everything
    */

    $string = preg_replace("/[^a-z0-9_\s-ء-يپچژکگیۃۂۀہ]/u", '', $string);
    $string = preg_replace("/[\s-_]+/", ' ', $string);
    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}

if (!function_exists('getDateTimeFromCalendar')) {

    function getDateTimeFromCalendar(
        $locale = 'fa_IR',
        $calendar = 'persian',
        $time = null,
        $timeZone = 'Asia/Tehran'
    ): array
    {
        if (empty($time)) {
            $time = new \DateTime();
        }

        $formatter = new \IntlDateFormatter(
            "{$locale}@calendar={$calendar}",
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL,
            $timeZone,
            \IntlDateFormatter::TRADITIONAL
        );
        $dateArray = [];

        $formatter->setPattern('yy');
        $dateArray['year'] = $formatter->format($time);

        $formatter->setPattern('MM');
        $dateArray['month'] = $formatter->format($time);

        $formatter->setPattern('dd');
        $dateArray['day'] = $formatter->format($time);

        return $dateArray;
    }
}
if (!function_exists('getDateTimeFromCalendarToFormat')) {
    function getDateTimeFromCalendarToFormat(
        $format = 'yyyy-MM-dd HH:mm:ss',
        $time = null,
        $locale = 'fa_IR',
        $calendar = 'persian',
        $timeZone = 'Asia/Tehran'
    ): string
    {
        if (empty($time)) {
            $time = new \DateTime();
        }

        $formatter = new \IntlDateFormatter(
            "{$locale}@calendar={$calendar}",
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL,
            $timeZone,
            \IntlDateFormatter::TRADITIONAL
        );
        $formatter->setPattern($format);

        return $formatter->format($time);
    }
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

if (!function_exists('isIsoDate')) {
    function isIsoDate($value = null)
    {
        try {
            if (
            preg_match(
                '/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})[-+]((\d{4})|(\d{2}:\d{2}))$/',
                $value,
                $parts
            )
            ) {
                return Carbon::parse($value);
            }
        } catch (\Exception $e) {
        }

        return false;
    }
}

if (!function_exists('isIsoDateRange')) {
    function isIsoDateRange($value = null)
    {
        try {
            if (isIsoDate($value[0]) && isIsoDate($value[1])) {
                return carbon($value[0])->lt(carbon($value[1]));
            }
        } catch (\Exception $e) {
        }

        return false;
    }
}

if (!function_exists('getRealQuery')) {
    function getRealQuery($query, $dumpIt = false)
    {
        $params = array_map(
            function ($item) {
                return "'{$item}'";
            },
            $query->getBindings()
        );
        $result = str_replace_array('?', $params, $query->toSql());

        if ($dumpIt) {
            dd($result);
        }

        return $result;
    }
}
