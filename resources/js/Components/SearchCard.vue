<script setup lang="ts">
import {ref} from "vue"
import {Course, Project} from "@/types"
import {Input} from "@/Components/ui/input"
import {Button} from "@/Components/ui/button"
import {
  Popover,
  PopoverContent,
  PopoverTrigger
} from "@/Components/ui/popover"
import {Checkbox} from "@/Components/ui/checkbox"
import {Label} from "@/Components/ui/label"
import {router} from '@inertiajs/vue3'

function applyFilters() {
  router.get(
    route('craftsmanships.show', {slug: props.slug}),
    {
      search: search.value,
      difficulties: selectedDifficulties.value.join(','),
      min_price: minPrice.value,
      max_price: maxPrice.value,
    },
    {
      preserveScroll: true,
      preserveState: false,
    }
  )
}

function resetFilters() {
  router.get(route('craftsmanships.show', { slug: props.slug }))
}

const props = defineProps<{
  scope: Project | Course
  slug: string
  initialSearch?: string
  initialDifficulties?: Record<number, number>
  initialMinPrice?: number
  initialMaxPrice?: number
  availableDifficulties: Array<{ name: string; value: number }>
}>()

const search = ref(props.initialSearch ?? '')
const selectedDifficulties = ref<number[]>(props.initialDifficulties?.map((item: number): number => Number(item)));
const minLimit = 0
const maxLimit = 200
const minPrice = ref(props.initialMinPrice ?? minLimit)
const maxPrice = ref(props.initialMaxPrice ?? maxLimit)

const sliderRef = ref<HTMLElement | null>(null)

function toggleDifficulty(is_added: boolean, difficulty: number) {
  if (is_added) {
    selectedDifficulties.value.push(difficulty);
  } else {
    const index = selectedDifficulties.value.indexOf(difficulty);
    selectedDifficulties.value.splice(index, 1);
  }
}

function calculateValue(clientX: number) {
  if (!sliderRef.value) return 0
  const rect = sliderRef.value.getBoundingClientRect()
  const percent = (clientX - rect.left) / rect.width
  return Math.round(minLimit + percent * (maxLimit - minLimit))
}

function onThumbMouseDown(which: "min" | "max") {
  const moveHandler = (e: MouseEvent) => {
    const value = calculateValue(e.clientX)
    if (which === "min") {
      if (value >= minLimit && value < maxPrice.value) {
        minPrice.value = value
      }
    } else {
      if (value <= maxLimit && value > minPrice.value) {
        maxPrice.value = value
      }
    }
  }
  const upHandler = () => {
    document.removeEventListener("mousemove", moveHandler)
    document.removeEventListener("mouseup", upHandler)
  }
  document.addEventListener("mousemove", moveHandler)
  document.addEventListener("mouseup", upHandler)
}

const selectedDifficultiesToString = () => props.availableDifficulties.filter((difficulty) => selectedDifficulties.value.includes(difficulty.value)).map((difficulty) => difficulty.name).join(', ')
</script>

<template>
  <div class="bg-secondary-lighter p-4 space-y-6 rounded-lg">
    <Input
      v-model="search"
      @keyup.enter="applyFilters"
      type="text"
      class="bg-background rounded-full pr-12 w-full"
      placeholder="Chercher un projet"
    />
    <Popover>
      <PopoverTrigger as-child>
        <Button
          variant="outline"
          class="w-full justify-start bg-background rounded-lg"
        >
          <span v-if=selectedDifficultiesToString()>
            {{ selectedDifficultiesToString() }}
          </span>
          <span v-else>
            Choisissez une difficultée
          </span>
        </Button>
      </PopoverTrigger>
      <PopoverContent class="w-60">
        <div class="flex flex-col space-y-2">
          <div
            v-for="difficulty in  availableDifficulties"
            :key="difficulty.value"
            class="flex items-center gap-2"
          >
            <Checkbox
              :id="difficulty.name"
              :model-value="selectedDifficulties.includes(difficulty.value)"
              @update:model-value="(is_added: boolean) => toggleDifficulty(is_added, difficulty.value)"
            />
            <Label :for="difficulty.name">{{ difficulty.name }}</Label>
          </div>
        </div>
      </PopoverContent>
    </Popover>

    <div class="space-y-2 flex items-center gap-6">
      <div class="flex flex-row bg-background items-center p-2 rounded gap-1">
        <p>{{ minPrice }}</p>
        <p>Craftout</p>
      </div>
      <div ref="sliderRef" class="relative h-2 bg-gray-300 rounded-full w-full">
        <div
          class="absolute h-full bg-primary rounded-full"
          :style="{
            left: `${((minPrice - minLimit) / (maxLimit - minLimit)) * 100}%`,
            width: `${((maxPrice - minPrice) / (maxLimit - minLimit)) * 100}%`
          }"
        />
        <div
          class="absolute top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-2 border-primary rounded-full cursor-pointer"
          :style="{ left: `${((minPrice - minLimit) / (maxLimit - minLimit)) * 100}%` }"
          @mousedown="onThumbMouseDown('min')"
        />
        <div
          class="absolute top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-2 border-primary rounded-full cursor-pointer"
          :style="{ left: `${((maxPrice - minLimit) / (maxLimit - minLimit)) * 100}%` }"
          @mousedown="onThumbMouseDown('max')"
        />
      </div>
      <div class="flex flex-row bg-background items-center p-2 rounded gap-1">
        <p>{{ maxPrice }}</p>
        <p>Craftout</p>
      </div>
    </div>
    <div class="flex gap-4 justify-between">
      <Button variant="secondary" @click="resetFilters">
        Réinitialiser les filtres
      </Button>
      <Button @click="applyFilters">Appliquer les filtres</Button>
    </div>
  </div>
</template>
