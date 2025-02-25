<?php

if (! function_exists('create_tenant_home_url')) {
    function create_tenant_home_url(string $domain, bool $withoutPrefix = false): string
    {
        // $prefix = get_url_preffix();
        // $suffix = get_url_suffix();

        // if ($withoutPrefix) {
        //     $prefix = '';
        // }
        $url = config('app.url');

        // return "{$prefix}{$domain}{$suffix}";
        return "{$url}/{$domain}";
    }

}

if (! function_exists('get_url_preffix')) {
    function get_url_preffix(): string
    {
        return app()->environment('production') ? 'https://' : 'http://';
    }
}
if (! function_exists('get_url_suffix')) {
    function get_url_suffix(): string
    {
        if (app()->environment('production')) {
            return '.'.get_app_url_without_http();
        }

        return '.localhost:8000';
    }
}

if (! function_exists('remove_https_from_url')) {
    function remove_https_from_url(string $url): string
    {
        $http = get_url_preffix();

        return str_replace($http, '', $url);

    }
}

if (! function_exists('get_app_url_without_http')) {
    function get_app_url_without_http(): string
    {

        return remove_https_from_url(config('app.url'));
    }
}
