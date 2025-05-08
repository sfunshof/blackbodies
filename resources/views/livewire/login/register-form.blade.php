 <div>
    <div class="container-fluid mt-4 h-100">
        <div class="full-page">
            <div class="form-container">
                <div class="card shadow-sm w-100"   x-data="registerData">
                    <div class="card-body" x-show="initRegister">
                        <h2 class="text-center mb-4">Register</h2>

                        <form wire:submit.prevent="register">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model.live="name"  placeholder="Enter your name">
                                @error('name') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model.live="email"  placeholder="Enter your email">
                                @error('email') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" wire:model.live="dob"  placeholder="Enter your date of birth">
                                @error('dob') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model.live="password"  placeholder="Enter your password">
                                @error('password') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" wire:model.live="password_confirmation"  placeholder="Confirm your email">
                                @error('password_confirmation') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3 text-center" wire:click="$parent.show_loginPage();">
                                <span class="text-decoration-none text-success">Already registered? Login here</span>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="register">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" x-show="successRegister">
                        <div class="alert alert-success" role="alert">
                            <h2 class="text-center mb-4">Success</h2>
                            <p> The Registration was successful. You can now login into the app </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @script
            <script>
                Alpine.data('registerData', () => ({
                    initRegister:$wire.entangle('initRegister'),
                    successRegister:$wire.entangle('successRegister'),
                }));
            </script>
        @endscript
    </div>
</div>