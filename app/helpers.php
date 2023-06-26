<?php

/**
* Define a custom function to extract the surname from a name string
*
* @return void
*/
if (!function_exists('get_surname_from_name')) {
    function get_surname_from_name($name)
    {
        $parts = explode(' ', $name);
        return end($parts);
    }
}

/**
* Slugify a string
*
* @return void
*/
function slugify($string) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    $slug = str_replace('-amp-', '-', $slug); // Add this line to replace 'amp' with '&'
    return $slug;
}

/**
 * Un-Slugify a string
 *
 * @return void
 */
function unslugify($string) {
    $string = str_replace('-', ' ', $string);
    $string = ucwords($string);
    return $string;
}
