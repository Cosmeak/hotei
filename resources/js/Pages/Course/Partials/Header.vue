<script setup lang="ts">
interface CourseHeader {
  title: string;
  duration: number;
}

const props = defineProps<{
  header?: CourseHeader;
}>();

const header: CourseHeader = props.header ?? {
  title: 'placeholder course',
  duration: 50,
};
</script>

<template>
  <header class="flex justify-around object-center p-10 text-2xl">
    <h1>{{ header.title }}</h1>
    <span>{{ header.duration }}"</span>
  </header>
</template>
