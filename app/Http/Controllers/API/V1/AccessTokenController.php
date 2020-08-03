<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\AccessTokenRequest;
use App\Http\Requests\GetMobileRequest;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController as LaravelPassportAccessTokenController;

class AccessTokenController extends LaravelPassportAccessTokenController
{
    public function validateValuesAndIssueToken(AccessTokenRequest $request, ServerRequestInterface $passportRequest)
    {
        return $this->issueToken($passportRequest);
    }
}
