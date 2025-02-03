<script setup lang="ts">
import {Button} from "@/Components/ui/button";

interface Artisan {
  id: number;
  image: string;
  firstName: string;
  lastName: string;
  description: string;
  url: string;
}

const props = defineProps<{ artisan?: Artisan }>();

const artisan: Artisan = props.artisan ?? {
  id: 13,
  image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkCWo7KS7CK9xSsIU4KeyNpsM2doKJJ48hBg&s',
  firstName: 'Stéphane',
  lastName: 'Mariachi',
  description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam odio turpis, euismod quis laoreet non, malesuada elementum mi. Nulla condimentum sed quam at mollis. Sed venenatis porttitor tellus, in vulputate risus ullamcorper vel. Cras nec dapibus massa, eu egestas quam. Nam mattis odio sit amet nisl aliquam, et tempor turpis volutpat. Fusce at aliquet libero. Pellentesque nec',
  url: 'https://example.com/',
};

function getFirstLetterOnly(text: string): string {
  return text.charAt(0).toUpperCase() + ".";
}
</script>

<template>
  <div class="bg-green-400 bg-opacity-30 rounded-lg p-6 flex flex-col items-center text-center mb-6">
    <img :src="artisan.image" alt="Artisan picture" class="h-1/3 rounded-lg border object-cover" />
    <div class="w-full text-left">
      <h3 class="font-bold text-black mb-4">{{ artisan.firstName }} {{ getFirstLetterOnly(artisan.lastName) }}</h3>
    </div>
    <div>
      <p class="mb-4">{{ artisan.description }}</p>
    </div>
    <a :href="artisan.url">
      <Button class="bg-yellow-400 hover:bg-yellow-500">
        <p class="text-black font-bold">En savoir plus</p>
      </Button>
    </a>
  </div>
</template>
