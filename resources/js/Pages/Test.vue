<template>
    <div class="upload-container" @drop.prevent="handleDrop" @dragover.prevent>
      <p>Drag and drop your MP4 file here or click to upload</p>
      <input type="file" ref="fileInput" @change="handleFileChange" accept="video/mp4" />
    </div>
    <button @click="uploadFile" :disabled="isUploading">Upload Video</button>
  
    <!-- Feedback: display the links to the processed video/audio -->
    <div v-if="videoUrl || audioUrl">
      <p>Processing complete! Download the files below:</p>
      <a v-if="videoUrl" :href="videoUrl" target="_blank">Download Video (VP9)</a><br>
      <a v-if="audioUrl" :href="audioUrl" target="_blank">Download Audio (Opus)</a>
    </div>
  
    <!-- Loading indicator -->
    <div v-if="isUploading">
      <p>Uploading and processing video, please wait...</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: this.$inertia.form({
            video: null
        }),
        file: null,
        isUploading: false,
        videoUrl: '',
        audioUrl: '',
      };
    },
    methods: {
      handleDrop(event) {
        this.file = event.dataTransfer.files[0];
      },
      handleFileChange(event) {
        this.file = event.target.files[0];
      },
    uploadFile() {
        if (!this.file || this.file.type !== 'video/mp4') {
          alert('Please upload a valid MP4 file.');
          return;
        }
  
        this.isUploading = true;
        // const formData = new FormData();
        // formData.append('video', this.file);
        this.form.video = this.file;

          const response =  this.form.post(route('test.store'));
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
  </style>
  