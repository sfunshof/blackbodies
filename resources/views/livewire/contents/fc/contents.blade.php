<div class="container-fluid mt-4 h-100">
    <!-- Use wire:key to force re-render of element when currentIndex changes -->
    <div class="content-wrapper position-relative" style="height: 500px; overflow: hidden;">
        @if(isset($results[$currentIndex]))
            <!-- Add wire:key to force re-render of the entire slide -->
            <div wire:key="content-{{ $currentIndex }}" class="slide-item h-100 w-100 {{ $currentIndex > session('prevIndex', 0) ? 'slide-from-right' : 'slide-from-left' }}">
                <!-- Image Container -->
                <div class="d-flex align-items-center justify-content-center mb-4" style="height: 70%;">
                    <img 
                        src="{{ asset('images/' . $results[$currentIndex]->logo) }}" 
                        class="img-fluid shadow-sm" 
                        style="max-height: 100%; width: auto;"
                    >
                </div>
                <!-- Text Container -->
                <div class="vstack gap-3 flex-grow-1 align-items-center justify-content-center">
                    <h2 class="text-center fw-bold">{{ $results[$currentIndex]->title }}</h2>
                    <div class="content-text">
                        {!! $results[$currentIndex]->contents !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>