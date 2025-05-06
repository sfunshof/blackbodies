<style>
   :root {
        --header-bg: #2c3e50;
        --header-text: #ecf0f1;
        --btn-hover: #34495e;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 70px; /* Account for fixed header */
    }
    
    .mobile-header {
        background-color: var(--header-bg);
        color: var(--header-text);
        padding: 0.8rem 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }
    
    .nav-btn {
        color: var(--header-text);
        background-color: transparent;
        border: none;
        font-size: 1.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50%;
        transition: all 0.2s ease;
        outline: none !important;
    }
    
    .nav-btn:hover, .nav-btn:focus {
        background-color: var(--btn-hover);
        transform: scale(1.05);
    }
    
    .menu-btn {
        margin-right: 1.5rem; /* Space between menu and prev button */
    }
    
    .prev-btn {
        margin-left: 0.5rem; /* Additional margin for prev button */
    }
    
    .next-btn {
        margin-right: 0.5rem; /* Small margin for next button */
    }
    
    /* Offcanvas Menu Styling */
    .offcanvas {
        background-color: #34495e;
        color: var(--header-text);
    }
    
    .offcanvas-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .offcanvas-title {
        font-weight: 600;
        color: #3498db;
    }
    
    .offcanvas-body .nav-link {
        color: var(--header-text);
        padding: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    /* Animation for menu items when clicked */
    @keyframes menu-recoil {
        0% { transform: translateX(0); }
        50% { transform: translateX(-15px); }
        100% { transform: translateX(0); }
    }
    
    .menu-recoil {
        animation: menu-recoil 0.4s ease-out;
    }
    
    .offcanvas-body .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }
    
    .offcanvas-body .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    /* Button pulse animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
</style>