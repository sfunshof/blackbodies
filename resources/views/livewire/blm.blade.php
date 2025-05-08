<div>
    <div x-data="blmData">
        <div x-show="isPasswordReset" x-cloak>
            <livewire:login.passwordreset-form  :token="$token"  :email="$email" />
       </div>

        <div x-show="login" x-cloak>
              <livewire:login.login-form  :isAdmin=$isAdmin />
         </div>

        <div x-show="forgot" x-cloak>
            <livewire:login.forgot-form>
        </div>
        <div x-show="register" x-cloak>
            <livewire:login.register-form>
        </div>
        <div x-show="content" x-cloak>
            <livewire:contents.contents  :isAdmin=$isAdmin />
        </div>

    </div>
    @script
        <script>
            Alpine.data('blmData', () => ({
                isPasswordReset: $wire.entangle('isPasswordReset'),
                login: $wire.entangle('isLogin'),
                forgot:  $wire.entangle('isForgot'),
                register:  $wire.entangle('isRegister'),
                register_success:false,
                content:  $wire.entangle('isContents'),
                init() {
                    //After registeration and also after logout
                    $wire.on('completeLogin', () => {
                        $wire.show_loginPage();
                    });
                    $wire.on('gotoContents', () => {
                         $wire.show_contentsPage();
                    });
                }
            }));

        </script>
    @endscript
    
</div>
