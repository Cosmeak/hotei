<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-[#d9e8dc]">
        <div class="flex justify-start items-start w-full px-6">
            <Link href="/">
                <ApplicationLogo class="w-25 h-25 fill-current text-gray-500" />
            </Link>
        </div>
        <div
            
        >
            <slot />
        </div>
    </div>
</template>

