<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class DurationFormatter extends Modifier
{
    protected static $handle = 'format_duration';
    /**
     * Modify a value.
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        $hours = floor($value / 3600);
        $minutes = floor(($value / 60) % 60);
        $seconds = $value % 60;

        $formattedDuration = [];

        if ($hours) {
            $formattedDuration[] = "{$hours}h";
        }
        if ($minutes || $hours) {  // Always display minutes if there are hours.
            $formattedDuration[] = "{$minutes}m";
        }
        $formattedDuration[] = "{$seconds}s";

        return implode(' ', $formattedDuration);
    }
}
