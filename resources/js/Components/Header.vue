<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { ChevronDown, Plus, Menu } from "lucide-vue-next";
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from "@/Components/ui/dropdown-menu";
import { Button } from "@/Components/ui/button";
import { Sheet, SheetTrigger, SheetContent } from "@/Components/ui/sheet";
import { NavigationMenu, NavigationMenuList, NavigationMenuItem, NavigationMenuLink } from "@/Components/ui/navigation-menu";
import PaymentModal from "@/Components/PaymentModal.vue";

const user = usePage().props.auth.user;
const craftsmanships = usePage().props.meta.craftsmanships;
</script>

<template>
  <header class="bg-white py-4">
    <div class="container flex justify-between items-center">
      <InertiaLink :href="route('home')">
        <img src="/logo.svg" alt="" />
      </InertiaLink>
      <div class="hidden md:flex gap-4 items-center">
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
          <Button v-if="user.role != 'user'" :href="route('backoffice.dashboard')" variant="outline" :as="Link">
            Backoffice
          </Button>

          <PaymentModal btn-classes="bg-muted text-muted-foreground" btn-variant="secondary">
            <template #button>
              Craftout {{ user.credits }}<span class="bg-white rounded-full p-1"><Plus /></span>
            </template>
          </PaymentModal>
          <Button :href="route('profile.edit')" :as="Link">
            Mon compte
          </Button>
        </template>
        <Button v-else :href="route('login')" :as="Link">
          Connexion
        </Button>
      </div>
      <div class="md:hidden">
        <Sheet>
          <SheetTrigger as-child>
            <Button variant="ghost" size="icon">
              <Menu />
            </Button>
          </SheetTrigger>   
          <SheetContent class="p-6">
            <div class="flex flex-col gap-4 w-full mt-6">
              <NavigationMenu class="w-full [&>div]:w-full [&>div]:max-w-none">
                <NavigationMenuList class="flex flex-col gap-4 w-full">
                  <NavigationMenuItem>
                    <NavigationMenuLink as-child>
                      <DropdownMenu>
                        <DropdownMenuTrigger
                          class="w-[260px] mx-auto border rounded text-base font-medium h-12 flex items-center justify-between px-4"
                        >
                          <span>Nos artisanats</span>
                          <ChevronDown class="w-4 h-4" />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent class="w-[260px] mx-auto mt-1 border rounded-md bg-white shadow-sm">
                          <template
                            v-for="craftsmanship in craftsmanships"
                            :key="craftsmanship.id"
                          >
                            <DropdownMenuItem>
                              <InertiaLink
                                :href="route('craftsmanships.show', { slug: craftsmanship.id })"
                                class="block w-full px-4 py-2 text-sm"
                              >
                                {{ craftsmanship.name }}
                              </InertiaLink>
                            </DropdownMenuItem>
                          </template>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </NavigationMenuLink>
                  </NavigationMenuItem>

                  <template v-if="user != undefined">
                    <NavigationMenuItem>
                      <div class="flex justify-center">
                        <Button
                          variant="secondary"
                          class="w-[260px] bg-muted text-muted-foreground"
                        >
                          Craftout {{ user.credits }}
                          <span class="bg-white rounded-full p-1 ml-2"><Plus /></span>
                        </Button>
                      </div>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                      <NavigationMenuLink as-child>
                        <Button
                          :href="route('profile.edit')"
                          :as="Link"
                          class="w-[260px] h-12 mx-auto flex items-center justify-center text-base rounded-full"
                        >
                          Mon compte
                        </Button>
                      </NavigationMenuLink>
                    </NavigationMenuItem>
                  </template>

                  <NavigationMenuItem v-else>
                    <NavigationMenuLink as-child>
                      <Button
                        :href="route('login')"
                        :as="Link"
                        class="w-[260px] mx-auto justify-start text-left h-12 text-base"
                      >
                        Connexion
                      </Button>
                    </NavigationMenuLink>
                  </NavigationMenuItem>
                </NavigationMenuList>
              </NavigationMenu>
            </div>
          </SheetContent>
        </Sheet>
      </div>
    </div>
  </header>
</template>
