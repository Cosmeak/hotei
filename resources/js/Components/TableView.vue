<script setup lang="ts">
import { defineProps } from 'vue'
const { caption, headers, rows } = defineProps<{
  caption?: string
  headers: string[]
  rows: Array<Array<string | number>>
}>()
</script>

<template>
  <div class="overflow-x-auto">
    <table class="w-full border-2 border-primary rounded-xl overflow-hidden border-separate [border-spacing:0]">
      <caption v-if="caption" class="caption-bottom text-sm text-muted-foreground mt-2">{{ caption }}</caption>

      <!-- Table Header -->
      <thead class="bg-secondary-lighter text-black font-semibold">
      <tr>
        <th v-for="(header, index) in headers" :key="index"
            class="px-4 py-3 border-b border-primary-700 text-left">
          {{ header }}
        </th>
      </tr>
      </thead>

      <!-- Table Body -->
      <tbody>
      <tr v-for="(row, rowIndex) in rows" :key="rowIndex" class="bg-white">
        <td v-for="(cell, cellIndex) in row" :key="cellIndex"
            class="px-4 py-3 border-t border-primary-700 text-left">
          {{ cell }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
