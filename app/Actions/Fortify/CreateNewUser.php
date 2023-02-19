<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'min:2', 'max:40'],
            'last_name' => ['required', 'string', 'min:2', 'max:40'],
            'cpf' => ['required', 'string', 'max:16', Rule::unique(User::class)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'phone' => ['required', 'string', 'max:16', Rule::unique(User::class)],
            'data_nasc' => ['required', 'date'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'cpf' => $input['cpf'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'data_nasc' => $input['data_nasc'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
