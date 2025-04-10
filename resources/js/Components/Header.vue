<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { ChevronDown } from "lucide-vue-next";
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from "@/Components/ui/dropdown-menu";
import { Button } from "@/Components/ui/button";

const craftsmanships = usePage().props.meta.craftsmanships;
</script>

<template>
  <header class="bg-white py-4 px-40 flex justify-between items-center">
    <img src="/logo.svg" alt="" />

    <div class="flex gap-4 items-center">
      <DropdownMenu>
        <DropdownMenuTrigger class="flex gap-2">
          Nos artisanats <ChevronDown />
        </DropdownMenuTrigger>
        <DropdownMenuContent>
          <template
            v-for="craftsmanship in craftsmanships"
            :key="craftsmanship.id"
          >
            <DropdownMenuItem>
              <InertiaLink
                :href="route('craftsmanships.show', { slug: craftsmanship.id })"
                >{{ craftsmanship.name }}</InertiaLink
              >
            </DropdownMenuItem>
          </template>
        </DropdownMenuContent>
      </DropdownMenu>

      <Button>Mon profil</Button>
    </div>
  </header>
</template>
