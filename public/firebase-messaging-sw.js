/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyA3f4SaevnrYvHebpNdUD1L3u1hqL8-NTM",

  authDomain: "uniplusco-da457.firebaseapp.com",

  projectId: "uniplusco-da457",

  storageBucket: "uniplusco-da457.appspot.com",

  messagingSenderId: "818355003166",

  appId: "1:818355003166:web:a6ca735ad6ef254e77f30f",

  measurementId: "G-WPL4MJ6C05"

});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Uniplus";
  const notificationOptions = {
    body: "Welcome to uniplus.",
    icon: "/itwonders-web-logo.png",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});
