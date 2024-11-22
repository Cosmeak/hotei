<template>
  <div class="upload-container" @drop.prevent="handleDrop" @dragover.prevent>
    <p>Déposez votre fichier MP4 ici ou cliquez pour le télécharger</p>
    <input type="file" ref="fileInput" @change="handleFileChange" accept="video/mp4" />
  </div>
  <button @click="uploadFile" :disabled="isUploading">Télécharger la vidéo</button>

  <div v-if="videoUrl || audioUrl">
    <p>Traitement terminé ! Téléchargez les fichiers ci-dessous :</p>
    <a v-if="videoUrl" :href="videoUrl" target="_blank">Télécharger Vidéo (VP9)</a><br>
    <a v-if="audioUrl" :href="audioUrl" target="_blank">Télécharger Audio (Opus)</a>
  </div>

  <div v-if="isUploading">
    <p>Téléchargement et traitement en cours, veuillez patienter...</p>
  </div>

  <div v-if="errorMessage">
    <p class="error">Erreur : {{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: this.$inertia.form({
        video: null,
      }),
      file: null,
      isUploading: false,
      videoUrl: '',
      audioUrl: '',
      errorMessage: '',  
    };
  },
  methods: {
    handleDrop(event) {
      this.file = event.dataTransfer.files[0];
    },
    handleFileChange(event) {
      this.file = event.target.files[0];
    },
    async uploadFile() {
      if (!this.file || this.file.type !== 'video/mp4') {
        alert('Veuillez télécharger un fichier MP4 valide.');
        return;
      }

      this.isUploading = true;
      this.errorMessage = '';  // Réinitialise le message d'erreur

      try {
        const formData = new FormData();
        formData.append('video', this.file);

        const response = await axios.post(route('test.store'), formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        
        this.videoUrl = response.data.video_url;
        this.audioUrl = response.data.audio_url;
      } catch (error) {
        this.errorMessage = 'Échec du traitement de la vidéo';
      } finally {
        this.isUploading = false;
      }
    },
  },
};
</script>

<style scoped>
.upload-container {
  width: 300px;
  height: 150px;
  border: 2px dashed #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
input[type='file'] {
  display: none;
}
.error {
  color: red;
  font-weight: bold;
}
</style>
