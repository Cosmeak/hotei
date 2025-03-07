<script setup lang="ts">
defineProps<{
    image: string;
    title: string;
    author: string;
    description: string;
    difficulty: string;
    duration: string;
}>();
</script>

<template>
    <div class="card-fixed-width relative border-2 border-[#104730] rounded-lg bg-white p-4 flex ml-auto mt-5 mr-2" style="width: 320px;">
        <div class="absolute top-2 left-2 bg-[#F7DCB9] text-[#104730] text-xs font-semibold px-2 py-0.5 rounded">
            Compétence
        </div>
        <div class="flex-shrink-0 mr-4">
            <img :src="image" :alt="title" class="rounded object-cover" style="width: 100px; height: 70px;" />
        </div>
        <div class="flex flex-col flex-grow justify-between">
            <div>
            <p class="text-sm font-bold text-[#104730] mb-1">{{ title }}</p>
            <p class="text-xs text-gray-600">par {{ author }}</p>
            <hr class="my-2 border-gray-300" />
            <p class="text-xs text-gray-600 mb-2">{{ description }}</p>
            </div>
            <div class="flex items-center justify-between">
            <div class="text-xs text-gray-600 leading-tight">
                <p>{{ difficulty }}</p>
                <p>{{ duration }}</p>
            </div>
            <span class="inline-block text-white bg-[#104730] px-2 py-1 text-xs rounded">
                Offert
            </span>
            </div>
        </div>
    </div>
</template>