// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
const analytics = getAnalytics(app);