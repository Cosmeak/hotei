<script setup lang="ts">
import { Craftsmanship } from '@/types';
import { PaginatedResponse } from '@/types/laravel';
import { Button } from '@/Components/ui/button';
import { Plus, MoreHorizontal } from "lucide-vue-next";
import { Card, CardContent, CardFooter } from "@/Components/ui/card";
import { Table, TableHeader, TableRow, TableBody, TableCell, TableHead } from "@/Components/ui/table";
import { DropdownMenu, DropdownMenuLabel, DropdownMenuTrigger, DropdownMenuItem, DropdownMenuContent } from "@/Components/ui/dropdown-menu";
import LaravelPagination from "@/Components/LaravelPagination.vue";
import FormModal from './Partials/FormModal.vue';

const { craftsmanships } = defineProps<{ craftsmanships: PaginatedResponse<Craftsmanship> }>();
</script>

<template>
  <div class="flex justify-end">
    <FormModal trigger-text="Ajouter un artisanat" trigger-variant="default" />
  </div>

  <Card class="bg-white">
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Nom</TableHead>
            <TableHead>Description</TableHead>
            <TableHead>Couleur</TableHead>
            <TableHead />
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-for="cm in craftsmanships.data" :key="cm.id">
            <TableRow>
              <TableCell>{{ cm.name }}</TableCell>
              <TableCell style="max-width: 400px;">{{ cm.description }}</TableCell>
              <TableCell>{{ cm.color }}</TableCell>
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
                      <button class="text-start">Modifier</button>
                    </DropdownMenuItem>
                    <DropdownMenuItem>
                      <InertiaLink
                        as="button"
                        method="delete"
                        class="w-full text-start"
                        :href="route('backoffice.craftsmanship.destroy', { craftsmanship: cm.id })"
                        >
                          Supprimer
                      </InertiaLink>
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>
          </template>
        </TableBody>
      </Table>
    </CardContent>
    <CardFooter class="justify-center">
      <LaravelPagination :paginatedResponse="craftsmanships" />
    </CardFooter>
  </Card>
</template>
