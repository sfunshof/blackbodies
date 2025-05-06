 <!-- Main content -->
 <div class="main-content" >
     <div class="container  position-relative pt-3">
        
            <div class="image-container" >
                @if (!empty($results[$currentIndex]->logo))
                    <img src="{{ asset('images/' . $results[$currentIndex]->logo) }}"  alt="Image" class="responsive-image">
                @endif
            </div>
             @include('livewire.contents.inc.image') 
            <div class="title">
                @include('livewire.contents.inc.title')
            </div>
            <div class="content mb-5">
                @include('livewire.contents.inc.contents')
            </div>
         

        <!-- Toggle Buttons -->
        @if ($showButtons)
            <div  class="position-absolute top-0 start-0 w-100 h-100 d-flex 
                 flex-column justify-content-center align-items-left ">
                <button @click="$refs.previewBtn.click();$wire.showButtons=false;" class="btn btn-primary mb-3 col-8 col-md-3">Upload Image</button>
                <button @click.stop="$wire.startTitle()" class="btn btn-success mb-3 col-8 col-md-3">Set up Title</button>
                <button @click.stop="$wire.startContent()"class="btn btn-warning col-8 col-md-3">Set up Contents</button>
            </div>
        @endif
   
    </div>

    <!-- Dummy content to enable scrolling -->
    <div class="pb-5">
        <p> &nbsp;</p>
    </div>
    <div class="pb-5">
        <p> &nbsp;</p>
    </div>
    <div class="pb-5">
        <p> &nbsp;</p>
    </div>

    
    <!-- Fixed Footer -->
    <footer class="fixed-footer">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center">
                <div class="col-4">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <!-- Delete Icon (left aligned) -->
                        <button class="footer-btn me-auto" title="Delete">
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
                        <button class="footer-btn" title="Next" @click="$wire.showNext()" @disabled($currentIndex >= $total-1)>
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
            logout(){
                SnapDialog().alert('Do you really want to logout?', 'Are you sure?', {
                    enableConfirm: true,
                    onConfirm: function() {
                        $wire.logoutFunc();
                    },
                    enableCancel: true,
                    onCancel: function() {
                        //console.log('Cancelled');
                    }
                });
            },
           // showButtons:$wire.entangle('showButtons'),
            init() {

            },
        }));
</script>
@endscript
