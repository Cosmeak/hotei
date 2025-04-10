<script lang="ts" setup>
import { Course } from "@/types";
import { useForm } from "laravel-precognition-vue-inertia";
import { Plus, Minus } from "lucide-vue-next";

const { course, craftmen, craftsmanships } = defineProps([
  "course",
  "craftmen",
  "craftsmanships",
]);

const form = useForm(
  course ? "put" : "post",
  course
    ? route("backoffice.course.update", { course: course.id })
    : route("backoffice.course.store"),
  {
    title: course?.title,
    description: course?.description,
    video: course?.video,
    craftsmanship: course?.craftsmanship.id,
    materials: course?.materials ?? [
      {
        name: "",
        quantity: "",
      },
    ],
    difficulty: course?.difficulty,
    is_draft: course?.is_draft ?? true,
    skills: course?.skills.map((skill: Course) => skill.id),

    // ADMIN ONLY
    craftman_id: course?.craftman_id,
    cost: course?.cost ?? 0,
  },
);

const submit = () =>
  form.submit({
    preserveScroll: true,
    onError: () => console.log(form.errors),
  });

const addMaterial = () => {
  form.materials.push({
    name: "",
    quantity: "",
  });
};

const removeMaterial = () => {
  if (form.materials.length <= 1) return;
  form.materials.pop();
};
</script>

<template>
  <form
    @submit.prevent="submit"
    class="container max-w-4xl flex flex-col gap-4"
  >
    <div v-if="isAdmin()" class="flex gap-4">
      <div class="w-full">
        <Label>Craftman</Label>
        <Select v-model="form.craftman_id">
          <SelectTrigger>
            <SelectValue placeholder="Select a craftman" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem
                v-for="craftman in craftmen"
                :key="craftman.id"
                :value="craftman.id"
              >
                {{ craftman.user.firstname }} {{ craftman.user.lastname }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>

      <div class="w-full">
        <Label>Token cost</Label>
        <Input v-model="form.cost" />
      </div>
    </div>

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
          <SelectTrigger>
            <SelectValue placeholder="Select a difficulty" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem :value="1"> Newbie </SelectItem>
              <SelectItem :value="2"> Amateur </SelectItem>
              <SelectItem :value="3"> Confirmed </SelectItem>
              <SelectItem :value="4"> Experimented </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>

      <div class="w-full">
        <Label>Category</Label>
        <Select v-model="form.craftsmanship">
          <SelectTrigger>
            <SelectValue placeholder="Select a category" />
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
      <Label>Video</Label>
      <Input type="file" @input="form.video = $event.target.files[0]" />
    </div>

    <div>
      <Label>Materials</Label>
      <div class="flex flex-col gap-2">
        <template v-for="(material, index) in form.materials" :key="index">
          <div class="flex gap-4">
            <Input
              v-model="form.materials[index].name"
              placeholder="material name"
            />
            <Input
              v-model="form.materials[index].quantity"
              type="number"
              min="1"
              placeholder="material quantity"
            />
          </div>
        </template>
        <div class="flex gap-4">
          <Button
            class="w-full"
            @click.prevent="removeMaterial"
            :disabled="form.materials.length <= 1"
          >
            <Minus />
          </Button>
          <Button class="w-full" @click.prevent="addMaterial">
            <Plus />
          </Button>
        </div>
      </div>
    </div>

    <Button type="submit" :disabled="form.processing">Submit</Button>
  </form>
</template>
