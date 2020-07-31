<?php

use App\Enums\SocialNetworks;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use App\Enums\SocialNetworksBaseUrl;

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

if (!function_exists('perPage')) {

    /**
     * If request has per_page parameter this function returns per_page value else return 10 to use in pagination.
     * @return int
     */
    function perPage(): int
    {
        if ($perPage = Illuminate\Support\Facades\Input::get('per_page')) {
            return $perPage < 100 ? $perPage : 100;
        }

        return 10;
    }
}

if (!function_exists('socialNetworkUrlBuild')) {

    /**
     * Create full url for social network base on host an path
     * @param $networkId
     * @param $channel
     * @return bool|String
     */
    function socialNetworkUrlBuild($networkId, $channel)
    {
        $host = SocialNetworksBaseUrl::getValue(SocialNetworks::getKey((int) $networkId));

        return "{$host}/{$channel}";
    }
}

if (!function_exists('totalPrice')) {

    /**
     * @param $price
     * @param int $quantity
     * @param float $discount
     * @return int
     */
    function totalPrice($price, int $quantity = 1, float $discount = 0)
    {
        return (int) $quantity * ($price - ($price * $discount));
    }
}

if (!function_exists('isAdminPage')) {

    /**
     * @return boolean
     */
    function isAdminPage(): bool
    {
        $url = url()->current();
        return strstr($url, 'admin');
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

if (!function_exists('urlToUploadedFile')) {

    /**
     * Turn url to UploadedFile
     * @param string $url
     * @return UploadedFile
     * @throws \App\Exceptions\InvalidUrlException
     */
    function urlToUploadedFile(string $url): UploadedFile
    {
        $mime_types = [
            'image/png',
            'image/jpeg'
        ];

        try {
            $info = pathinfo($url);
            $contents = file_get_contents($url);
            $file = '/tmp/' . $info['basename'];
            file_put_contents($file, $contents);

            $size = getimagesize($file);

            if (!$size && !in_array($size['mime'], $mime_types)) {
                throw new Exception;
            }

            return new UploadedFile($file, $info['basename']);
        } catch (Exception $exception) {
            throw new \App\Exceptions\InvalidUrlException;
        }
    }
}

if (!function_exists('logException')) {

    /**
     * Log
     * @param Exception $exception
     * @param string $level
     * @param string $actual_file
     * @return void
     */
    function logException(Exception $exception, $level = 'error', $actual_file = ''): void
    {
        $level = ucfirst($level);

        $message =
            "
            Actual file: $actual_file
            {$exception->getFile()}: {$exception->getLine()}
            message: {$exception->getMessage()}
            ";

        Log::$level($message);
    }
}
