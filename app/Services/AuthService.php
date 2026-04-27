<?php

namespace App\Services;

use App\Models\User;
use App\Models\OwnerProfile;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): array
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'role' => $data['role'],
        ]);

        $user->assignRole($data['role']);

        if ($data['role'] === 'owner') {
            OwnerProfile::create([
                'user_id' => $user->id,
                'is_verified' => false,
            ]);
        } else {
            CustomerProfile::create([
                'user_id' => $user->id,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $relation = $data['role'] === 'owner' ? 'ownerProfile' : 'customerProfile';
        $user->load($relation);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $data): array|false
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return false;
        }

        $user = Auth::user();

        // if you wnat to be looged form one place at a time
        $user->tokens()->delete();

        // Create a fresh token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Load the right profile based on role
        $relation = $user->role === 'owner' ? 'ownerProfile' : 'customerProfile';
        $user->load($relation);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function me(User $user): User
    {
        $user->load(['ownerProfile', 'customerProfile']);
        return $user;
    }
}
