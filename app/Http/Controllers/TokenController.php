<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenResponse;
use App\Services\TokenService;

class TokenController extends Controller
{
    protected $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function issue(): TokenResponse
    {
        return new TokenResponse($this->tokenService->issue());
    }
}