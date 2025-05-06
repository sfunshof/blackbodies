     <!-- Mobile Header -->
     <header class="mobile-header" id="mobileHeader">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left Section: Menu Button -->
                <div class="col-4 d-flex">
                    
                    <!-- Hamburger Menu Button -->
                    <button class="nav-btn menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                     
                    <!-- Previous Button -->
                    <button @click="$wire.showPrev();" @if($total <= 1 || $currentIndex <= 0) hidden @endif
                        class="nav-btn prev-btn" type="button">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
                
                <!-- Center Section: Title (optional)-->
                <div class="col-5 text-center">
                    <h5 class="mb-0">Black Bodies</h5>
                </div>
                
                <!-- Right Section: Next Button -->
                <div class="col-3 d-flex justify-content-end">
                    <button wire:click="showNext" @if($total <= 1 || $currentIndex >= $total - 1) hidden @endif 
                         class="nav-btn next-btn" type="button" id="nextButton">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Offcanvas Menu -->
    <div x-data="navbarData" class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">App Navigation</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link menu-item" href="#"><i class="fas fa-user"></i> Profile</a>
                </li>
                <li class="nav-item" @click="logout()">
                    <a class="nav-link menu-item" href="#"><i class="fas fa-question-circle"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
    
@script
    <script>

        // Get elements
        menuItems = document.querySelectorAll('.menu-item');
        offcanvasMenu = document.getElementById('mobileMenu');

        // Handle menu item clicks - apply recoil to the menu item itself, not the header
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Apply recoil animation to this menu item only
                this.classList.add('menu-recoil');

                // Store reference to the clicked item
                const clickedItem = this;

                // Close the offcanvas after a slight delay
                setTimeout(() => {
                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasMenu);
                    bsOffcanvas.hide();

                    // Remove the recoil class after animation completes
                    setTimeout(() => {
                        clickedItem.classList.remove('menu-recoil');
                    }, 200);
                }, 100);
            });
        });
        Alpine.data('navbarData', () => ({
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
            init() {

            },
        }));
    </script>
@endscript