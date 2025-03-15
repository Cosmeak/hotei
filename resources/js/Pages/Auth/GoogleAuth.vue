<template>
  <div>
    <div id="customGoogleButton"></div>
  </div>
</template>
  
<script>
  import axios from "axios";
  
  export default {
  name: "GoogleAuth",
  data() {
    return {
      user: null, 
    };
  },
  mounted() {
    this.initGoogleSignIn();
  },
  methods: {
    handleGoogleLoginResponse(response) {
      console.log("Token JWT Google reçu :", response.credential);

      axios
        .post("/google-login", { token: response.credential })
        .then((res) => {
          console.log("Inscription réussie via Google", res.data);

          this.user = res.data.user;

          localStorage.setItem("user", JSON.stringify(res.data.user));

          this.$router.push("/");
        })
        .catch((err) => {
          console.error("Erreur lors de la connexion Google", err);
        });
    },

    loadGoogleScript() {
      return new Promise((resolve) => {
        if (document.getElementById("google-script")) {
          resolve();
          return;
        }

        const script = document.createElement("script");
        script.id = "google-script";
        script.src = "https://accounts.google.com/gsi/client";
        script.async = true;
        script.defer = true;
        script.onload = () => {
          console.log("Script Google chargé !");
          resolve();
        };
        document.head.appendChild(script);
      });
    },

    async initGoogleSignIn() {
      await this.loadGoogleScript();

      google.accounts.id.initialize({
        client_id:
          "247889674962-l6itp31i9r99sqo254t57jpj71afc7tq.apps.googleusercontent.com",
        callback: this.handleGoogleLoginResponse,
      });

      console.log("Google Identity Services initialisé");

      const button = document.getElementById("customGoogleButton");
      if (button) {
        google.accounts.id.renderButton(button, {
          theme: "outline",
          size: "large",
        });
      } else {
        console.error("Le bouton Google n'a pas été trouvé !");
      }
    },
  },
};

</script>
  