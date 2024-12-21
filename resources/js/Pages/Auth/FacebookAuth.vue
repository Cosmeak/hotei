<template>
    <button
      @click="handleFacebookLogin"
      id="facebookButton"
      class="flex justify-center items-center px-4 py-2 w-20 bg-white border rounded-full shadow hover:bg-gray-100"
    >
      <img
        src="https://www.facebook.com/images/fb_icon_325x325.png"
        alt="Facebook Logo"
        class="w-5 h-5 mr-2"
      />
    </button>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'FacebookAuth',
    mounted() {
      this.loadFacebookSDK();
    },
    methods: {
      loadFacebookSDK() {
        return new Promise((resolve) => {
          window.fbAsyncInit = function() {
            FB.init({
              appId: 'VOTRE_APP_ID_FACEBOOK',
              cookie: true,
              xfbml: true,
              version: 'v12.0'
            });
            console.log("SDK Facebook chargé et initialisé");
            resolve();
          };
  
          const script = document.createElement('script');
          script.src = "https://connect.facebook.net/en_US/sdk.js";
          script.async = true;
          script.defer = true;
          document.head.appendChild(script);
        });
      },
      handleFacebookLogin() {
        FB.login((response) => {
          if (response.authResponse) {
            console.log('Connecté et authentifié');
            axios.post("/facebook-login", { token: response.authResponse.accessToken })
              .then((res) => {
                console.log("Inscription réussie via Facebook", res.data);
              })
              .catch((err) => {
                console.error("Erreur lors de la connexion Facebook", err);
              });
          } else {
            console.log('Non authentifié');
          }
        }, { scope: 'public_profile,email' });
      }
    }
  };
  </script>
  
  