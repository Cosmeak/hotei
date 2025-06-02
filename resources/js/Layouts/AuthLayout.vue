<template>
  <div class="bg-secondary-lighter relative min-h-screen">
    <div
      class="absolute top-2 right-7 bg-no-repeat z-0 opacity-10 pb-[2cm]"
      style="
        background-image: url('/cercle.png');
        background-size: cover;
        background-position: top right;
        width: 850px;
        height: 850px;
      "
    />

    <main>
      <slot />
    </main>
  </div>
</template>
