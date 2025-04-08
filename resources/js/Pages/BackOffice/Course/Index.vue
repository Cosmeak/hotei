<script setup lang="ts">
import { MoreHorizontal } from "lucide-vue-next";

const { courses } = defineProps(["courses"]);
</script>

<template>
  <div class="flex justify-end">
    <Button
      class="w-fit"
      :as="InertiaLink"
      :href="route('backoffice.course.create')"
      ><Plus /> New Course</Button
    >
  </div>
  <Card>
    <CardContent class="p-0">
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]">Title</TableHead>
            <TableHead>Category</TableHead>
            <TableHead>Token cost</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Created at</TableHead>
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
                <Badge :variant="course.is_draft ? 'secondary' : 'primary'">{{
                  course.is_draft ? "Draft" : "Published"
                }}</Badge>
              </TableCell>
              <TableCell>{{ course.created_at }}</TableCell>
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
                        >Edit</InertiaLink
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
                        >Delete</InertiaLink
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
                No course created... <br />
                Press the new course button to create one.
              </p>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
    <CardFooter v-if="course.last_page != 1" class="justify-center">
      <Pagination
        v-slot="{ page }"
        :total="courses.total"
        :sibling-count="2"
        show-edges
        :page="courses.current_page"
      >
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
          <PaginationFirst />
          <PaginationPrev />

          <template v-for="(item, index) in items">
            <PaginationListItem
              v-if="item.type === 'page'"
              :key="index"
              :value="item.value"
              as-child
            >
              <Button
                class="w-10 h-10 p-0"
                :variant="item.value === page ? 'default' : 'outline'"
              >
                {{ item.value }}
              </Button>
            </PaginationListItem>
            <PaginationEllipsis v-else :key="item.type" :index="index" />
          </template>

          <PaginationNext />
          <PaginationLast />
        </PaginationList>
      </Pagination>
    </CardFooter>
  </Card>
</template>
