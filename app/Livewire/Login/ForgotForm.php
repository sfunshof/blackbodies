<?php

namespace App\Livewire\Login;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotForm extends Component
{
    public $email;
    public $isSubmitting = false;
    public $successMessage = '';
    public $errorMessage = '';

    // Validation rules for the email
    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    // This will clear the error when the email field is updated
    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
    }

    // Handle the form submission
    public function submit()
    {
        $this->isSubmitting = true;
        $this->successMessage = '';
        $this->errorMessage = '';

        $this->validate();  // Validate the form data

        // Send password reset link
        $response = Password::sendResetLink(['email' => $this->email]);

        // Check if the reset link was sent successfully
        if ($response == Password::RESET_LINK_SENT) {
            $this->successMessage = 'We have emailed your password reset link!';
            //$this->reset();  // Reset form fields after success
            $this->email='';
        } else {
            $this->errorMessage = 'There was an issue sending the reset link. Please try again.';
        }
        $this->isSubmitting = false;
        //dump($this->successMessage);
    }

    public function render()
    {
        return view('livewire.login.forgot-form');
    }
}
