@if($showInput)
    <h1>{{ $editableTitle }}</h1>
    <div class="mb-3 col-12">
        @if (empty($results[$currentIndex]->title))
             <label for="id" class="form-label">Enter the title</label>
        @endif
        <input id="id" type="text" wire:model.live="editableTitle" />
    </div>

    @if (!$isAddNew)
        <button class="btn btn-success mt-3" wire:click="saveTitle">
            Save Title
        </button>
        <button class="btn btn-warning mt-3" @click="$wire.cancelTitle();">
            Cancel Title
        </button>
    @endif    
@else
    @if (!empty($results[$currentIndex]->title))
        <h1>{{ $results[$currentIndex]->title }}</h1>
    @endif    
@endif