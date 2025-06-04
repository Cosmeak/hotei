<script setup lang="ts">
import { defineProps } from 'vue'
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table'
const props = defineProps<{
  caption?: string
  headers: string[]
  rows: Array<Array<string | number>>
}>()
</script>

<template>
  <Table>
    <TableCaption v-if="caption">{{ caption }}</TableCaption>
    <TableHeader>
      <TableRow>
        <TableHead v-for="(header, index) in headers" :key="index">
          {{ header }}
        </TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="(row, rowIndex) in rows" :key="rowIndex">
        <TableCell v-for="(cell, cellIndex) in row" :key="cellIndex">
          {{ cell }}
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
