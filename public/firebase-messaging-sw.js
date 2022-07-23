// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyB8x-DPb-_Pg3ZQg5_9Qm5jbVNwIwxsGnE",
    authDomain: "ejobcard-77bd3.firebaseapp.com",
    projectId: "ejobcard-77bd3",
    storageBucket: "ejobcard-77bd3.appspot.com",
    messagingSenderId: "89067202111",
    appId: "1:89067202111:web:f2c41a8156e0c67c56fa8a",
    measurementId: "G-WXXP7N0S7T"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});