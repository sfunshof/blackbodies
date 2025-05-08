<?php

namespace App\Livewire;

use Livewire\Component;

class Blm extends Component
{
    public $isLogin=true;
    public $isRegister=false;
    public $isForgot=false;
    public $isContents=false;
    //
    public $token;
    public $email;
    public $isPasswordReset;
    
    public  $isAdmin =false; //
  
    private function initLogin(){
        $this->isLogin=false;
        $this->isRegister=false;
        $this->isForgot=false;
        $this->isContents=false;
    }
    public function show_loginPage(){
        $this->initLogin();
        $this->isLogin=true;
    }
    public function show_registerPage(){
        $this->initLogin();
        $this->isRegister=true;
    }
    public function  show_forgotPage(){
        $this->initLogin();
        $this->isForgot=true;
    }
    public function show_contentsPage(){
        $this->initLogin();
        $this->isContents=true;
    }
    public function update_resetVariable(){
        $this->isPasswordReset=false;
        $this->isAdmin=false;
        sleep(4);
    }
    public function mount($isAdmin = null, $email=null, $token=null,$isPasswordReset=null){
        $this->isAdmin = $isAdmin;
        $this->email=$email;
        $this->token=$token;
        $this->isPasswordReset=$isPasswordReset;
        if ($this->isPasswordReset) $this->isLogin=false;
    }
     public function render(){
        return view('livewire.blm');
    }

}
