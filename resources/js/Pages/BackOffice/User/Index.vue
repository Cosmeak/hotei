<script setup lang="ts">
import { MoreHorizontal } from "lucide-vue-next";
import { User } from '@/types';
import { PaginatedResponse } from '@/types/laravel';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { DropdownMenu, DropdownMenuLabel, DropdownMenuTrigger, DropdownMenuItem, DropdownMenuContent } from "@/Components/ui/dropdown-menu";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import { Input } from "@/Components/ui/input";
import LaravelPagination from '@/Components/LaravelPagination.vue';
import { Button } from "@/Components/ui/button";
import { formatDate } from '@vueuse/core';
import { router } from "@inertiajs/vue3";

const { users, roles } = defineProps<{ users: PaginatedResponse<User>, roles: string[] }>();

let timeout: number|undefined = undefined;
const handleSearch = (event: KeyboardEvent) => {
  clearTimeout(timeout);
  timeout = setTimeout(() => router.get(route('backoffice.user.index', { email: event.target?.value })), 100);
};

const handleUpdateRole = (user_id: string, role: string) => {
  router.put(route('backoffice.user.update', { user: user_id }), { role: role });
};
</script>

<template>
  <Input id="search" name="search" type="text" @keyup="handleSearch" class="bg-white" placeholder="Rechercher un utilisateur via email" style="max-width: 320px;" />
  <Card class="bg-white">
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Email</TableHead>
            <TableHead>Prénom</TableHead>
            <TableHead>Nom</TableHead>
            <TableHead>Role</TableHead>
            <TableHead>Date de création</TableHead>
            <TableHead />
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="user in users.data" :key="user.id">
            <TableCell>{{ user.email }}</TableCell>
            <TableCell>{{ user.firstname }}</TableCell>
            <TableCell>{{ user.lastname }}</TableCell>
            <TableCell>
              <Select :defaultValue="user.role" @update:modelValue="(role: string) => handleUpdateRole(user.id, role)">
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectGroup>
                      <SelectItem v-for="(role, index) in roles" :key="index" :value="role">
                        {{ role }}
                      </SelectItem>
                    </SelectGroup>
                  </SelectContent>
                </Select>
            </TableCell>
            <TableCell>{{ formatDate(new Date(user.created_at), 'YYYY-MM-DD HH:mm:ss') }}</TableCell>
            <TableCell>
              <DropdownMenu>
                <DropdownMenuTrigger as-child>
                  <Button aria-haspopup="true" size="icon" variant="ghost">
                    <MoreHorizontal class="h-4 w-4" />
                    <span class="sr-only">Toggle menu</span>
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                  <DropdownMenuLabel>Actions</DropdownMenuLabel>
                  <DropdownMenuItem>
                    <!-- TODO: Add a modal to edit user variables -->
                    <button variant="ghost">Edit</button>
                  </DropdownMenuItem>
                  <DropdownMenuItem>
                    <InertiaLink
                      as="button"
                      method="delete"
                      class="w-full text-start"
                      :href="route('backoffice.user.destroy', { user: user.id })"
                    >
                      Delete
                    </InertiaLink>
                  </DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
    <CardFooter>
      <LaravelPagination :paginatedResponse="users" />
    </CardFooter>
  </Card>
</template>
