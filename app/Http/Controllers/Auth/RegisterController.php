<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisteredEvent;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        sleep(2);
        $input = $request->validated();
        if (User::query()->whereEmail($input['email'])->exists()) {
            throw new UserHasBeenTakenException();
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::query()->create($input);
        UserRegisteredEvent::dispatch($user);
        return new UserResource($user);
    }
}
