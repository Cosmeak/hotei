<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import CardCraftArticle from "@/Components/ui/card/CardCraftArticle.vue";
import CardCraftSkills from "@/Components/ui/card/CardCraftSkills.vue";
import CardCraftProject from "@/Components/ui/card/CardCraftProject.vue";
import CardCraftExperts from "@/Components/ui/card/CardCraftExperts.vue";

defineProps<{
  craft: {
    slug: string;
    name: string;
    description: string;
    courses?: {
      id: number;
      title: string;
      image: string;
      instructor: string;
      difficulty?: string;
      duration?: string;
      isFree?: boolean;
    }[];
    skills?: {
      id: number;
      title: string;
      description: string;
      image?: string;
    }[];
    artisans?: {
      id: number;
      name: string;
      image: string;
      bio: string;
    }[];
  };
}>();

const cardsArticleItems= [
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Blanket",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "8 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "10 min"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Tortue",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "4 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Flower",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "1 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h"
  }
];

const cardsSkillsItems = [
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    description: "Donne un bref aperçu...",
    difficulty: "Facile",
    duration: "10 min"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La maille en l'air",
    author: "Stéphane M.",
    description: "Autre bref aperçu...",
    difficulty: "Facile",
    duration: "10 min"
  }
];


const cardsProjectItems = [
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Tortue",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "4 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chaînette",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "10 min"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "La chapelle",
    author: "Stéphane M.",
    difficulty: "Difficile",
    duration: "12 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Bag",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "6 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Flower",
    author: "Stéphane M.",
    difficulty: "Facile",
    duration: "1 h"
  },
  {
    image: "https://3petitesmailles.files.wordpress.com/2018/06/crochet-turtle-diy-blog2.jpg?w=616",
    title: "Crochet Blanket",
    author: "Stéphane M.",
    difficulty: "Moyen",
    duration: "8 h"
  }
];

const experts = [
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Stéphane M.",
    bio: "Fait du crochet depuis 7 ans"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Lucile D.",
    bio: "Amoureuse des granny squares"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis"
  },
  {
    image: "https://thispersondoesnotexist.com/",
    name: "Marion L.",
    bio: "Spécialiste amigurumis"
  }
];
</script>

<template>

  <Head :title="`${craft.name} | Craftsmanship`" />

  <!-- Page background -->
  <div class="min-h-screen w-full bg-[#F8F5F0] text-gray-800 ">

    <div class="h-6"></div>

    <div class="mx-[120px] md:px-5">

      <!-- SECTION 1 : Hero arrondi, quarts de cercles -->
      <section class="hero-fixed-height relative  mx-auto px-6 py-10 mb-12 rounded-[20px]
      shadow-md overflow-hidden md:px-8" style="background-color: #A0C1A6;">
        <svg class="absolute bottom-0 left-0" width="120" height="120" viewBox="0 0 120 120" fill="none"
          xmlns="http://www.w3.org/2000/svg" style="transform: rotate(90deg);">
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
          <div class="md:w-2/3 md:pr-6 mb-4 md:mb-0 w-full">
            <h1 class="text-2xl font-bold mb-1" style="color: #104730;">
              Le {{ craft.name }}
            </h1>
            <p class="text-sm md:text-base leading-tight" style="color: #104730;">
              {{ craft.description }}
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
      <section class=" mx-auto px-6 md:px-8 mb-12">
        <h2 class="text-2xl font-bold mb-6" style="color: #104730;">
          Tes derniers cours et projet
        </h2>

        <!-- Conteneur qui aligne les 6 cartes horizontalement -->
        <div class="flex space-x-4 overflow-x-auto hide-scrollbar pb-2">
          <CardCraftArticle
          v-for="(cardarticleitem, index) in cardsArticleItems"
          :key="index"
          :image="cardarticleitem.image"
          :title="cardarticleitem.title"
          :author="cardarticleitem.author"
          :difficulty="cardarticleitem.difficulty"
          :duration="cardarticleitem.duration"
        />
        </div>

        <!-- Les flèches sous les cartes, côté droit -->
        <div class="flex md:justify-end justify-center mt-2 space-x-2">
          <button class="w-9 h-9 flex items-center justify-center
          border border-black rounded-full text-black bg-white
        hover:bg-black hover:text-white transition-colors duration-200">
            ←
          </button>
          <button class="w-9 h-9 flex items-center justify-center
          border border-black rounded-full text-black bg-white
        hover:bg-black hover:text-white transition-colors duration-200">
            →
          </button>
        </div>
      </section>

      <!-- BLOC : Découvrez le crochet (par exemple) -->
      <section class="my-discover relative  ml-auto mb-12 md:h-[360px]" style="height: 360px;">
        <!-- Fond #F3E5DC, largeur max 6xl -->
        <div class="w-full h-full max-w-6xl bg-[#F3E5DC]
        rounded-lg shadow-md relative">
          <!-- Arc en haut à droite -->
          <svg class="absolute top-0 right-0" width="200" height="200" viewBox="0 0 300 300" fill="none"
            xmlns="http://www.w3.org/2000/svg" style="transform: rotate(-90deg);">
            <path d="M 300,0 A 300,300 0 0,0 0,300 L 300,300 Z" fill="#0f4730" />
            <path d="M 300,50 A 250,250 0 0,0 50,300 L 300,300 Z" fill="#427153" />
            <path d="M 300,100 A 200,200 0 0,0 100,300 L 300,300 Z" fill="#F8F5F0" />
            <path d="M 300,150 A 150,150 0 0,0 150,300 L 300,300 Z" fill="#F7DCB9" />
          </svg>

          <!-- Bloc vert à gauche, centré verticalement -->
          <div class="left-block-fixed-width absolute left-0 top-1/2 transform -translate-y-1/2 
          bg-[#417154] text-white p-4 rounded-lg shadow-lg" style="width: 400px; margin-left: -100px;">
            <h3 class="text-lg font-bold mb-2">
              Découvrez Le crochet&nbsp;!
            </h3>
            <p class="text-sm leading-relaxed">
              <strong>Avec nos cours introductifs offerts.</strong><br>
              Découvrez les bases pour créer facilement.<br>
              Lorem ipsum dolor sit amet...
            </p>
          </div>

          <!-- Conteneur des cartes -->
          <div class="relative flex flex-col items-start space-y-2 mt-9 px-4">
            <CardCraftSkills
              v-for="(card, index) in cardsSkillsItems"
              :key="index"
              :image="card.image"
              :title="card.title"
              :author="card.author"
              :description="card.description"
              :difficulty="card.difficulty"
              :duration="card.duration"
            />
          </div><!-- fin des cartes -->
        </div><!-- fin fond beige -->
      </section>

      <!-- SECTION : Nos compétences et projets -->
      <section class="mb-10">
        <h3 class="text-2xl font-bold mb-4" style="color: #104730;">
          Nos compétences et projets
        </h3>

        <div class="w-full flex flex-col gap-5 justify-center items-center">
          <!-- Ligne 1 : Filtres (½) + 2 cartes (½) -->
          <div class="flex w-full justify-center item-center gap-x-5">
            <!-- Bloc vert (filtres) -->
            <div class="relative bg-[#A0C1A6] rounded-lg p-3 shadow-sm
      w-full md:w-full max-w-sm mx-auto md:mx-0
      overflow-hidden" style="max-width: 400px;">
              <!-- Barre de recherche -->
              <div class="mb-2">
                <input type="text" placeholder="Chercher" class="w-full px-3 py-2 border rounded-md
        focus:ring-2 focus:ring-[#104730]
        focus:outline-none text-sm" />
              </div>

              <!-- Boutons + Select -->
              <div class="flex items-center flex-wrap mb-2">
                <button class="px-3 py-1 text-sm rounded border
              bg-[#F7DCB9] text-[#104730] font-semibold">
                  Tout
                </button>
                <button class="px-3 py-1 text-sm rounded border
              bg-white text-gray-700 hover:bg-gray-50">
                  Projet
                </button>
                <button class="px-2 py-1 text-sm rounded border
              bg-white text-gray-700 hover:bg-gray-50">
                  Compétence
                </button>

                <!-- Select à droite -->
                <select class="ml-auto border rounded-md px-2 py-1
                text-gray-700 text-sm focus:outline-none" style="min-width: 80px;">
                  <option>Facile</option>
                  <option>Moyen</option>
                  <option>Difficile</option>
                </select>
              </div>

              <!-- Range + "50 CT" / "240 CT" encadrés -->
              <div class="flex items-center justify-between gap-2 mb-2">
                <!-- 50 CT encadré -->
                <div class="flex items-center px-2 py-1 bg-white text-[#104730]
                text-sm font-bold border rounded" style="min-width: 50px; justify-content: center;">
                  50 CT
                </div>

                <div class="flex items-center gap-1 flex-grow">
                  <input type="range" min="0" max="240" value="50" class="slider-yellow" />
                </div>

                <!-- 240 CT encadré -->
                <div class="flex items-center px-2 py-1 bg-white text-[#104730]
                text-sm font-bold border rounded" style="min-width: 50px; justify-content: center;">
                  240 CT
                </div>
              </div>

              <!-- "10 résultats" en bas à droite -->
              <p class="absolute bottom-2 right-3 text-sm font-medium text-black" style="line-height: 1.2;">
                10 résultats
              </p>
            </div>

            <div class="w-full flex flex-col md:flex-row gap-2">
              <CardCraftProject
                v-for="(card, index) in cardsProjectItems.slice(0, 2)"
                :key="index"
                :image="card.image"
                :title="card.title"
                :author="card.author"
                :difficulty="card.difficulty"
                :duration="card.duration"
              />
            </div>
          </div>
          <!-- Fin ligne 1 -->

          <!-- Ligne 2 : 4 cartes, contour vert foncé -->
          <div class="flex w-full justify-center item-center gap-x-5">
            <CardCraftProject
              v-for="(card, index) in cardsProjectItems.slice(2, 6)"
              :key="index"
              :image="card.image"
              :title="card.title"
              :author="card.author"
              :difficulty="card.difficulty"
              :duration="card.duration"
            />
          </div>
          <!-- Fin ligne 2 : 4 cartes -->
        </div>

        <div class="text-center mt-3">
          <button class="bg-[#E8B83A] text-[#104730] font-semibold
  py-1 px-4 rounded hover:bg-[#e7aa2d] text-sm">
            Voir plus
          </button>
        </div>
      </section>

      <!-- SECTION finale : Nos artisans experts pour apprendre -->
      <section class="my-artisans flex flex-col relative w-full gap-7 bg-[#F8F5F0] py-6">
        <!-- Titre -->
        <h3 class="text-2xl font-bold text-center text-[#104730]">
          Nos artisans experts pour apprendre le {{ craft.name }}
        </h3>

        <!-- Conteneur principal -->
        <div class="artisans-container flex flex-col gap-y-5 relative w-full pb-6 items-start" style=" overflow: visible;">
          <div class="flex flex-col items-center gap-y-8 w-full">

            <!-- Carrousel -->
          <!-- Container principal du carrousel -->
          <div class="carrousel-left w-full h-[220px] overflow-hidden ">
            
            <!-- Conteneur des cartes en flex horizontal et scrollable -->
            <div class="flex items-center space-x-4 overflow-x-auto h-full hide-scrollbar">
            <CardCraftExperts
              v-for="(expert, index) in experts"
              :key="index"
              :image="expert.image"
              :name="expert.name"
              :bio="expert.bio"
            />
            </div>
        </div>


            <!-- Flèches de navigation -->
            <div class=" md:right-[410px]
              flex space-x-3 justify-center md:justify-end w-full md:w-auto mt-4 md:mt-0">
            <!-- Fond transparent ou semi-transparent -->
            <button class="w-9 h-9 flex items-center justify-center
              border border-black rounded-full text-black bg-white
              hover:bg-black hover:text-white transition-colors
              duration-200">
                ←
            </button>
            <button class="w-9 h-9 flex items-center justify-center
              border border-black rounded-full text-black bg-white
              hover:bg-black hover:text-white transition-colors
              duration-200">
                →
            </button>
          </div>
        </div>

        </div>
      </section>

    </div>
    <div class="help-block w-full bg-[#DCEDE2] py-5 px-5 
                flex flex-col items-center justify-center">
      <h4 class="text-lg font-bold mb-3 text-[#104730]">
        Besoin d’aide ?
      </h4>
      <p class="text-sm text-[#104730] leading-relaxed mb-4">
        Vous pouvez prendre rendez-vous...
      </p>
      <button class="bg-[#E8B83A] text-[#104730] font-semibold
                  py-2 px-4 rounded-full hover:bg-[#e7aa2d] text-sm">
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
  accent-color: #E8B83A;
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
  background-color: #E8B83A;
  border: 2px solid #104730;
  border-radius: 50%;
  margin-top: -5px;
  cursor: pointer;
}

/* RESPONSIVE OVERRIDES */
@media (max-width: 768px) {

  /* SECTION 1: plus de marge latérale sur mobile */
  .hero-fixed-height {
    height: auto !important;
    margin-left: 1rem !important;
    margin-right: 1rem !important;
  }

  .video-fixed-size {
    width: 100% !important;
    height: 200px !important;
    /* ou auto, selon préférence */
  }

  /* SECTION "Découvrez le ...": */
  .my-discover {
    height: auto !important;
    margin-left: 1rem !important;
    margin-right: 1rem !important;
    margin-bottom: 2rem !important;
  }

  .my-discover svg.absolute.top-0.right-0 {
    display: none !important;
  }

  .left-block-fixed-width {
    position: static !important;
    transform: none !important;
    margin-left: 0 !important;
    width: auto !important;
    margin-bottom: 1rem !important;
  }

  .card-fixed-width {
    width: 100% !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
  }

  /* SECTION artisans */
  .artisans-container {
    height: auto !important;
  }

  .carrousel-left {
    position: static !important;
    width: 100% !important;
    margin-bottom: 1rem;
    height: auto !important;
  }

  .carrousel-left .min-w-\[300px\] {
    min-width: 280px !important;
  }

  .carrousel-left .h-full {
    height: auto !important;
  }

  .my-artisans .absolute.-bottom-2.md\:right-\[410px\] {
    position: static !important;
    inset: auto !important;
    margin-top: 1rem !important;
    justify-content: center !important;
  }

  p.absolute.bottom-2 {
    bottom: -1px;
    margin-bottom: 3px;

  }

  .custom-width-md {
    width: 200px;
  }
}
</style>
