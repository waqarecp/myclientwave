importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"
);
importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"
);

const firebaseConfig = {
    apiKey: "AIzaSyBLRIxATX8TWVYRSUv_sIBRyQAocaVcEf8",
    authDomain: "crmanagement-7a4dc.firebaseapp.com",
    projectId: "crmanagement-7a4dc",
    storageBucket: "crmanagement-7a4dc.appspot.com",
    messagingSenderId: "168926798104",
    appId: "1:168926798104:web:fa6ce21271b923a14a3e6d",
    measurementId: "G-RKS8SKCLX0",
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    // console.log(
    //     "[firebase-messaging-sw.js] Received background message ",
    //     payload
    // );
    // Customize notification here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.data.icon, // Use icon from data
        data: { click_action: payload.data.click_action } // Use click_action from data
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
    const notification = new Notification(notificationTitle, notificationOptions);

    notification.onclick = function(event) {
        event.preventDefault(); // Prevent default behavior (e.g., opening the notification in a new tab)
        window.open(notificationOptions.data.click_action, '_blank'); // Open the URL on click
    };
});
