<script setup lang="ts">
import {PaginatedResponse} from "@/types/laravel";
import {Project} from "@/types";
import {Card, CardContent, CardFooter} from "@/Components/ui/card";
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "@/Components/ui/table";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuTrigger
} from "@/Components/ui/dropdown-menu";
import {MoreHorizontal, Plus} from "lucide-vue-next";
import {Button} from "@/Components/ui/button";
import LaravelPagination from "@/Components/LaravelPagination.vue";
import {Badge} from "@/Components/ui/badge";
import {Link} from "@inertiajs/vue3";

const {projects} = defineProps<{ projects: PaginatedResponse<Project> }>();

</script>
<template>
  <div class="flex justify-end">
    <Button
      :as="Link"
      :href="route('backoffice.project.create')"
    >
      <Plus /> Ajouter un projet
    </Button>
  </div>
  <Card class="bg-white">
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>Titre</TableHead>
            <TableHead>Description</TableHead>
            <TableHead>Durée</TableHead>
            <TableHead>Difficulté</TableHead>
            <TableHead>Coût</TableHead>
            <TableHead>Status</TableHead>
            <TableHead/>
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-if="projects.total > 0">
            <TableRow v-for="proj in projects.data" :key="proj.id">
              <TableCell class="max-w-[100px] truncate whitespace-nowrap overflow-hidden">{{ proj.title }}</TableCell>
              <TableCell class="max-w-[100px] truncate whitespace-nowrap overflow-hidden">{{
                  proj.description
                }}
              </TableCell>
              <TableCell>{{ proj.duration }}</TableCell>
              <TableCell>{{ proj.difficulty }}</TableCell>
              <TableCell>{{ proj.cost }}</TableCell>
              <TableCell>
                <Badge :variant="proj.is_draft ? 'secondary' : 'default'">{{
                    proj.is_draft ? "Draft" : "Publié"
                  }}
                </Badge>
              </TableCell>
              <TableCell>
                <DropdownMenu>
                  <DropdownMenuTrigger as-child>
                    <Button aria-haspopup="true" size="icon" variant="ghost">
                      <MoreHorizontal class="h-4 w-4"/>
                      <span class="sr-only">Toggle menu</span>
                    </Button>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent align="end">
                    <DropdownMenuLabel>Actions</DropdownMenuLabel>
                    <DropdownMenuItem>
                      <InertiaLink
                        class="w-full"
                        :href="
                          route('backoffice.project.edit', {
                            project: proj.id,
                          })
                        "
                      >
                        Modifier
                      </InertiaLink>
                    </DropdownMenuItem>
                    <DropdownMenuItem>
                      <InertiaLink
                        as="button"
                        method="delete"
                        class="w-full text-start"
                        :href="route('backoffice.project.destroy', { project: proj.id })"
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
      <LaravelPagination :paginatedResponse="projects"/>
    </CardFooter>
  </Card>
</template>
