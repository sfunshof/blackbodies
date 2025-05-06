<?php

namespace App\Livewire\Contents;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use App\Traits\AdminTrait;


use Livewire\WithFileUploads;

class Contents extends Component
{
    use AdminTrait;
    use WithFileUploads;

    // Public properties to hold the results and current index
    public array $results = [];
    public int $currentIndex = 0;
    public int $total;

    public $isAdmin;
    //Admin variables - images
    public $inputIndex = 1;
    public $errorMessage = '';
    public $showButtons = false;
    public $photo;
    //Admin variables - title
    public $editableTitle = '';
    public $showInput = false;
    //Admin variables  - contents
    public $editableContent = '';
    public $showTextContents = false;
    public $keep_currentIndex=0;
    public $isAddNew=false;
    //
    

    public function showNext(): void
    {
        // Store current index in session before updating
        session(['prevIndex' => $this->currentIndex]);
        // Move to the next record if not at the end
        if ($this->currentIndex < count($this->results) - 1) {
            $this->currentIndex++;
        }
        $this->resetSlide();
        $this->inputIndex = $this->currentIndex + 1;
      
    }

    public function showPrev(): void
    {
         // Store current index in session before updating
         session(['prevIndex' => $this->currentIndex]);
        // Move to the previous record if not at the start
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
        $this->resetSlide();
        $this->inputIndex = $this->currentIndex + 1;
     }
     private function init_database(){
        // Fetch all records from the 'contents' table
       $this->results = DB::table('contents')->get()->toArray();
       $this->total=count($this->results);
     }
    public function mount($isAdmin = null){
        $this->isAdmin = $isAdmin;
        $this->init_database();
        // Initialize session value for tracking direction
        session(['prevIndex' => 0]);

        $this->inputIndex = $this->currentIndex + 1;
    }

    public function render()
    {
        return view('livewire.contents.contents');
    }

    //navbar functions
    public function logoutFunc(){
        //Auth::logout();
        // Clear session (optional)
        //session()->invalidate();
        //session()->regenerateToken();
        $this->dispatch('completeLogin');
    }

    //Admin specific  functions 
    public function goToIndex($index){
        $index = (int) $index;
        if ($index >= 0 && $index <  $this->total) {
            $this->currentIndex = $index;
        }
    }
    public function updatedInputIndex($value){
        $index = (int) $value - 1;
        if ($index >= 0 && $index < $this->total ) {
            $this->currentIndex = $index;
            $this->errorMessage = '';
        } else {
            $this->errorMessage = 'Please enter a valid index between 1 and ' . $this->total;
            $this->dispatch('errorMsg_fromEnter');
        }
    }
    public function save_slide(){
        $logo=$this->init_saveImage();
        // Insert data into the 'cntents' table
        DB::table('contents')->insert([
            'logo'     => $logo,
            'title'    => $this->editableTitle,
            'contents' => $this->editableContent,
        ]);
        $this->init_database();
        $this->currentIndex=$this->total-1;
        $this->isAddNew=false;
        $this->cancelAll();
    }

    public function cancel_slide(){
        $this->currentIndex=$this->keep_currentIndex;
        $this->inputIndex=$this->currentIndex+1;
        $this->isAddNew=false;
        $this->cancelAll();
    }

  //Footer functions - edit
    public function toggleButtons(){
        if ($this->isAddNew) return 0;
        $this->showButtons = !$this->showButtons;
    }
    private function cancelAll(){
        $this->cancelImage();
        $this->cancelContent();
        $this->cancelTitle();
    }
    public function resetSlide(){
        $this->cancelAll();
        if ($this->isAddNew){
            $this->currentIndex=$this->keep_currentIndex;
            $this->isAddNew=false;
            $this->showButtons =false;
            $this->inputIndex = $this->keep_currentIndex;
        }
    }
    public function addNewSlide(){
        $this->showButtons =false;
        $this->dispatch('startAddNew');
        if ($this->isAddNew) return 0; //prevent multiple calls
        $this->keep_currentIndex=$this->currentIndex;
        $this->currentIndex=$this->total+1;
        $this->isAddNew=true;
        if (!isset($this->results[$this->currentIndex])) {
            $results[$this->currentIndex] = (object) [];
        }
        $results[$this->currentIndex]->logo = '';
        $results[$this->currentIndex]->title = '';
        $results[$this->currentIndex]->contents = '';
        $this->inputIndex=$this->total+1;
    }
    //delete slide
    public function remove_slide(){
        if ($this->isAddNew)  return 0;
        $this->keep_currentIndex=$this->currentIndex;
        $keyID=$this->results[$this->currentIndex]->keyID;
        DB::table('contents')
            ->where('keyID', $keyID)
            ->delete();
        $this->init_database();
        $this->isAddNew=false;
        $currentIndex=$this->keep_currentIndex-1;
        if ($currentIndex==0) $currentIndex=1;
        $this->currentIndex=$currentIndex; 
    }

    //Images
    private function init_saveImage(){
        $this->showButtons=false;
        $this->validate([
            'photo' => 'required|image|max:2048',
        ]);
        $filename = $this->photo->getClientOriginalName();
        $this->photo->storeAs('', $filename, 'public_images');
        return $filename;
    }
    public function saveImage()
    {
        $filename=$this->init_saveImage();
        $keyID=$this->results[$this->currentIndex]->keyID;
        DB::table('contents')
            ->where('keyID', $keyID)
            ->update(['logo' => $filename]);
        $this->photo=null;
        $this->init_database();
     
    }
    
    public function cancelImage(){
        $this->photo=null;
    }

    //title
    public function startTitle(){
        $this->showInput = true;
        $this->showButtons=false;
         // Reset the editable title to the current result's title
        if (!empty($this->results[$this->currentIndex]->title)){
            $this->editableTitle = $this->results[$this->currentIndex]->title;
        }else{
            $this->editableTitle ="";
        }

    }

    public function cancelTitle(){
        $this->showInput = false;

    }
    public function updatedTitle(){
        // This method automatically runs when $title is updated
        // You could add validation or other processing here if needed
    }
    public function saveTitle(){
         // Update the local collection
        $this->results[$this->currentIndex]->title = $this->editableTitle;
        // Hide the input field
        $this->showInput = false;
        $keyID=$this->results[$this->currentIndex]->keyID;
        DB::table('contents')
            ->where('keyID', $keyID)
            ->update(['title' => $this->editableTitle]);
    }
    //Contents
    public function startContent(){
        $this->showTextContents = true;
        $this->showButtons=false;
        // Reset the editable title to the current result's title
        if (!empty($this->results[$this->currentIndex]->contents)){
            $this->editableContent = $this->results[$this->currentIndex]->contents;
        }else{
            $this->editableContent ="";
        }    
    }
    public function saveContent(){
        // Update the local collection to reflect changes in the UI
        $this->results[$this->currentIndex]->contents = $this->editableContent;
        // Hide the editor
        $this->showTextContents = false;
        $keyID=$this->results[$this->currentIndex]->keyID;
        DB::table('contents')
            ->where('keyID', $keyID)
            ->update(['contents' => $this->editableContent]);
        
    }

    public function cancelContent(){
        // Simply hide the editor without saving changes
        $this->showTextContents = false;
    }
}
