<?php

/**
 * Set active item
 *
 * @param string $path
 * @param string $active
 * @return mixed
 */
function setActive($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}

/**
 * Create slug
 * @param  string $string
 * @return string [slug]
 */
function createSlug($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}