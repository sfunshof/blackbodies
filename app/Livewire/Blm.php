<?php

namespace App\Livewire;

use Livewire\Component;

class Blm extends Component
{
    public $isLogin=true;
    public $isRegister=false;
    public $isForgot=false;
    public $isContents=false;
    
    public  $isAdmin; //
  
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
    
    public function mount($isAdmin = null){
        $this->isAdmin = $isAdmin;
    }
     public function render(){
        return view('livewire.blm');
    }

}
