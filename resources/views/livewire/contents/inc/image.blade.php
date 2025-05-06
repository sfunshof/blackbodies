
    <div class="d-flex flex-column align-items-center">
        <!-- Hidden File Input -->
        <input type="file" wire:model="photo" id="photoInput" hidden>

        <!-- Preview Button -->
        <button hidden x-ref="previewBtn"    class="btn btn-primary mb-3" onclick="document.getElementById('photoInput').click()">
            Preview Image
        </button>

        <!-- Preview Area -->
        @if ($photo)
            <div class="image-container" >
                <img src="{{ $photo->temporaryUrl() }}"  alt="Image" class="responsive-image">
            </div>
            @if (!$isAddNew)
                <div class="mt-3 pb-3">
                    <!-- Save Button -->
                    <button  class="btn btn-success mt-3" @click="$wire.saveImage" @disabled(!$photo)>
                        Save Image
                    </button>
                    <!-- Cancel Button -->
                    <button    class="btn btn-warning mt-3" @click="$wire.cancelImage()">
                        Cancel Image
                    </button>
                </div>
             @endif 
        @endif

        @if (empty($results[$currentIndex]->logo))
            <div class="mt-3 col-12 d-flex justify-content-center">
                <button @click="$refs.previewBtn.click();$wire.showButtons=false;" class="btn btn-outline-secondary mb-3 col-8 col-md-3">Upload Image</button>
            </div>
        @endif 
        <!-- Success Message -->
        @if (session('message'))
            <div class="alert alert-success mt-3 w-100 text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- Validation Error -->
        @error('photo')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
