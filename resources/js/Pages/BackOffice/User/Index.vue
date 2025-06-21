<script setup lang="ts">
import { MoreHorizontal } from "lucide-vue-next";
import { User } from '@/types';
import { PaginatedResponse } from '@/types/laravel';
import { Card, CardContent, CardFooter } from '@/Components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { DropdownMenu, DropdownMenuLabel, DropdownMenuTrigger, DropdownMenuItem, DropdownMenuContent } from "@/Components/ui/dropdown-menu";
import LaravelPagination from '@/Components/LaravelPagination.vue';
import { Button } from "@/Components/ui/button";

import { formatDate } from '@vueuse/core';


const { users } = defineProps<{ users: PaginatedResponse<User>}>();
</script>

<template>
  <Card class="bg-white">
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Email</TableHead>
            <TableHead>Prénom</TableHead>
            <TableHead>Nom</TableHead>
            <TableHead>Statut</TableHead>
            <TableHead>Date de création</TableHead>
            <TableHead />
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="user in users.data" :key="user.id">
            <TableCell>{{ user.email }}</TableCell>
            <TableCell>{{ user.firstname }}</TableCell>
            <TableCell>{{ user.lastname }}</TableCell>
            <TableCell>{{ '-' }}</TableCell>
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
