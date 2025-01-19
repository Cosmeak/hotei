<script lang="ts" setup>
import type { HTMLAttributes } from "vue";
import { withDefaults, ref } from "vue";
import { cn } from "@/lib/utils.ts";

const props = withDefaults(
  defineProps<{
    id: string;
    defaultValue?: [];
    modelValue?: [];
    multiple?: boolean;
    accept?: string;
    class?: HTMLAttributes["class"];
  }>(),
  {
    id: "file-input",
    multiple: false,
  },
);

const emits = defineEmits<{
  (event: "update:modelValue", payload: File[]): void;
}>();

let isDragging = ref(false);
let files = ref([]);

const onDragOver = (): void => {
  isDragging.value = true;
};

const onDragLeave = (): void => {
  isDragging.value = false;
};

const onDrop = (event: DragEvent): void => {
  onChange(event);
  isDragging.value = false;
};

const onChange = (event: DragEvent | Event): void => {
  if (!props.multiple) files.value = [];
  if (event instanceof DragEvent) {
    if (!props.multiple) files.value[0] = event.dataTransfer.files[0];
    else files.value = event.dataTransfer.files;
  } else if (event instanceof Event) {
    if (!props.multiple) files.value[0] = event.target.files[0];
    else files.value = event.target.files;
  }
  emits("update:modelValue", files.value);
};

const removeFile = (index: number): void => {
  files.value.splice(index, 1);
};

const generatePreview = (file: File): string => {
  const src = URL.createObjectURL(file);
  setTimeout(() => {
    URL.revokeObjectURL(src);
  }, 1000);
  return src;
};
</script>

<template>
  <div
    @dragover.prevent="onDragOver"
    @dragleave.prevent="onDragLeave"
    @drop.prevent="onDrop"
    :class="[
      cn('p-8 border border-dashed rounded shadow-sm', props.class),
      isDragging ? 'border-green-500' : '',
    ]"
  >
    <input
      :id="id"
      type="file"
      @change="onChange"
      :multiple="props.multiple"
      :accept="props.accept"
      class="opacity-0 overflow-hidden absolute w-[1px] h-[1px]"
    />

    <label :for="id" class="text-lg cursor-pointer">
      <p v-if="isDragging">Release to drop files here.</p>
      <p v-else>Drop files here or <u>click here</u> to upload</p>
    </label>
  </div>

  <div class="mt-4 flex flex-col gap-4">
    <div
      v-for="(file, index) in files"
      :key="index"
      class="flex gap-2 border p-4 h-48 rounded"
    >
      <Button
        size="sm"
        variant="destructive"
        @click.prevent="removeFile(index)"
      >
        <b>×</b>
      </Button>
      <div class="w-full h-full flex gap-2 flex-col">
        <img
          class="w-full h-full object-contain"
          :src="generatePreview(file)"
          alt=""
        />
        <p>{{ file.name }}</p>
      </div>
    </div>
  </div>
</template>
