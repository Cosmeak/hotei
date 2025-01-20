<template>
    <Head :title="`${craft.name} | Craftsmanship`" />
  
    <!-- Page background -->
<div class="min-h-screen w-full bg-[#F8F5F0] text-gray-800">

      <div class="h-6"></div>

      <!-- SECTION 1 : Hero arrondi, quarts de cercles -->
      <section
        class="relative max-w-7xl mx-auto px-6 py-10 mb-12 rounded-[20px]
               shadow-md overflow-hidden"
        style="background-color: #A0C1A6;"
      >
    <svg
        class="absolute bottom-0 left-0"
        width="120"
        height="120"
        viewBox="0 0 120 120"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        style="transform: rotate(90deg);"
        >
        <!-- Couche 1 (vert foncé) -->
        <path
            d="M 10,120
            A 110,110 0 0,1 120,10
            L 120,120
            Z"
            fill="#0f4730"
        />
        <path
            d="M 20,120
            A 100,100 0 0,1 120,20
            L 120,120
            Z"
            fill="#427153"
        />
        <!-- Couche 3 (jaune) : plus épaisse -->
        <path
            d="M 40,120
            A 80,80 0 0,1 120,40
            L 120,120
            Z"
            fill="#F7DCB9"
        />
    </svg>
  
        <!-- Quart de cercle droit -->
    <svg
            class="absolute bottom-0 right-0"
            width="200"
            height="200"
            viewBox="0 0 200 200"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
        <!-- Couche 1 (vert foncé) -->
        <path
        d="M 0,200
            A 200,200 0 0,1 200,0
            L 200,200
            Z"
        fill="#0f4730"
        />
        <!-- Couche 2 (vert clair) -->
        <path
        d="M 50,200
            A 150,150 0 0,1 200,50
            L 200,200
            Z"
        fill="#427153"
        />
        <!-- Couche 3 (jaune) -->
        <path
        d="M 100,200
            A 100,100 0 0,1 200,100
            L 200,200
            Z"
        fill="#F7DCB9"
        />
        </svg>
        <!-- Contenu HERO -->
            <div class="relative z-10 flex flex-col md:flex-row items-start">
            <!-- Titre / description à gauche -->
            <div class="md:w-2/3 md:pr-6 mb-4 md:mb-0">
                <h1 class="text-2xl font-bold mb-1" style="color: #104730;">
                Le {{ craft.name }}
                </h1>
                <p class="text-sm md:text-base leading-tight" style="color: #104730;">
                {{ craft.description }}
                </p>
            </div>

        <!-- Vidéo -->
        <div class="md:w-1/3 flex justify-end">
            <div class="relative w-[600px] h-[200px] rounded-lg overflow-hidden shadow-lg bg-white">
            <img src="/images/crochet_hero.jpg"alt="Crochet Hero" class="w-full h-full object-cover"/>
                <button class="absolute inset-0 m-auto bg-[#104730] text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-[#417154]">▶</button>
            </div>
        </div>
    </div>
</section>

    <!-- SECTION 2 : Derniers cours et projets -->
    <section class="max-w-7xl mx-auto px-6 md:px-8 mb-12">
    <h2 class="text-2xl font-bold mb-6" style="color: #104730;">
        Tes derniers cours et projet
    </h2>

    <!-- Conteneur qui aligne les 5 cartes horizontalement -->
    <div class="flex space-x-4 overflow-x-auto hide-scrollbar pb-2">
        <!-- Card 1 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/crochetblanket.jpg"
            alt="Crochet Blanket"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">Crochet Blanket</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Moyen</span>
            <span>8 h</span>
        </div>
        </div>

        <!-- Card 2 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/chainette.jpg"
            alt="La chaînette"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">La chaînette</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Facile</span>
            <span>10 min</span>
        </div>
        </div>

        <!-- Card 3 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/tortue.jpg"
            alt="Tortue"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">Tortue</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Moyen</span>
            <span>4 h</span>
        </div>
        </div>

        <!-- Card 4 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/crochetflower.jpg"
            alt="Crochet Flower"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">Crochet Flower</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Facile</span>
            <span>1 h</span>
        </div>
        </div>

        <!-- Card 5 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/crochetbag.jpg"
            alt="Crochet Bag"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">Crochet Bag</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Moyen</span>
            <span>6 h</span>
        </div>
        </div>

        <!-- Card 6 -->
        <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
        <img
            src="/images/crochetbag.jpg"
            alt="Crochet Bag"
            class="rounded mb-2 object-cover w-full h-24"
        />
        <div class="flex items-center justify-between text-xs mb-1">
            <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
            Projet
            </span>
            <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
            lire
            </span>
        </div>
        <p class="font-bold text-[#104730] text-sm mb-1">Crochet Bag</p>
        <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
        <hr class="my-2 border-gray-300" />
        <div class="flex items-center text-xs text-gray-600 justify-between">
            <span>Moyen</span>
            <span>6 h</span>
        </div>
        </div>
    </div>

    <!-- Les flèches sous les cartes, côté droit -->
    <div class="flex justify-end mt-2 space-x-2">
        <button
        class="w-9 h-9 flex items-center justify-center
                border border-black rounded-full text-black bg-white
                hover:bg-black hover:text-white transition-colors duration-200"
        >
        ←
        </button>
        <button
        class="w-9 h-9 flex items-center justify-center
                border border-black rounded-full text-black bg-white
                hover:bg-black hover:text-white transition-colors duration-200"
        >
        →
        </button>
    </div>
    </section>


        <!-- BLOC : Découvrez le crochet -->
        <section
        class="relative max-w-7xl ml-auto mb-12"
        style="height: 360px;"
        >
        <!-- Fond #F3E5DC, largeur max 6xl -->
        <div
            class="w-full h-full max-w-6xl bg-[#F3E5DC]
                rounded-lg shadow-md relative"
        >
            <!-- Arc en haut à droite -->
            <svg
            class="absolute top-0 right-0"
            width="200"
            height="200"
            viewBox="0 0 300 300"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="transform: rotate(-90deg);"
            >
            <path d="M 300,0 A 300,300 0 0,0 0,300 L 300,300 Z" fill="#0f4730" />
            <path d="M 300,50 A 250,250 0 0,0 50,300 L 300,300 Z" fill="#427153" />
            <path d="M 300,100 A 200,200 0 0,0 100,300 L 300,300 Z" fill="#F8F5F0" />
            <path d="M 300,150 A 150,150 0 0,0 150,300 L 300,300 Z" fill="#F7DCB9" />
            </svg>

            <!-- Bloc vert à gauche, centré verticalement -->
            <div
            class="absolute left-0 top-1/2 transform -translate-y-1/2 
                    bg-[#417154] text-white p-4 rounded-lg shadow-lg"
            style="width: 400px; margin-left: -100px;"
            >
            <h3 class="text-lg font-bold mb-2">
                Découvrez Le crochet&nbsp;!
            </h3>
            <p class="text-sm leading-relaxed">
                <strong>Avec nos cours introductifs offerts.</strong><br>
                Découvrez les bases pour créer facilement.<br>
                Lorem ipsum dolor sit amet...
            </p>
            </div>

            <!-- Conteneur des cartes, un peu plus bas (mt-6) -->
            <div class="relative flex flex-col items-start space-y-2 mt-9 px-4">
            
            <!-- Carte 1 -->
            <div
                class="relative border-2 border-[#104730] rounded-lg bg-white p-4 flex ml-auto mt-5 mr-2"
                style="width: 320px;"
            >
                <!-- Badge “Compétence” -->
                <div
                class="absolute top-2 left-2 bg-[#F7DCB9] text-[#104730]
                        text-xs font-semibold px-2 py-0.5 rounded"
                >
                Compétence
                </div>
                <!-- Image -->
                <div class="flex-shrink-0 mr-4">
                <img
                    src="/images/chainette.jpg"
                    alt="La chaînette"
                    class="rounded object-cover"
                    style="width: 100px; height: 70px;"
                />
                </div>
                <!-- Texte -->
                <div class="flex flex-col flex-grow justify-between">
                <div>
                    <p class="text-sm font-bold text-[#104730] mb-1">La chaînette</p>
                    <p class="text-xs text-gray-600">par Stéphane M.</p>
                    <hr class="my-2 border-gray-300" />
                    <p class="text-xs text-gray-600 mb-2">
                    Donne un bref aperçu...
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <!-- “Facile” et “10 min” l’un au-dessus de l’autre -->
                    <div class="text-xs text-gray-600 leading-tight">
                    <p>Facile</p>
                    <p>10 min</p>
                    </div>
                    <span
                    class="inline-block text-white bg-[#104730]
                            px-2 py-1 text-xs rounded"
                    >
                    Offert
                    </span>
                </div>
                </div>
            </div>

            <!-- Carte 2, avec un peu plus de marge en haut (mt-4) -->
            <div
                class="relative border-2 border-[#104730] rounded-lg bg-white p-4 flex ml-auto mr-2 mt-4"
                style="width: 320px;"
            >
                <div
                class="absolute top-2 left-2 bg-[#F7DCB9] text-[#104730]
                        text-xs font-semibold px-2 py-0.5 rounded"
                >
                Compétence
                </div>
                <div class="flex-shrink-0 mr-4">
                <img
                    src="/images/mailleenlair.jpg"
                    alt="La maille en l'air"
                    class="rounded object-cover"
                    style="width: 100px; height: 70px;"
                />
                </div>
                <div class="flex flex-col flex-grow justify-between">
                <div>
                    <p class="text-sm font-bold text-[#104730] mb-1">
                    La maille en l'air
                    </p>
                    <p class="text-xs text-gray-600">par Stéphane M.</p>
                    <hr class="my-2 border-gray-300" />
                    <p class="text-xs text-gray-600 mb-2">
                    Autre bref aperçu...
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-600 leading-tight">
                    <p>Facile</p>
                    <p>10 min</p>
                    </div>
                    <span
                    class="inline-block text-white bg-[#104730]
                            px-2 py-1 text-xs rounded"
                    >
                    Offert
                    </span>
                </div>
                </div>
            </div>

            </div><!-- fin des cartes -->
        </div><!-- fin fond beige -->
        </section>

<!-- SECTION : Nos compétences et projets -->
<section class="max-w-7xl mx-auto px-4 md:px-8 mb-10">

<h3 class="text-2xl font-bold mb-4" style="color: #104730;">
  Nos compétences et projets
</h3>

<!-- Ligne 1 : Filtres (½) + 2 cartes (½) -->
<div class="flex flex-wrap gap-3 ml-40">
  
<!-- Bloc vert (filtres) -->
<div
  class="relative bg-[#A0C1A6] rounded-lg p-3 shadow-sm
         w-full md:w-1/2 max-w-sm mx-auto md:mx-0
         m-6 overflow-hidden"
  style="max-width: 340px;"
>
  <!-- Barre de recherche -->
  <div class="mb-2">
    <input
      type="text"
      placeholder="Chercher"
      class="w-full px-3 py-2 border rounded-md
             focus:ring-2 focus:ring-[#104730]
             focus:outline-none text-sm"
    />
  </div>

  <!-- Boutons + Select -->
  <div class="flex items-center flex-wrap  mb-2">
    <button
      class="px-3 py-1 text-sm rounded border
             bg-[#F7DCB9] text-[#104730] font-semibold"
    >
      Tout
    </button>
    <button
      class="px-3 py-1 text-sm rounded border
             bg-white text-gray-700 hover:bg-gray-50"
    >
      Projet
    </button>
    <button
      class="px-2 py-1 text-sm rounded border
             bg-white text-gray-700 hover:bg-gray-50"
    >
      Compétence
    </button>

    <!-- Select à droite -->
    <select
      class="ml-auto border rounded-md px-2 py-1
             text-gray-700 text-sm focus:outline-none"
      style="min-width: 80px;"
    >
      <option>Facile</option>
      <option>Moyen</option>
      <option>Difficile</option>
    </select>
  </div>

  <!-- Range + "50 CT" / "240 CT" encadrés -->
  <div class="flex items-center justify-between gap-2 mb-2">
    <!-- 50 CT encadré -->
    <div
      class="flex items-center px-2 py-1 bg-white text-[#104730]
             text-sm font-bold border rounded"
      style="min-width: 50px; justify-content: center;"
    >
      50 CT
    </div>

    <div class="flex items-center gap-1 flex-grow">
      <input
        type="range"
        min="0"
        max="240"
        value="50"
        class="slider-yellow"
      />
    </div>

    <!-- 240 CT encadré -->
    <div
      class="flex items-center px-2 py-1 bg-white text-[#104730]
             text-sm font-bold border rounded"
      style="min-width: 50px; justify-content: center;"
    >
      240 CT
    </div>
  </div>

  <!-- "10 résultats" en bas à droite -->
  <p
    class="absolute bottom-2 right-3 text-sm font-medium text-black"
    style="line-height: 1.2;"
  >
    10 résultats
  </p>
</div>


  <!-- 2 cartes sur la même ligne (droite) -->
  <div class="w-full md:w-1/2 flex flex-col md:flex-row gap-2">
    <!-- Carte A : contour vert foncé -->
    <div
      class="flex-1 bg-white border-2 border-[#104730]
                 rounded-lg p-3 shadow-sm"
    >
      <img
        src="/images/tortue.jpg"
        alt="Tortue"
        class="rounded mb-2 object-cover w-full h-24"
      />
      <div class="flex items-center justify-between text-xs mb-1">
        <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
          Projet
        </span>
        <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
          10 craftout
        </span>
      </div>
      <p class="font-bold text-[#104730] text-sm mb-1">Tortue</p>
      <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
      <hr class="my-2 border-gray-300" />
      <div class="flex items-center text-xs text-gray-600 justify-between">
        <span>Moyen</span>
        <span>4 h</span>
      </div>
    </div>

    <!-- Carte B -->
    <div
      class="flex-1 bg-white border-2 border-[#104730]
                 rounded-lg p-3 shadow-sm"
    >
      <img
        src="/images/chainette.jpg"
        alt="La chaînette"
        class="rounded mb-2 object-cover w-full h-24"
      />
      <div class="flex items-center justify-between text-xs mb-1">
        <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
          Projet
        </span>
        <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
          10 craftout
        </span>
      </div>
      <p class="font-bold text-[#104730] text-sm mb-1">La chaînette</p>
      <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
      <hr class="my-2 border-gray-300" />
      <div class="flex items-center text-xs text-gray-600 justify-between">
        <span>Facile</span>
        <span>10 min</span>
      </div>
    </div>
  </div>
</div>
<!-- Fin ligne 1 -->

<!-- Ligne 2 : 4 cartes, contour vert foncé -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 mt-3">

  <div class="bg-white border-2 border-[#104730]
              rounded-lg p-3 shadow-sm">
    <img
      src="/images/lachapelle.jpg"
      alt="La chapelle"
      class="rounded mb-2 object-cover w-full h-24"
    />
    <div class="flex items-center justify-between text-xs mb-1">
      <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
        Projet
      </span>
      <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
        10 craftout
      </span>
    </div>
    <p class="font-bold text-[#104730] text-sm mb-1">La chapelle</p>
    <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
    <hr class="my-2 border-gray-300" />
    <div class="flex items-center text-xs text-gray-600 justify-between">
      <span>Difficile</span>
      <span>12 h</span>
    </div>
  </div>

  <div class="bg-white border-2 border-[#104730]
              rounded-lg p-3 shadow-sm">
    <img
      src="/images/crochetbag.jpg"
      alt="Crochet Bag"
      class="rounded mb-2 object-cover w-full h-24"
    />
    <div class="flex items-center justify-between text-xs mb-1">
      <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
        Projet
      </span>
      <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
        10 craftout
      </span>
    </div>
    <p class="font-bold text-[#104730] text-sm mb-1">Crochet Bag</p>
    <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
    <hr class="my-2 border-gray-300" />
    <div class="flex items-center text-xs text-gray-600 justify-between">
      <span>Moyen</span>
      <span>6 h</span>
    </div>
  </div>

  <div class="bg-white border-2 border-[#104730]
              rounded-lg p-3 shadow-sm">
    <img
      src="/images/crochetflower.jpg"
      alt="Crochet Flower"
      class="rounded mb-2 object-cover w-full h-24"
    />
    <div class="flex items-center justify-between text-xs mb-1">
      <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
        Projet
      </span>
      <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
        10 craftout
      </span>
    </div>
    <p class="font-bold text-[#104730] text-sm mb-1">Crochet Flower</p>
    <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
    <hr class="my-2 border-gray-300" />
    <div class="flex items-center text-xs text-gray-600 justify-between">
      <span>Facile</span>
      <span>1 h</span>
    </div>
  </div>

  <div class="bg-white border-2 border-[#104730]
              rounded-lg p-3 shadow-sm">
    <img
      src="/images/crochetblanket.jpg"
      alt="Crochet Blanket"
      class="rounded mb-2 object-cover w-full h-24"
    />
    <div class="flex items-center justify-between text-xs mb-1">
      <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
        Projet
      </span>
      <span class="bg-[#A0C1A6] text-white px-1 py-0.5 rounded">
        10 craftout
      </span>
    </div>
    <p class="font-bold text-[#104730] text-sm mb-1">Crochet Blanket</p>
    <p class="text-xs text-gray-600 mb-1">par Stéphane M.</p>
    <hr class="my-2 border-gray-300" />
    <div class="flex items-center text-xs text-gray-600 justify-between">
      <span>Moyen</span>
      <span>8 h</span>
    </div>
  </div>
</div>
<!-- Fin ligne 2 : 4 cartes -->

<div class="text-center mt-3">
  <button
    class="bg-[#E8B83A] text-[#104730] font-semibold
           py-1 px-4 rounded hover:bg-[#e7aa2d] text-sm"
  >
    Voir plus
  </button>
</div>
</section>

<!-- SECTION finale : Nos artisans experts pour apprendre -->
    <section class="relative w-full min-h-[350px] bg-[#F8F5F0] py-6">
    <!-- Titre -->
    <h3 class="text-2xl font-bold text-center mb-6 text-[#104730]">
        Nos artisans experts pour apprendre  le {{ craft.name }}
    </h3>

    <!-- Conteneur principal -->
    <div class="relative w-full" style="height: 320px; overflow: visible;">

        <!-- Carrousel à gauche -->
        <div
        class="absolute top-0 left-0 right-[400px] h-full
                overflow-hidden"
        >
        <div class="flex space-x-4 overflow-x-auto h-full pb-2 hide-scrollbar">
            <!-- Carte 1 -->
            <div
            class="relative min-w-[300px] h-full rounded-lg
                        overflow-hidden shadow-md flex-shrink-0"
            >
            <img
                src="/images/artisan1.jpg"
                alt="Artisan 1"
                class="object-cover w-full h-full"
            />
            <div
                class="absolute bottom-0 w-full bg-black bg-opacity-50
                    text-white px-4 py-3"
            >
                <p class="font-bold">Stéphane M.</p>
                <p class="text-xs">Fait du crochet depuis 7 ans</p>
            </div>
            </div>
            <!-- Carte 2 -->
            <div
            class="relative min-w-[300px] h-full rounded-lg
                        overflow-hidden shadow-md flex-shrink-0"
            >
            <img
                src="/images/artisan2.jpg"
                alt="Artisan 2"
                class="object-cover w-full h-full"
            />
            <div
                class="absolute bottom-0 w-full bg-black bg-opacity-50
                    text-white px-4 py-3"
            >
                <p class="font-bold">Marion L.</p>
                <p class="text-xs">Spécialiste amigurumis</p>
            </div>
            </div>
            <!-- Carte 3 -->
            <div
            class="relative min-w-[300px] h-full rounded-lg
                        overflow-hidden shadow-md flex-shrink-0"
            >
            <img
                src="/images/artisan3.jpg"
                alt="Artisan 3"
                class="object-cover w-full h-full"
            />
            <div
                class="absolute bottom-0 w-full bg-black bg-opacity-50
                    text-white px-4 py-3"
            >
                <p class="font-bold">Lucile D.</p>
                <p class="text-xs">Amoureuse des granny squares</p>
            </div>
            </div>
        </div>
        </div>

        <!-- Bloc "Besoin d'aide?" à droite -->
        <div
        class="absolute top-0 right-0 w-[400px]
                bg-[#DCEDE2] py-5 px-5"
        style="
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
        "
        >
        <h4 class="text-lg font-bold mb-3 text-[#104730]">
            Besoin d’aide ?
        </h4>
        <p class="text-sm text-[#104730] leading-relaxed mb-4">
            Vous pouvez prendre rendez-vous avec un artisan par appel
            ou visioconférence pendant 30 minutes ou 1 heure,
            en échange d’un nombre de crédits.
        </p>
        <button
            class="bg-[#E8B83A] text-[#104730] font-semibold
                py-2 px-4 rounded-full hover:bg-[#e7aa2d]
                text-sm"
        >
            Prendre rendez-vous avec un artisan
        </button>
        </div>

        <!-- Flèches de navigation -->
        <div
        class="absolute -bottom-2 right-[410px]
                flex space-x-3"
        >
        <!-- Fond transparent ou semi-transparent -->
        <button
            class="w-9 h-9 flex items-center justify-center
                border border-black rounded-full text-black bg-white
                hover:bg-black hover:text-white transition-colors
                duration-200"
        >
            ←
        </button>
        <button
            class="w-9 h-9 flex items-center justify-center
                border border-black rounded-full text-black bg-white
                hover:bg-black hover:text-white transition-colors
                duration-200"
        >
            →
        </button>
        </div>
    </div>
    </section>




    </div>
</template>
  
  <script setup lang="ts">
  import { Head } from '@inertiajs/vue3';
  
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
  </script>
  
  <style scoped>
  .hide-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .hide-scrollbar {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none;    /* Firefox */
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
  </style>