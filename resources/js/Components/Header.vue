<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import {ChevronDown, Plus} from "lucide-vue-next";
import {DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem} from "@/Components/ui/dropdown-menu";
import {Button} from "@/Components/ui/button";

const user = usePage().props.auth.user;
const craftsmanships = usePage().props.meta.craftsmanships;
</script>

<template>
  <header class="bg-white py-4">
    <div class="container flex justify-between items-center">
      <InertiaLink :href="route('home')">
        <img src="/logo.svg" alt=""/>
      </InertiaLink>
      <div class="flex gap-4 items-center">
        <DropdownMenu>
          <DropdownMenuTrigger class="flex gap-2">
            Nos artisanats
            <ChevronDown/>
          </DropdownMenuTrigger>
          <DropdownMenuContent>
            <template
              v-for="craftsmanship in craftsmanships"
              :key="craftsmanship.id"
            >
              <DropdownMenuItem>
                <InertiaLink
                  :href="route('craftsmanships.show', { slug: craftsmanship.id })"
                >{{ craftsmanship.name }}
                </InertiaLink
                >
              </DropdownMenuItem>
            </template>
          </DropdownMenuContent>
        </DropdownMenu>
        <template v-if="user != undefined">
          <Button v-if="user.role != 'user'" :href="route('backoffice.dashboard')" variant="outline" :as="Link">
            Backoffice
          </Button>
          <Button variant="secondary" class="bg-muted text-muted-foreground">
            <span class="hidden md:inline">Craftout</span> {{ user.credits }}
            <span class="bg-white rounded-full p-1 ml-2">
              <Plus/>
            </span>
          </Button>
          <Button :href="route('profile.edit')" :as="Link">
            Mon compte
          </Button>
        </template>
        <Button v-else :href="route('login')" :as="Link">
          Connexion
        </Button>
      </div>
    </div>
  </header>
</template>
