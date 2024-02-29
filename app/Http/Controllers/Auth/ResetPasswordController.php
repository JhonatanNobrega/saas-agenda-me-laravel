<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidPasswordResetTokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {
        $input = $request->validated();

        $token = PasswordResetToken::query()
            ->with('user')
            ->whereDate('created_at', '>=', now()->subHours(24)->toDateTimeString())
            ->whereToken($input['token'])
            ->first();

        if (!$token) {
            throw new InvalidPasswordResetTokenException();
        }

        $user = $token->user;
        $user->password = bcrypt($input['password']);
        $user->save();

        $user->resetPasswordTokens()->delete();
    }
}
