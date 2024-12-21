<template>
    <button
      id="customGoogleButton"
      class="flex justify-center items-center px-4 py-2 w-20 bg-white border rounded-full shadow hover:bg-gray-100"
    >
      <img
        src="https://developers.google.com/identity/images/g-logo.png"
        alt="Google Logo"
        class="w-5 h-5 mr-2"
      />
    </button>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'GoogleAuth',
    mounted() {
      this.initGoogleSignIn();
    },
    methods: {
      handleGoogleLoginResponse(response) {
        console.log("Token JWT Google reçu :", response.credential);
  
        axios.post("/google-login", { token: response.credential })
          .then((res) => {
            console.log("Inscription réussie via Google", res.data);
          })
          .catch((err) => {
            console.error("Erreur lors de la connexion Google", err);
          });
      },
      loadGoogleScript() {
        return new Promise((resolve) => {
          const script = document.createElement("script");
          script.src = "https://accounts.google.com/gsi/client";
          script.async = true;
          script.defer = true;
          script.onload = () => {
            console.log("Script Google chargé");
            resolve();
          };
          document.head.appendChild(script);
        });
      },
      async initGoogleSignIn() {
        await this.loadGoogleScript();
  
        google.accounts.id.initialize({
          client_id: "VOTRE_ID_CLIENT_GOOGLE.apps.googleusercontent.com",
          callback: this.handleGoogleLoginResponse,
        });
        document.getElementById("customGoogleButton").addEventListener("click", () => {
          google.accounts.id.prompt();
        });
      }
    }
  };
  </script>
  