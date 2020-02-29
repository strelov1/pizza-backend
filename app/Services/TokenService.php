<?php

namespace App\Services;

use App\Repositories\TokenRepository;
use Illuminate\Support\Str;

class TokenService
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }


    public function issue()
    {
        return $this->tokenRepository->create([
            'token' => $this->generate()
        ]);
    }

    public function generate()
    {
        return Str::random(32);
    }
}