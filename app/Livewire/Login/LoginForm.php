<?php

namespace App\Livewire\Login;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class LoginForm extends Component
{
    public $email, $password;
    public $isSubmitting = false;
    public $errorMessage = '';
    public $successMessage = '';

    public $isAdmin;

    // Define validation rules
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ];

    // Function to handle login
    public function login(){
        $this->isSubmitting = true;
        $this->errorMessage = '';  // Reset any previous error message
        $this->successMessage = '';  // Reset any previous success message
        $this->validate(); // Validate the form data
        // Attempt to log the user in using Fortify's built-in authentication
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];
        if ($this->isAdmin) {
            $credentials['isAdmin'] = $this->isAdmin;
        }

        if (Auth::attempt( $credentials, true)) {
            // Call a post-login function after successful login
            $this->afterLogin();
        } else {
            // Handle failed login attempt
            $this->isSubmitting = false;
            $this->errorMessage = 'These credentials do not match our records.';
            //clear the password
            $this->password='';
        }
        session(['prevIndex' => 0]);
    }
    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
    }
    // Function to handle after successful login
    public function afterLogin(){
        $this->successMessage = 'You have successfully logged in!';
        $this->isSubmitting = false;
        $this->reset();  // Reset the form fields
        // Set success message that Alpine.js can watch for
        $this->successMessage = 'You have successfully logged in!';
        $this->dispatch('gotoContents');
    }

    #[On('gotoLogin')] 
    public function fromRegisterSuccess(){
        $this->email='';
        $this->password='';
        $this->errorMessage='';
        $this->dispatch('completeLogin');
    }

    public function mount($isAdmin = null){
        $this->isAdmin = $isAdmin;
    }
    public function render()
    {
        return view('livewire.login.login-form');
    }
}
