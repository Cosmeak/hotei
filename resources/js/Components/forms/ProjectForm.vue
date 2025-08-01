<script lang="ts" setup>
import { useForm } from "laravel-precognition-vue-inertia";
import { Label } from "@/Components/ui/label";
import { Checkbox } from "@/Components/ui/checkbox";
import { Select, SelectItem, SelectGroup, SelectValue, SelectTrigger, SelectContent } from "@/Components/ui/select";
import { Input } from "@/Components/ui/input";
import { Textarea } from "@/Components/ui/textarea";
import { Button } from "@/Components/ui/button";

const { project, craftmen, craftsmanships } = defineProps([
  "project",
  "craftmen",
  "craftsmanships",
  "courses",
]);

const form = useForm(
  project ? "put" : "post",
  project
    ? route("backoffice.project.update", { project: project.id })
    : route("backoffice.project.store"),
  {
    title: project?.title,
    description: project?.description,
    craftsmanship_id: project?.craftsmanship_id,
    difficulty: project?.difficulty,
    courses: project?.courses?.map((course: any) => course.id) ?? [],

    // ADMIN ONLY
    craftman_id: project?.craftman_id,
    cost: project?.cost ?? 0,
  }
);

const submit = () =>
  form.submit({
    preserveScroll: true,
  });
</script>

<template>
  <form @submit.prevent="submit" class="flex flex-col gap-4">

    <!-- ADMIN FIELDS -->
    <div v-if="isAdmin()" class="flex gap-4">
      <div class="w-full">
        <Label>Craftman</Label>
        <Select v-model="form.craftman_id">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select a craftman" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem
                v-for="craftman in craftmen"
                :key="craftman.id"
                :value="craftman.id"
              >
                {{ craftman.user.fullname }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>

      <div class="w-full">
        <Label>Cost</Label>
        <Input type="number" v-model="form.cost" min="0" />
      </div>
    </div>

    <!-- GENERAL FIELDS -->
    <div>
      <Label>Title</Label>
      <Input v-model="form.title" />
    </div>

    <div>
      <Label>Description</Label>
      <Textarea v-model="form.description" />
    </div>

    <div class="flex gap-4">
      <div class="w-full">
        <Label>Difficulty</Label>
        <Select v-model="form.difficulty">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select difficulty" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem :value="1">Newbie</SelectItem>
              <SelectItem :value="2">Amateur</SelectItem>
              <SelectItem :value="3">Confirmed</SelectItem>
              <SelectItem :value="4">Experimented</SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>

      <div class="w-full">
        <Label>Category</Label>
        <Select v-model="form.craftsmanship_id">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select category" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem
                v-for="craftsmanship in craftsmanships"
                :key="craftsmanship.id"
                :value="craftsmanship.id"
              >
                {{ craftsmanship.name }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>
      <div>
        <Label>Associated Courses</Label>
        <Select v-model="form.courses" multiple>
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select one or more courses" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem
                v-for="course in courses"
                :key="course.id"
                :value="course.id"
              >
                {{ course.title }}
                <template v-if="isAdmin() && course.craftman">
                  ({{ course.craftman.user.fullname }})
                </template>
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>
    </div>
    <Button type="submit" :disabled="form.processing">Submit</Button>
  </form>
</template>
