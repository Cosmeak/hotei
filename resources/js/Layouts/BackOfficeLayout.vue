<script setup lang="ts">
import { Button } from "@/Components/ui/button";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import { Sheet, SheetContent, SheetTrigger } from "@/Components/ui/sheet";
import { CircleUser, Menu, Package2, Moon, Sun } from "lucide-vue-next";

const updateTheme = (mode) => {
  const body = document.querySelector("body");
  if (mode == "dark") body?.classList.add("dark");
  else if (mode == "light") body?.classList.remove("dark");
};
</script>

<template>
  <div class="flex min-h-screen w-full flex-col">
    <header
      class="sticky top-0 flex h-16 items-center gap-4 border-b bg-background px-4 md:px-6"
    >
      <nav
        class="hidden flex-col gap-6 text-lg font-medium md:flex md:flex-row md:items-center md:gap-5 md:text-sm lg:gap-6"
      >
        <a
          href="#"
          class="flex items-center gap-2 text-lg font-semibold md:text-base"
        >
          <Package2 class="h-6 w-6" />
          <span class="sr-only">Acme Inc</span>
        </a>
        <a :href="route('backoffice.dashboard')" class="hover:text-foreground">
          Dashboard
        </a>
        <a
          :href="route('backoffice.course.index')"
          class="text-muted-foreground hover:text-foreground"
        >
          Courses
        </a>
        <!-- <a
            :href="route('backoffice.project.index')"
            class="text-muted-foreground hover:text-foreground"
        >
            Projects
        </a> -->
      </nav>
      <Sheet>
        <SheetTrigger as-child>
          <Button variant="outline" size="icon" class="shrink-0 md:hidden">
            <Menu class="h-5 w-5" />
            <span class="sr-only">Toggle navigation menu</span>
          </Button>
        </SheetTrigger>
        <SheetContent side="left">
          <nav class="grid gap-6 text-lg font-medium">
            <a
              :href="route('home')"
              class="flex items-center gap-2 text-lg font-semibold"
            >
              <Package2 class="h-6 w-6" />
              <span class="sr-only">Hotei</span>
            </a>
            <a
              :href="route('backoffice.dashboard')"
              class="hover:text-foreground"
            >
              Dashboard
            </a>
            <a
              :href="route('backoffice.course.index')"
              class="text-muted-foreground hover:text-foreground"
            >
              Courses
            </a>
            <!-- <a
              :href="route('backoffice.project.index')"
              class="text-muted-foreground hover:text-foreground"
            >
              Projects
            </a> -->
          </nav>
        </SheetContent>
      </Sheet>
      <div
        class="flex w-full items-center justify-end gap-4 md:ml-auto md:gap-2 lg:gap-4"
      >
        <!-- <form class="ml-auto flex-1 sm:flex-initial">
          <div class="relative">
            <Search class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
            <Input
              type="search"
              placeholder="Search products..."
              class="pl-8 sm:w-[300px] md:w-[200px] lg:w-[300px]"
            />
          </div>
        </form> -->
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="outline">
              <Moon
                class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-100"
              />
              <Sun
                class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-0"
              />
              <span class="sr-only">Toggle theme</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem @click="updateTheme('light')">
              Light
            </DropdownMenuItem>
            <DropdownMenuItem @click="updateTheme('dark')">
              Dark
            </DropdownMenuItem>
            <!-- <DropdownMenuItem @click="mode = 'auto'"> System </DropdownMenuItem> -->
          </DropdownMenuContent>
        </DropdownMenu>

        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
              <CircleUser class="h-5 w-5" />
              <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>My Account</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuItem>Support</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Logout</DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </div>
    </header>
    <main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-8">
      <slot />
    </main>
  </div>
</template>
