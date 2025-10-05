<?php

namespace App\Helpers;

use App\Models\User;
use App\Services\JWTService;

class CompanyAuth
{
    public static function user(): ?User
    {
        // First try to get from request attributes (set by middleware)
        $user = request()->attributes->get('user');

        if ($user) {
            return $user;
        }

        // Fallback: get from JWT token in cookie
        $token = request()->cookie('company_token');

        if (!$token) {
            return null;
        }

        $jwtService = new JWTService();
        return $jwtService->getUserFromToken($token);
    }
}
