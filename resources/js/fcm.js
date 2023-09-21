// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBAVUMankx6HWPvyOe8plfX2C_AJ8hxInc",
  authDomain: "gsg-classroom-e09a8.firebaseapp.com",
  projectId: "gsg-classroom-e09a8",
  storageBucket: "gsg-classroom-e09a8.appspot.com",
  messagingSenderId: "1086329259346",
  appId: "1:1086329259346:web:e628be755ea81bcadb668b",
  measurementId: "G-1GMFXJP2SZ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging()