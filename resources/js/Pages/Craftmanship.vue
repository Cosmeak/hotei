<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head } from "@inertiajs/vue3";
import CardCraftArticle from "@/Components/ui/card/CardCraftArticle.vue";
import CardCraftSkills from "@/Components/ui/card/CardCraftSkills.vue";
import CardCraftProject from "@/Components/ui/card/CardCraftProject.vue";
import CardCraftExperts from "@/Components/ui/card/CardCraftExperts.vue";
import { Craftsmanship } from "@/types";

const { craftsmanship } = defineProps<{
  craftsmanship: Craftsmanship;
}>();

const carrouselArticlesRef = ref<HTMLElement | null>(null);
const carrouselExpertsRef = ref<HTMLElement | null>(null);

const isMobile = ref(window.innerWidth < 768);

window.addEventListener('resize', () => {
  isMobile.value = window.innerWidth < 768;
});

const displayedCardsProjectItems = computed(() => {
  return isMobile.value ? cardsProjectItems.slice(0, 1) : cardsProjectItems.slice(2, 6);
});

const scrollLeftArticles = () => {
  if (carrouselArticlesRef.value) {
    carrouselArticlesRef.value.scrollBy({ left: -300, behavior: 'smooth' });
  }
};

const scrollRightArticles = () => {
  if (carrouselArticlesRef.value) {
    carrouselArticlesRef.value.scrollBy({ left: 300, behavior: 'smooth' });
  }
};

const scrollLeftExperts = () => {
  if (carrouselExpertsRef.value) {
    carrouselExpertsRef.value.scrollBy({ left: -300, behavior: 'smooth' });
  }
};

const scrollRightExperts = () => {
  if (carrouselExpertsRef.value) {
    carrouselExpertsRef.value.scrollBy({ left: 300, behavior: 'smooth' });
  }
};

const cardsArticleItems = [
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Blanket",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "8 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "10 min",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Tortue",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "4 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Flower",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "1 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h",
  },
];

const cardsSkillsItems = [
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    description: "Donne un bref aperçu...",
    difficulty: "Facile",
    duration: "10 min",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La maille en l'air",
    author: "Stéphane M.",
    description: "Autre bref aperçu...",
    difficulty: "Facile",
    duration: "10 min",
  },
];

const cardsProjectItems = [
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Tortue",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "4 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "10 min",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chapelle",
    author: "Stéphane M.",
    difficulty: "Difficile",
    duration: "12 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Flower",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "1 h",
  },
  {
    image:
      "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Blanket",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "8 h",
  },
];

const experts = [
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Stéphane M.",
    bio: "Fait du crochet depuis 7 ans",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Lucile D.",
    bio: "Amoureuse des granny squares",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis",
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis",
  },
];
</script>

<template>

  <Head :title="`${craftsmanship.name} | Craftsmanship`" />

  <!-- Page background -->
  <div class="min-h-screen w-full bg-[#F8F5F0] text-gray-800">
    <div class="h-6"></div>

    <div class="mx-4 md:mx-[120px] md:px-5">
      <!-- SECTION 1 : Hero arrondi, quarts de cercles -->
      <section
      class="hero-fixed-height relative mx-auto px-4 sm:px-6 py-6 md:py-10 mb-12 rounded-[20px] shadow-md overflow-hidden md:px-8"
      style="background-color: #a0c1a6">
        <svg class="absolute bottom-0 left-0" width="120" height="120" viewBox="0 0 120 120" fill="none"
          xmlns="http://www.w3.org/2000/svg" style="transform: rotate(90deg)">
          <!-- Couche 1 (vert foncé) -->
          <path d="M 10,120
      A 110,110 0 0,1 120,10
      L 120,120
      Z" fill="#0f4730" />
          <path d="M 20,120
      A 100,100 0 0,1 120,20
      L 120,120
      Z" fill="#427153" />
          <!-- Couche 3 (jaune) : plus épaisse -->
          <path d="M 40,120
      A 80,80 0 0,1 120,40
      L 120,120
      Z" fill="#F7DCB9" />
        </svg>

        <!-- Quart de cercle droit -->
        <svg class="absolute bottom-0 right-0" width="200" height="200" viewBox="0 0 200 200" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <!-- Couche 1 (vert foncé) -->
          <path d="M 0,200
    A 200,200 0 0,1 200,0
    L 200,200
    Z" fill="#0f4730" />
          <!-- Couche 2 (vert clair) -->
          <path d="M 50,200
    A 150,150 0 0,1 200,50
    L 200,200
    Z" fill="#427153" />
          <!-- Couche 3 (jaune) -->
          <path d="M 100,200
    A 100,100 0 0,1 200,100
    L 200,200
    Z" fill="#F7DCB9" />
        </svg>

        <!-- Contenu HERO -->
        <div class="relative z-10 flex flex-col md:flex-row items-start space-y-4 md:space-y-0">
          <!-- Titre / description à gauche -->
          <div class="md:w-2/3 md:pr-6 mb-2 md:mb-0 w-full">
            <h1 class="text-2xl font-bold mb-1" style="color: #104730">
              Le {{ craftsmanship.name }}
            </h1>
            <p class="text-sm md:text-base leading-tight" style="color: #104730">
              {{ craftsmanship.description }}
            </p>
          </div>

          <!-- Vidéo -->
          <div class="md:w-1/3 w-full flex justify-end">
            <div class="relative w-[600px] h-[200px] rounded-lg overflow-hidden shadow-lg bg-white video-fixed-size">
              <img src="https://thispersondoesnotexist.com/" alt="Crochet Hero" class="w-full h-full object-cover" />
              <button
                class="absolute inset-0 m-auto bg-[#104730] text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-[#417154]">
                ▶
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 2 : Derniers cours et projets -->
      <section class="mx-auto px-6 md:px-8 mb-12">
        <h2 class="text-2xl font-bold mb-6" style="color: #104730">
          Tes derniers cours et projet
        </h2>

        <!-- Conteneur qui aligne les 6 cartes horizontalement -->
        <div ref="carrouselArticlesRef" class="flex space-x-4 overflow-x-auto hide-scrollbar pb-2">
          <CardCraftArticle v-for="(cardarticleitem, index) in cardsArticleItems" :key="index"
            :image="cardarticleitem.image" :title="cardarticleitem.title" :author="cardarticleitem.author"
            :difficulty="cardarticleitem.difficulty" :duration="cardarticleitem.duration" />
        </div>

        <!-- Les flèches sous les cartes, côté droit -->
        <div class="flex justify-center mt-2 space-x-2">
          <button
            @click="scrollLeftArticles"
            class="w-9 h-9 flex items-center justify-center border border-black rounded-full text-black bg-white hover:bg-black hover:text-white transition-colors duration-200">
            ←
          </button>
          <button
            @click="scrollRightArticles"
            class="w-9 h-9 flex items-center justify-center border border-black rounded-full text-black bg-white hover:bg-black hover:text-white transition-colors duration-200">
            →
          </button>
        </div>
      </section>

      <!-- BLOC : Découvrez le crochet -->
      <section class="my-discover relative mx-auto mb-12 w-full max-w-7xl px-4">
        <div class="w-full h-full bg-[#F3E5DC] rounded-lg shadow-md relative p-6 flex flex-col md:flex-row md:items-center gap-6">

            <div class="w-full md:w-1/2 bg-[#417154] text-white p-6 rounded-lg shadow-lg md:relative md:-left-[10%]">
                <h3 class="text-lg font-bold mb-2">Découvrez Le crochet&nbsp;!</h3>
                <p class="text-sm leading-relaxed">
                    <strong>Avec nos cours introductifs offerts.</strong><br />
                    Découvrez les bases pour créer facilement.<br />
                    Lorem ipsum dolor sit amet...
                </p>
            </div>

            <div class="relative flex flex-col md:flex-row md:flex-wrap items-start gap-4 w-full md:w-1/2 max-w-full overflow-hidden md:overflow-visible">
                <CardCraftSkills 
                    v-for="(card, index) in cardsSkillsItems" 
                    :key="index" 
                    :image="card.image"
                    :title="card.title" 
                    :author="card.author" 
                    :description="card.description" 
                    :difficulty="card.difficulty"
                    :duration="card.duration"
                    class="w-full md:w-[48%] lg:w-[32%] max-w-full md:max-w-none" 
                />
            </div>
        </div>
    </section>

    <h3 class="text-2xl font-bold mb-4 text-[#104730] text-center sm:text-left">
        Nos compétences et projets
      </h3>

      <section class="mb-10 w-full max-w-8xl mx-auto">
  <div class="flex flex-col gap-5 items-center">
  <!-- Ligne filtres + 2 cartes -->
  <div class="flex flex-wrap sm:justify-center md:justify-center w-full gap-5">

    <!-- BLOC VERT DE FILTRES -->
    <div 
      class="
        relative
        bg-[#A0C1A6] p-3 pb-6 sm:pb-3 shadow-sm rounded-lg
        overflow-hidden w-full sm:w-[49%] 
        md:flex-grow  
      "
    >
      <div class="mb-2">
        <input
          type="text"
          placeholder="Chercher"
          class="w-full px-3 py-2 border rounded-md
                focus:ring-2 focus:ring-[#104730] focus:outline-none text-sm"
        />
      </div>
      <div class="flex items-center flex-wrap mb-2">
        <button class="px-3 py-1 text-sm rounded border bg-[#F7DCB9] text-[#104730] font-semibold">
          Tout
        </button>
        <button class="px-3 py-1 text-sm rounded border bg-white text-gray-700 hover:bg-gray-50">
          Projet
        </button>
        <button class="px-2 py-1 text-sm rounded border bg-white text-gray-700 hover:bg-gray-50">
          Compétence
        </button>
        <select
          class="ml-auto border rounded-md px-2 py-1 text-gray-700 text-sm focus:outline-none"
          style="min-width: 80px"
        >
          <option>Facile</option>
          <option>Moyen</option>
          <option>Difficile</option>
        </select>
      </div>
      <div class="flex items-center gap-2 mb-2">
        <div
          class="flex items-center px-2 py-1 bg-white text-[#104730] text-xs font-bold border rounded-md"
          style="min-width: 55px; justify-content: center"
        >
          50 CT
        </div>
        <input
          type="range"
          min="0"
          max="240"
          value="50"
          class="slider-yellow flex-grow"
        />
        <div
          class="flex items-center px-2 py-1 bg-white text-[#104730] text-xs font-bold border rounded"
          style="min-width: 62px; justify-content: center"
        >
          240 CT
        </div>
      </div>
      <!-- "10 résultats" en bas à droite -->
      <p
        class="absolute bottom-2 right-3 text-sm font-medium text-black text-center"
        style="line-height: 1.2"
      >
        10 résultats
      </p>
    </div>
    <!-- /BLOC VERT -->

    <!-- 2 CARTES -->
    <div
      class="
        flex flex-wrap gap-5 justify-center
        w-full sm:w-[49%]  
        md:flex-grow  
        [&:only-child]:w-full /* Une seule carte prend toute la largeur */
        [&:only-child]:max-w-[95vw] /* Elle reste contenue dans l’écran */
        [&:only-child]:px-4 /* Ajoute du padding latéral */
      "
    >
      <div
        class="
          flex-none w-full sm:w-[280px] 
          max-w-[280px] mx-auto /* Évite l’élargissement et centre les cartes */
        "
        v-for="(card, index) in cardsProjectItems.slice(0, 2)"
        :key="index"
      >
        <CardCraftProject
          :image="card.image"
          :title="card.title"
          :author="card.author"
          :difficulty="card.difficulty"
          :duration="card.duration"
        />
      </div>
    </div>
    <!-- /2 CARTES -->

  </div>
  <!-- /LIGNE FILTRES + 2 CARTES -->


  <!-- LIGNE AVEC 4 CARTES -->
  <div
    class="
      mt-5 flex flex-wrap gap-6 w-full min-h-[1px] 
      justify-center                 
      sm:justify-center              
      md:justify-center              
      lg:justify-center 
      max-w-[95vw] mx-auto /* Empêche les cartes de toucher les bords */
      overflow-x-auto /* Ajoute une scrollbar si nécessaire */
      px-4 sm:px-6 md:px-8 lg:px-12 /* Ajoute de l’espace latéral */
    "
  >
    <div
      class="
        flex-none 
        w-[280px] max-w-[280px] /* Bloque la largeur des cartes */
        mx-auto 
      "
      v-for="(card, index) in displayedCardsProjectItems"
      :key="index"
    >
      <CardCraftProject
        :image="card.image"
        :title="card.title"
        :author="card.author"
        :difficulty="card.difficulty"
        :duration="card.duration"
      />
    </div>
  </div>
  <!-- /LIGNE AVEC 4 CARTES -->


      <div class="text-center mt-5 w-full">
        <button
          class="bg-[#E8B83A] text-[#104730] font-semibold py-1 px-4 rounded
                hover:bg-[#e7aa2d] text-sm"
        >
          Voir plus
        </button>
      </div>
      
    </div>
  </section>

      <!-- SECTION finale : Nos artisans experts pour apprendre -->
      <section class="my-artisans flex flex-col relative w-full gap-7 bg-[#F8F5F0] py-6">
        <h3 class="text-2xl font-bold text-center text-[#104730]">
          Nos artisans experts pour apprendre le {{ craftsmanship.name }}
        </h3>

        <!-- Conteneur principal -->
        <div class="artisans-container flex flex-col gap-y-5 relative w-full pb-6 items-start"
          style="overflow: visible">
          <div class="flex flex-col items-center gap-y-8 w-full">
            <div class="carrousel-left w-full h-[220px] overflow-hidden">
              <div ref="carrouselExpertsRef" class="flex items-center space-x-4 overflow-x-auto h-full hide-scrollbar">
                <CardCraftExperts v-for="(expert, index) in experts" :key="index" :image="expert.image"
                  :name="expert.name" :bio="expert.bio" />
              </div>
            </div>

            <!-- Flèches de navigation -->
            <div class="md:right-[410px] flex space-x-3 justify-center md:justify-end w-full md:w-auto mt-4 md:mt-0">
              <button
                @click="scrollLeftExperts"
                class="w-9 h-9 flex items-center justify-center border border-black rounded-full text-black bg-white hover:bg-black hover:text-white transition-colors duration-200">
                ←
              </button>
              <button
                @click="scrollRightExperts"
                class="w-9 h-9 flex items-center justify-center border border-black rounded-full text-black bg-white hover:bg-black hover:text-white transition-colors duration-200">
                →
              </button>
            </div>

          </div>
        </div>
      </section>
    </div>
    <div class="help-block w-full bg-[#DCEDE2] py-5 px-5 flex flex-col items-center justify-center">
      <h4 class="text-lg font-bold mb-3 text-[#104730]">Besoin d’aide ?</h4>
      <p class="text-sm text-[#104730] leading-relaxed mb-4">
        Vous pouvez prendre rendez-vous...
      </p>
      <button class="bg-[#E8B83A] text-[#104730] font-semibold py-2 px-4 rounded-full hover:bg-[#e7aa2d] text-sm">
        Prendre rendez-vous avec un artisan
      </button>
    </div>
  </div>
</template>

<style scoped>
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}

.hide-scrollbar {
  -ms-overflow-style: none;
  /* IE and Edge */
  scrollbar-width: none;
  /* Firefox */
}

input[type="range"].slider-yellow {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 6px;
  background: #eee;
  border-radius: 3px;
  outline: none;
  cursor: pointer;
  border: none;
  accent-color: #e8b83a;
}

input.slider-yellow::-webkit-slider-runnable-track {
  height: 6px;
  background-color: #eee;
  border-radius: 3px;
}

input.slider-yellow::-webkit-slider-thumb {
  -webkit-appearance: none;
  height: 14px;
  width: 14px;
  background-color: #e8b83a;
  border: 2px solid #104730;
  border-radius: 50%;
  margin-top: -5px;
  cursor: pointer;

}
</style>
