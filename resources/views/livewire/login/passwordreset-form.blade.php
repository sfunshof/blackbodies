<div>

    <div class="container-fluid mt-4 h-100">
        <div class="full-page">
            <div class="form-container" x-data="passwordResetData">
                <div class="card shadow-sm w-100" >
                    <div class="card-body">
                        <h2 class="text-center mb-4">Reset Password</h2>
                        
                        <div class="card-body" x-show="successReset">
                            <div class="alert alert-success" role="alert">
                                <h2 class="text-center mb-4">Success</h2>
                                <p>
                                    {!! $successMsg !!}
                                 </p>
                            </div>
                        </div>
                        <div class="card-body" x-show="errorReset">
                            <div class="alert alert-danger" role="alert">
                                <h2 class="text-center mb-4">Error:</h2>
                                <p>
                                   {!! $errorMsg !!}
                                </p>
                            </div>
                        </div>

                        <form wire:submit.prevent="resetPassword"  x-show="successReset == '' && errorReset == ''" > 
                            <input type="hidden" wire:model="token">
                            <div class="mb-3">
                                <label>Your Email</label>
                                <input type="email" wire:model.lazy="email" readonly>
                                @error('email') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>
    
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model.live="password"  placeholder="Enter your password">
                                @error('password') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" wire:model.live="password_confirmation"  placeholder="Confirm your password">
                                @error('password_confirmation') <span class="small text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="resetPassword">Reset Password</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @script
        <script>
            Alpine.data('passwordResetData', () => ({
                successReset:$wire.entangle('successReset'),
                errorReset:$wire.entangle('errorReset'),
            }));
            $wire.on('init_login', () => {
                $wire.$parent.update_resetVariable();
                $wire.$parent.show_loginPage();
            });
        </script>
    @endscript
</div>
