<script setup lang="ts">
</script>

<template>
  <section class="bg-black py-4 px-4 md:px-40 text-white">
    <div class="hidden md:flex justify-between md:visible">
      <p>Copyright {{ new Date().getFullYear() }} - <span class="font-bold">Hotei</span> - Tous droits réservés</p>
      <a href="">
        <p>Mention légales</p>
      </a>
    </div>
    <div class="text-center text-s md:hidden">
      <a href="">
        <p>Mention légales</p>
      </a>
      <p>Copyright {{ new Date().getFullYear() }} - <span class="font-bold">Hotei</span> - Tous droits réservés</p>
    </div>
  </section>
</template>
