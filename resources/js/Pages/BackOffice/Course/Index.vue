<script setup lang="ts">
import { MoreHorizontal, Plus } from "lucide-vue-next";
import { Link } from "@inertiajs/vue3";
import { Card, CardContent, CardFooter } from "@/Components/ui/card";
import { Button } from "@/Components/ui/button";
import { Table, TableHeader, TableRow, TableBody, TableCell, TableHead } from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";
import { DropdownMenu, DropdownMenuLabel, DropdownMenuTrigger, DropdownMenuItem, DropdownMenuContent } from "@/Components/ui/dropdown-menu";
import { PaginatedResponse } from "@/types/laravel";
import { Course } from "@/types";
import LaravelPagination from "@/Components/LaravelPagination.vue";
import { formatDate } from "@vueuse/core";

const { courses, skillOnly } = defineProps<{ courses: PaginatedResponse<Course>, skillOnly: boolean }>();
</script>

<template>
  <div class="flex justify-end">
    <Button
      :as="Link"
      :href="route('backoffice.course.create')"
      >
        <Plus /> Ajouter un cours
    </Button>
  </div>
  <Card class="bg-white">
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]">Titre</TableHead>
            <TableHead>Categorie</TableHead>
            <TableHead>Coût</TableHead>
            <TableHead>Statut</TableHead>
            <TableHead>Date de création</TableHead>
            <TableHead />
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-if="courses.total > 0">
            <TableRow v-for="course in courses.data" :key="course.id">
              <TableCell class="font-medium">
                {{ course.title }}
              </TableCell>
              <TableCell>
                <Badge>{{ course.category }}</Badge>
              </TableCell>
              <TableCell>{{ course.cost }}</TableCell>
              <TableCell>
                <Badge :variant="course.is_draft ? 'secondary' : 'default'">{{
                  course.is_draft ? "Draft" : "Publié"
                }}</Badge>
              </TableCell>
              <TableCell>{{ formatDate(new Date(course.created_at), 'YYYY-MM-DD HH:mm:ss') }}</TableCell>
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
                      <InertiaLink
                        class="w-full"
                        :href="
                          route('backoffice.course.edit', {
                            course: course.id,
                          })
                        "
                        >Modifier</InertiaLink
                      >
                    </DropdownMenuItem>
                    <DropdownMenuItem>
                      <InertiaLink
                        as="button"
                        method="delete"
                        class="w-full text-start"
                        :href="
                          route('backoffice.course.destroy', {
                            course: course.id,
                          })
                        "
                        >Supprimer</InertiaLink
                      >
                    </DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </TableCell>
            </TableRow>
          </template>
          <TableRow v-else>
            <TableCell colspan="5">
              <p class="text-center font-medium">
                Vous n'avez ajouté aucun cours ou compétence pour le moment. <br />
                Appuyer sur le bouton ajouter un cours pour en créer un.
              </p>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
    <CardFooter v-if="courses.last_page != 1" class="justify-center">
      <LaravelPagination :paginatedResponse="courses" />
    </CardFooter>
  </Card>
</template>
