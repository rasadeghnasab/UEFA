<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function checkOwnership(Model $owner, Model $owns)
    {
        // Get class names
        $ownerClass = strtolower(class_basename($owner));
        $ownsClass = strtolower(class_basename($owns));

        $message = __(
            'response.owns.failed',
            ['owner' => __("models.{$ownerClass}"), 'owns' => __("models.{$ownsClass}")]
        );

        abort_if(!$owner->owns($owns), Response::HTTP_FORBIDDEN, $message);
    }
}
