@if(!$showTextContents)
    @if (!empty($results[$currentIndex]->contents))
        {!! $results[$currentIndex]->contents !!}
    @endif
@else
   <div class="mb-3 col-12">
        <label for="id1" class="form-label">Enter the main contents</label>
       <textarea id="id1" wire:model="editableContent" class="form-control" rows="8">{{ $editableContent }}</textarea>
   </div>
    @if (!$isAddNew)
        <div class="mt-3 col-12 d-flex justify-content-center gap-3">
            <button wire:click="saveContent" class="btn btn-success">Save Contents</button>
            <button wire:click="cancelContent" class="btn btn-warning ml-2">Cancel Contents</button>
        </div>
     @endif

@endif