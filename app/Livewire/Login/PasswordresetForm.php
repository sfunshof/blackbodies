<?php

namespace App\Livewire\Login;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class PasswordresetForm extends Component
{
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $token = '';
    public $isSubmitting = false;
    public $errorMsg = '';
    public $successMsg = '';
    public $successReset=false;
    public $errorReset=false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token=null, $email = null)
    {
        $this->token = $token;
        $this->email = $email ?? request()->query('email');
    }

    public function resetPassword(){
        $this->isSubmitting = true;
        $this->errorMsg = '';  // Reset any previous error message
        $this->successMsg = '';  // Reset any previous success message
        $this->successReset=false;
        $this->errorReset=false;
    
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user);
            }
        );

        //$this->status = __($status);

        if ($status === Password::PASSWORD_RESET) {
            //return redirect()->to('/dashboard'); // or wherever
            $this->successMsg = "Success: The password was successfully changed. <br> You are now being redirected to the login page";
            $this->successReset=true;
        } else {
            $this->errorReset=true;
            $this->errorMsg="Error: Unfortunately the password could not be changed. <br> Please try again";
            //$this->addError('email', __($status));
            //dump($this->status);
        }
        $this->dispatch('init_login');
    }
    public function render()
    {
        return view('livewire.login.passwordreset-form');
    }
}
