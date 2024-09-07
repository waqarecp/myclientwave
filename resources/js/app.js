import './bootstrap';

// Firebase setup
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Firebase configuration (same as in your firebase-messaging-sw.js)
const firebaseConfig = {
    apiKey: "AIzaSyBLRIxATX8TWVYRSUv_sIBRyQAocaVcEf8",
    authDomain: "crmanagement-7a4dc.firebaseapp.com",
    projectId: "crmanagement-7a4dc",
    storageBucket: "crmanagement-7a4dc.appspot.com",
    messagingSenderId: "168926798104",
    appId: "1:168926798104:web:fa6ce21271b923a14a3e6d",
    measurementId: "G-RKS8SKCLX0"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Get Firebase Messaging instance
const messaging = getMessaging(app);

// Register the service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then((registration) => {
        console.log('Service Worker registered with scope:', registration.scope);
    }).catch((err) => {
        console.log('Service Worker registration failed:', err);
    });
}

// Request notification permission and get FCM token
Notification.requestPermission().then(permission => {
    if (permission === 'granted') {
        console.log('Notification permission granted.');

        // Get the FCM token for the device
        getToken(messaging, { vapidKey: 'jJak_qGiZyOPz22LWOSRNhZDFBXyJAZahV9Zi1E4nE8' }).then((currentToken) => {
            if (currentToken) {
                console.log('FCM Token:', currentToken);
                // Send this token to the server if needed for sending notifications
            } else {
                console.log('No registration token available.');
            }
        }).catch((err) => {
            console.log('Error retrieving token: ', err);
        });

        // Handle foreground notifications
        onMessage(messaging, (payload) => {
            console.log('Message received. ', payload);
            // Show notification for foreground message
            new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: payload.notification.icon,
            });
        });
    } else {
        console.log('Notification permission denied.');
    }
});
