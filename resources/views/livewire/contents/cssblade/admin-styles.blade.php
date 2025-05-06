<style>
      /* Main body and footer */
      body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            padding-bottom: 60px;
        }
        
        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            z-index: 1000;
        }
        
        .footer-btn {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            padding: 0;
        }
        
        .footer-btn i {
            font-size: 1.5rem;
        }
        
        .digit-box {
            width: 40px;
            height: 40px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        
        .counter-label {
            font-size: 0.9rem;
            white-space: nowrap;
            margin: 0 5px;
        }
        
        .nav-group {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        /* End main body and footer */

        .wrapper {
            max-height: 100vh; /* Full viewport height */
            overflow-y: auto;  /* Enable vertical scroll */
            padding: 20px;
            padding-bottom: 60px;!important;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }
        
        .image-container {
            max-height: 50vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .responsive-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .title {
            flex: 0 0 auto;
            padding: 1rem;
            text-align: center;
         }

        .content {
            flex: 1 1 auto;
            padding: 1rem;
            /*overflow-y: auto; */
         }

</style>