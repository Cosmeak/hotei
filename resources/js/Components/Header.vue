<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { ChevronDown, Plus } from "lucide-vue-next";
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from "@/Components/ui/dropdown-menu";
import { Button } from "@/Components/ui/button";

const user = usePage().props.auth.user;
const craftsmanships = usePage().props.meta.craftsmanships;
</script>

<template>
  <header class="bg-white py-4">
    <div class="container flex justify-between items-center">
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
        <template v-if="user != undefined">
          <Button variant="secondary" class="bg-muted text-muted-foreground">Craftout {{ user.credits }}<span class="bg-white rounded-full p-1"><Plus /></span></Button>
          <Button>Mon profil</Button>
        </template>
        <Button v-else :href="route('login')" :as="Link">
          Se connecter
        </Button>
      </div>
    </div>
  </header>
</template>
