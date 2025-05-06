// app.js or a new file like pwa-installer.js

// Store the deferred prompt for later use
let deferredPrompt;
const installButton = document.getElementById('install-button');

// Initially hide the install button
if (installButton) {
    installButton.style.display = 'none';
}

// Listen for the beforeinstallprompt event
window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    
    // Store the event for later use
    deferredPrompt = e;
    
    // Show the install button
    if (installButton) {
        installButton.style.display = 'block';
        
        // Add click event to the install button
        installButton.addEventListener('click', () => {
            // Show the install prompt
            deferredPrompt.prompt();
            
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                    // You could send analytics data here
                } else {
                    console.log('User dismissed the install prompt');
                }
                
                // Clear the stored prompt - it can't be used again
                deferredPrompt = null;
                
                // Hide the install button
                installButton.style.display = 'none';
            });
        });
    }
});

// Listen for the appinstalled event
window.addEventListener('appinstalled', (evt) => {
    // Log install to analytics
    console.log('Application was installed', evt);
    
    // Hide the install button
    if (installButton) {
        installButton.style.display = 'none';
    }
});