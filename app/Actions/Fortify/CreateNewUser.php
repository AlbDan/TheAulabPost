<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $messages = [
            'email.required' => 'La email è richiesta.',
            'email.string' => 'Il formato della email non è valido.',           
            'email.email' => 'Il formato della email non è valido.',           
            'email.max' => 'Il formato della email non è valido.',  
            'email.unique' => 'Questa email è già presente.',             
            'name.required' => 'Il nome utente è richiesto.',
            'name.string' => 'Il formato del nome utente non è valido.',           
            'name.max' => 'Il formato del nome utente non è valido.',    
            'name.unique' => 'Il nome utente è già stato preso.',
            'realname.required' => 'Il nome è richiesto.',
            'realname.alpha' => 'Il formato del nome non è valido',
            'surname.required' => 'Il cognome è richiesto.',
            'surname.alpha' => 'Il formato del cognome non è valido.',
            'city.required' => 'La città è richiesta.',
            'password.required' => 'La password è richiesta.',
            'password.min' => 'La password deve contenere almeno 8 caratteri.',
            'password.regex' => 'Il formato della password non è valido.',
            'password.confirmed' => 'Le password non corrispondono.'
        ];

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            //'password' => $this->passwordRules(),
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',              // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'realname' => 'required|alpha',
            'surname' => 'required|alpha',
            'city' => 'required'
        ], $messages)->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Detail::create([
            'realname' => $input['realname'],
            'surname' => $input['surname'],
            'city' => $input['city'],
            'user_id'=> $user->id
        ]);

        return $user;
    }
}
