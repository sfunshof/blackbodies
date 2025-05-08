<?php

namespace App\Livewire\Login;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\On; 

class RegisterForm extends Component
{
    public $name, $email, $password, $dob, $password_confirmation;
    public $isSubmitting = false;
    public $successMessage = '';
    public $initRegister=true;
    public $successRegister=false;

    // Custom validation messages
    protected $messages = [
        'dob.required' => 'Date of birth is required.',
        'dob.date' => 'Please enter a valid date.',
        'dob.before' => 'Date of birth must be in the past.',
        'dob.before_or_equal' => 'You must be at least 18 years old.',
    ];

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
    }

    // Define the validation rules for registration
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => [
                'required',
                'date',
                'before:today', // DOB must be in the past
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'), // At least 18 years old
            ],
            'password' => ['required', 'confirmed', Password::default()],
        ];
    }
    // Call this function before submission
    public function beforeSubmit(){
        $this->isSubmitting = true;
        $this->successMessage = '';  // Clear success message if any.
        session()->forget('message');
    }

    // Handle user registration
    public function register()
    {
        $this->beforeSubmit();  // Trigger the pre-submit function
        $this->validate();  // Validate the form data

        try {
            // Use Query Builder to insert the user data into the database
            $userId = DB::table('users')->insertGetId([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'created_at' => now(),
                'updated_at' => now(),
                'dob' =>$this->dob
            ]);

            // Trigger the post-submit function
            $this->afterSubmit();

            session()->flash('message', 'Registration successful!');

        } catch (\Exception $e) {
            $this->isSubmitting = false; // Reset submitting state
            throw ValidationException::withMessages([
                'email' => 'There was an error with your registration. Please try again.',
            ]);
        }
    }

    // Call this function after successful registration
    public function afterSubmit(){
        $this->successMessage = 'Registration successful!';
        $this->reset(); // Reset form fields
        $this->isSubmitting = false;
        $this->successRegister=true;
        $this->initRegister=false;
        $this->dispatch('init_gotoLogin');
    }

    #[On('init_gotoLogin')]
    public function completeLoginForm(){
        sleep(5);
        $this->dispatch('gotoLogin');
        $this->successRegister=false;
        $this->initRegister=true;
    }
    public function mount(){
        if ($this->dob instanceof \Carbon\Carbon) {
            $this->dob = $this->dob->format('Y-m-d'); // Convert Carbon to 'yyyy-mm-dd'
        }
    }
    public function render(){
        return view('livewire.login.register-form');

    }
    public function test(){
        dump("test");
    }
}
