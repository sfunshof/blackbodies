<div>
    <div class="container-fluid mt-4 h-100">   
        @once('login-styles')
            @include('livewire.login.cssblade.login-styles')
        @endonce
        <!-- Top Half - Logo -->
        <div class="top-page bg-light">
            <div class="logo-container" style="height: 100%;">
                <img src="{{asset('logo.png')}}" alt="Logo" class="img-fluid h-100 w-auto mx-auto">
            </div>
        </div>

        <!-- Bottom Half - Form -->
        <div class="bottom-page">
            <div class="form-container">
                <div class="card shadow-sm w-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        @if ($errorMessage)
                            <div class="alert alert-danger">
                                {{ $errorMessage }}
                            </div>
                        @endif

                        <form wire:submit.prevent="login">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model.live="email"   placeholder="Enter your email" >
                                @error('email') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model.live="password"  placeholder="Enter your password">
                                @error('password') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>
                          
                                <div  class="mb-1 text-center"  @click="$wire.$parent.show_forgotPage();">
                                    <span class="text-decoration-none text-success">Forgot Password?</span>
                                </div>
                                <div   class="mb-3 text-center" @click="$wire.$parent.show_registerPage();">
                                    <span class="text-decoration-none text-success">Sign Up</span>
                                </div>
                            
                             <div class="d-grid">
                                <button type="submit" class="btn btn-primary"  wire:loading.attr="disabled" wire:target="login">Login In</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center mt-4">
                             <!-- Add this button somewhere in your Laravel Blade template -->
                            <button id="install-button" class="btn btn-outline-secondary" style="display: none;">
                                Install App
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>