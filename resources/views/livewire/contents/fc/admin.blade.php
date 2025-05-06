
<div class="wrapper" x-data="adminData">
    @if (empty($results[$currentIndex]->title))
        <div class="mt-1 col-12 d-flex justify-content-center gap-3">
            <h4> Please complete the new Slide </h4>
        </div>
    @endif
    <div class="image-container" >
        @if (!empty($results[$currentIndex]->logo))
            @if (!$photo) 
                <img src="{{ asset('images/' . $results[$currentIndex]->logo) }}"  alt="Image" class="responsive-image">
            @endif
        @endif
    </div>
    @include('livewire.contents.inc.image')
    <div class="title">
        @include('livewire.contents.inc.title')
    </div>
    <div class="content">
        @include('livewire.contents.inc.contents')
    </div>
    @if (empty($results[$currentIndex]->title))
        <div class="mt-3 mb-3 col-12 d-flex justify-content-center gap-3">
            <button @click="save();" class="btn btn-success">Save Slide</button>
            <button @click="$wire.cancel_slide();" class="btn btn-warning ml-2">Cancel</button>
        </div>
    @endif   

    <!-- Toggle Buttons -->
    @if ($showButtons)
        <div  class="position-absolute top-0 start-0 w-100 h-100 d-flex 
            flex-column justify-content-center align-items-left ">
            <button @click="$refs.previewBtn.click();$wire.showButtons=false;" class="btn btn-primary mb-3 col-8 col-md-3">Upload Image</button>
            <button @click.stop="$wire.startTitle()" class="btn btn-success mb-3 col-8 col-md-3">Set up Title</button>
            <button @click.stop="$wire.startContent()"class="btn btn-warning col-8 col-md-3">Set up Contents</button>
        </div>
    @endif

   <!-- Fixed Footer -->
   <footer class="fixed-footer">
       <div class="container-fluid h-100">
           <div class="row h-100 align-items-center">
               <div class="col-4">
                   <div class="d-flex justify-content-between align-items-center gap-2">
                       <!-- Delete Icon (left aligned) -->
                       <button class="footer-btn me-auto" title="Delete" @click="removeSlide()">
                           <i class="bi bi-x-lg text-danger"></i>
                       </button>
                       <!-- Edit Icon (ccenter aligned) -->
                       <button class="footer-btn mx-auto" title="Edit"  wire:click="toggleButtons">
                           <i class="bi bi-pencil text-primary"></i>
                       </button>
                       <!-- Add Icon (right aligned) -->
                       <button class="footer-btn ms-auto" title="Add" wire:click="addNewSlide()">
                           <i class="bi bi-plus-lg text-success"></i>
                       </button>
                   </div>
               </div>    
               <!-- Navigation Group (col-8 right aligned) -->
               <div class="col-8">
                   <div class="nav-group">
                       <!-- Left Arrow -->
                       <button class="footer-btn" title="Previous" @click="$wire.showPrev()" @disabled($currentIndex == 0)>
                           <i class="bi bi-arrow-left text-primary"></i>
                       </button>
                       <!-- Text Box -->
                       <input 
                               type="number" 
                               min="1" 
                               max="{{ $total }}" 
                               wire:model.lazy="inputIndex" 
                               placeholder="Enter index (1 - {{ $total }})
                               class="digit-box" maxlength="3" value="1"
                           >

                       <!-- Label -->
                       <span class="counter-label">out of <span class="fw-bold fs-3">{{ $total }} </span>   </span>

                       <!-- Right Arrow -->
                       <button class="footer-btn" title="Next" @click="$wire.showNext()" @disabled($currentIndex >= $total-1 && !$isAddNew)>
                           <i class="bi bi-arrow-right text-primary"></i>
                       </button>
                   </div>
               </div>
           </div>
       </div>
   </footer>
</div>
@script
    <script>
        Alpine.data('adminData', () => ({
            title:$wire.entangle('editableTitle'),
            logo:$wire.entangle('photo'),
            content:$wire.entangle('editableContent'),
            errMsg:'',
            errStatus:0,
            init() {
               
                
            },
            save(){
                if (this.title.length==0){
                    this.errMsg=this.errMsg +" Missing Title <br>";
                    this.errStatus=1;
               }
                if (this.content.length==0){
                    this.errMsg=this.errMsg +" Missing Contents <br>";
                    this.errStatus=1;
                }
                if (!this.logo){
                    this.errMsg=this.errMsg +" Missing Image <br>";
                    this.errStatus=1;
                }
                if (this.errStatus==1){
                    SnapDialog().warning('There are missing cases: ? <br>' + this.errMsg , 'Are you sure?', {
                        enableConfirm: true,
                        onConfirm: function() {
                            $wire.save_slide();
                        },
                        enableCancel: true,
                        onCancel: function() {
                            //console.log('Cancelled');
                        }
                    });
                }else{
                    $wire.save_slide();
                }
            },
            removeSlide(){
                SnapDialog().warning('Do you really want to remove this slide?', 'Are you sure?', {
                        enableConfirm: true,
                        onConfirm: function() {
                            $wire.remove_slide();
                        },
                        enableCancel: true,
                        onCancel: function() {
                            //console.log('Cancelled');
                        }
                    });
            }
        }));
         //After registeration and also after logout
         $wire.on('startAddNew', () => {
            //$refs.previewBtn.click();
            $wire.showButtons=false;
            $wire.startTitle();
            $wire.startContent();
        });
        $wire.on('errorMsg_fromEnter', () => {
            new Notify({
                status: 'warning',
                title: 'Error',
                position:'x-center y-center',
                text: 'Please enter a valid number between 1 and ' + {{ $total }},
            })
        });
    </script>
@endscript
