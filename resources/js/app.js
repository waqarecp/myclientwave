import './bootstrap';
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyBLRIxATX8TWVYRSUv_sIBRyQAocaVcEf8",
    authDomain: "crmanagement-7a4dc.firebaseapp.com",
    projectId: "crmanagement-7a4dc",
    storageBucket: "crmanagement-7a4dc.firebaseapp.com",
    messagingSenderId: "168926798104",
    appId: "1:168926798104:web:fa6ce21271b923a14a3e6d",
    measurementId: "G-RKS8SKCLX0"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Register the service worker globally
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
        .then((registration) => {
            console.log('Service Worker registered with scope:', registration.scope);
        }).catch((err) => {
            console.log('Service Worker registration failed:', err);
        });
}

// This logic will only execute on the login page
if (window.location.pathname === '/login') {  // Change this to the actual login route
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            getToken(messaging, { vapidKey: 'BOrHNPcJq_6sBU7JWLj3UJCO7_InMtV4NybIZuZuxFZiDe_J_NYgkYcHTq-dhnVv748qbTZPe-f4svZS649PLnQ' })
                .then((currentToken) => {
                    if (currentToken) {
                        console.log('FCM Token:', currentToken);
                        document.getElementById('fcm_token').value = currentToken; // Set FCM token in hidden input
                    } else {
                        console.log('No registration token available.');
                    }
                }).catch((err) => {
                    console.log('Error retrieving token: ', err);
                });
        } else {
            console.log('Notification permission denied.');
        }
    });
}

// Handle foreground notifications on all pages
onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.data.icon, // Use icon from data
        data: { click_action: payload.data.click_action } // Use click_action from data
    };

    const notification = new Notification(notificationTitle, notificationOptions);

    notification.onclick = function(event) {
        event.preventDefault(); // Prevent default behavior (e.g., opening the notification in a new tab)
        window.open(notificationOptions.data.click_action, '_blank'); // Open the URL on click
    };
});
