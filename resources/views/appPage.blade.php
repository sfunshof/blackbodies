<!DOCTYPE html>
<html lang="en">

    <head>
        @include('inc.head')
    </head>
    <body>
        <!-- Navbar and contents -->
        @php
            $token = $token ?? '';
            $email = $email ?? '';
            $isAdmin = $isAdmin ?? 'false';
            $isPasswordReset = $isPasswordReset ?? false;
        @endphp
        <livewire:blm  :isAdmin="$isAdmin"  :token="$token" :email="$email" :isPasswordReset="$isPasswordReset" />
        @include('inc.foot')
    </body>

</html>
