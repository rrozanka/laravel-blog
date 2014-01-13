<?php

/**
 * navLink macro
 *
 */
HTML::macro('navLink', function($url, $text, $params = []) {
    if (Request::is($url)) {
        if (isset($params['class'])) {
            $params['class'] = $params['class'] . ' active';
        } else {
            $params['class'] = 'active';
        }
    }

    return HTML::link($url, $text, $params);
});