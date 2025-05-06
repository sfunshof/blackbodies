<div>
     <div class="container-fluid mt-4 h-100">
        <div class="full-page">
            <div class="form-container">
                <div class="card shadow-sm w-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Forgot Your Password</h2>

                        @if ($successMessage)
                            <div class="alert alert-success">
                                {{ $successMessage}}
                            </div>
                        @endif
                        @if ($errorMessage) 
                            <div class="alert alert-danger"> 
                                {{ $errorMessage }} 
                            </div> 
                        @endif
                        <form wire:submit.prevent="submit">
                            <div class="mb-3"> 
                                <label for="username" class="form-label">Email</label>
                                <input type="text"  wire:model.live="email"   class="form-control" id="username" placeholder="Enter your email">
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div> 
                            <button type="submit" class="btn btn-primary w-100"  wire:loading.attr="disabled" wire:target="login"  >
                                    @if ($isSubmitting) Sending reset link... @else Send Reset Link @endif
                            </button> 
                        </form> 
                        <div class="mt-3 text-center" @click.prevent="$wire.$parent.show_loginPage()">
                            <span class="text-success" >Back to Login</span>
                        </div>
                    </div>
                </div>      
            </div>    
        </div>
    </div>
</div>
       