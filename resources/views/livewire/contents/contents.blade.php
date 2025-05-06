<div>
   
    @if ($isAdmin)
        @once('admin-styles')
            @include('livewire.contents.cssblade.admin-styles')
        @endonce
        @include('livewire.contents.fc.admin')
    @else
        @once('contents-styles')
            @include('livewire.contents.cssblade.contents-styles')
        @endonce
        @include('livewire.contents.fc.navbar')
        @include('livewire.contents.fc.contents')
    @endif

</div>