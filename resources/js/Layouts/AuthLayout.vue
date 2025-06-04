<template>
  <img src="logo.svg" class="h-28 absolute -top-1O left-0 z-10" alt="">
  <div class="bg-secondary-lighter relative min-h-screen flex items-center justify-center">
    <img src="assets/auth/decor.svg" class="absolute  right-0 bottom-0 top-O" alt="">

    <main class="bg-background p-12 rounded-xl z-10">
      <slot />
    </main>
  </div>
</template>
