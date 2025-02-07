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
    <div class="card-fixed-width relative border-2 border-[#a0c1a6] rounded-lg bg-white flex ml-auto mt-5 mr-2" style="width: 320px;">
        <div class="flex-shrink-0 mr-4 flex-1">
            <img :src="image" :alt="title" class="rounded object-cover w-full h-full" />
        </div>
            <div class="flex flex-col flex-grow justify-between flex-1 p-4">
                <div>
                    <div class="inline-block bg-[#F7DCB9] text-[#104730] text-xs font-semibold px-1 py-1 rounded">
                    Compétence
                    </div>
                    <p class="text-sm font-bold text-[#104730] mb-1">{{ title }}</p>
                    <p class="text-xs text-gray-600 mb-2">{{ description }}</p>
                    <p class="text-xs text-gray-600">par {{ author }}</p>
                    <hr class="my-2 border-gray-300" />
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-600 leading-tight">
                        <p><i class="fas fa-tasks mr-1"></i>{{ difficulty }}</p>
                        <p><i class="fas fa-clock mr-1"></i>{{ duration }}</p>
                    </div>
                <span class="inline-block text-white bg-[#104730] px-2 py-1 text-xs rounded">
                    Offert
                </span>
                </div>
            </div>
    </div>
</template>