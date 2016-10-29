<?php

if (! function_exists('pluralize')) {
    function pluralize($string) {
        return \Core\Pluralize::pluralize($string);
    }
}