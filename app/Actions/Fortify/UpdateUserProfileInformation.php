<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {

        $messages = [
            'email.required' => 'La email è richiesta.',           
            'name.required' => 'Il nome utente è richiesto.',
            'name.unique' => 'Il nome utente è già stato preso.',
            'realname.required' => 'Il nome è richiesto.',
            'realname.alpha' => 'Il formato del nome non è valido',
            'surname.required' => 'Il cognome è richiesto.',
            'surname.alpha' => 'Il formato del cognome non è valido.',
            'city.required' => 'La città è richiesta.',
        ];

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'realname' => 'required|alpha',
            'surname' => 'required|alpha',
            'city' => 'required'
        ], $messages)->validate();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {

            $user->detail->update([
                'realname' => $input['realname'],
                'surname' => $input['surname'],
                'city' => $input['city'],
            ]);

            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
