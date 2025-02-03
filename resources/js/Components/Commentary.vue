<script setup lang="ts">

const commentaries: Comment[] = [
  { id: 1, profilePicture: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkCWo7KS7CK9xSsIU4KeyNpsM2doKJJ48hBg&s', name: 'Stéphane.M', comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam odio turpis, euismod quis laoreet non, malesuada elementum mi. Nulla condimentum sed quam at mollis.', date: '13/09/2024 9h30' },
  { id: 2, profilePicture: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkCWo7KS7CK9xSsIU4KeyNpsM2doKJJ48hBg&s', name: 'Stéphane.M', comment: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam odio turpis, euismod quis laoreet non, malesuada elementum mi. Nulla condimentum sed quam at mollis.', date: '13/09/2024 9h30' }
];
</script>

<template>
  <section class=" rounded-lg shadow-sm px-40">
    <h2 class="text-lg font-semibold leading-none tracking-tight text-primary mb-2">Commentaire :</h2>
    <div>
      <input type="text" class="w-1/2 m-4">
    </div>
    <ul>
      <li v-for="commentary in commentaries" :key="commentary.id" class="m-4">
        <div class="flex justify-between">
          <div>
            <img :src="commentary.profilePicture" alt="Material" class="h-10 w-10 rounded-lg border object-cover" />
            <p>{{ commentary.name }}</p>
          </div>
          <p>{{ commentary.date }}</p>
        </div>
        <p>{{ commentary.comment }}</p>
      </li>
    </ul>
  </section>
</template>
