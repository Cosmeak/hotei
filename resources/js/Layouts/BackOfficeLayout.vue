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
import { CircleUser, Menu, Package2 } from "lucide-vue-next";
</script>

<template>
  <div class="flex min-h-screen w-full flex-col">
    <header
      class="sticky top-0 flex h-16 items-center gap-4 border-b px-4 md:px-8 bg-white z-10"
    >
      <nav
        class="hidden flex-col gap-6 text-lg font-medium md:flex md:flex-row md:items-center md:gap-5 md:text-sm lg:gap-6"
      >
        <InertiaLink href="/">
          <img src="/logo.svg" class="h-24" alt="">
        </InertiaLink>
        <InertiaLink :href="route('backoffice.dashboard')" class="hover:text-foreground">
          Dashboard
        </InertiaLink>
        <InertiaLink
          v-if="$page.props.auth.user.role == 'admin'"
          :href="route('backoffice.user.index')"
          class="text-muted-foreground hover:text-foreground"
        >
          Utilisateurs
        </InertiaLink>
        <InertiaLink v-if="$page.props.auth.user.role == 'admin'" :href="route('backoffice.craftsmanship.index')" class="hover:text-foreground">
          Artisanats
        </InertiaLink>
        <InertiaLink :href="route('backoffice.project.index')" class="hover:text-foreground">
          Projets
        </InertiaLink>
        <InertiaLink
          :href="route('backoffice.course.index')"
          class="text-muted-foreground hover:text-foreground"
        >
          Compétences
        </InertiaLink>
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
    <main class="flex flex-1 flex-col gap-4 m-4 md:gap-8 md:m-8">
      <slot />
    </main>
  </div>
</template>
