<script lang="ts" setup>
import { useForm } from "laravel-precognition-vue-inertia";
import { Label } from "@/Components/ui/label";
import { Select, SelectItem, SelectGroup, SelectValue, SelectTrigger, SelectContent } from "@/Components/ui/select";
import { Input } from "@/Components/ui/input";
import { Textarea } from "@/Components/ui/textarea";
import { Button } from "@/Components/ui/button";
import {Card, CardContent, CardHeader} from "@/Components/ui/card";
import CourseForm from "@/Components/forms/CourseForm.vue";
import {Minus, Plus} from "lucide-vue-next";

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
    courses: project?.courses ?? [
      {
        title: project?.course.title,
        description: project?.course.description,
        craftsmanships_id: project?.craftsmanship_id.id
      }
    ],

    // ADMIN ONLY
    craftman_id: project?.craftman_id,
    cost: project?.cost ?? 0,
  }
);

const submit = () =>
  form.submit({
    preserveScroll: true,
  });

const addCourse = () => {
  form.courses.push({
    title: project?.course.title,
    description: project?.course.description,
    craftsmanships_id: project?.craftsmanship_id.id
  })
};

const removeCourse = () => {
  if (form.courses.length <= 1) return;
  form.courses.pop();
}
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
        <Label>Total Cost</Label>
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
        <Label>Craftsmanship</Label>
        <Select v-model="form.craftsmanship_id">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select a craftmanship" />
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

    </div>
      <div>
        <Label>Course</Label>
        <div>
          <div class="flex flex-row gap-2 mb-1">
            <Button
              class="flex-1/2"
              @click.prevent="removeCourse"
              :disabled="form.courses.length <= 1"
            >
              <Minus />
            </Button>
            <Button class="flex-1/2" @click.prevent="addCourse">
              <Plus />
            </Button>
          </div>
          <template v-for="(course, index) in form.courses" :key="index">
            <Card class="container max-w-4xl bg-white">
              <CardHeader>
                Create a Course
              </CardHeader>
              <CardContent>
                <CourseForm :craftmen="craftmen" :craftsmanships="craftsmanships"/>
              </CardContent>
            </Card>
          </template>
        </div>
      </div>
    <Button type="submit" :disabled="form.processing">Submit</Button>
  </form>
</template>
