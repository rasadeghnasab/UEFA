<?php

if (!function_exists('makeDirectoryOnFullPath')) {
    function makeDirectoryOnFullPath($fullPath)
    {
        $directory = dirname($fullPath);
        File::makeDirectory($directory, 493, true, true);
    }
}

if (!function_exists('getFileName')) {
    /**
     * @param $path
     * @return string
     */
    function getFileName($path): string
    {
        $fileName = pathinfo($path, PATHINFO_FILENAME);

        return $fileName;
    }
}

if (!function_exists('getFileExtension')) {
    /**
     * @param $path
     * @return string
     */
    function getFileExtension($path): string
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        if (strpos($path, '.jpg') && $extension === 'jpeg') {
            $extension = 'jpg';
        }

        return $extension;
    }
}

if (!function_exists('externalUrl')) {

    /**
     * @param $host
     * @param $path
     * @param array $parameters
     * @param null $secure
     * @return bool|string
     */
    function externalUrl($host, $path = null, $parameters = [], $secure = null): string
    {
        $currentHost = request()->getSchemeAndHttpHost();
        return str_replace($currentHost, $host, url($path, $parameters, $secure));
    }
}

if (!function_exists('frontendUrl')) {

    /**
     * @param $path
     * @param array $parameters
     * @return bool|string
     */
    function frontendUrl($path = null, $parameters = [], $secure = null): string
    {
        $frontendHost = config('app.frontend');

        return externalUrl($frontendHost, $path, $parameters, $secure);
    }
}
