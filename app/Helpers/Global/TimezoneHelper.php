<?php

use JamesMills\LaravelTimezone\Timezone;

if (! function_exists('timezone')) {
    /**
     * Access the timezone helper.
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}

if (! function_exists('formatDate')) {
    /**
     * Access the timezone helper.
     */
    function formatDate($date,$format)
    {
        return \Carbon\Carbon::parse($date)->setTimezone(!empty(auth()->user->timezone) ? auth()->user->timezone : 'Asia/Singapore')->format($format);
    }
}
