<?php include("./addons/Toast.php"); ?>
<header class="sticky top-0 bg-white border-b border-gray-200 z-30">
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 -mb-px">
      <div class="flex"><button class="text-gray-500 hover:text-gray-600 lg:hidden" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen"><span class="sr-only">Open sidebar</span> <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="5" width="16" height="2" />
            <rect x="4" y="11" width="16" height="2" />
            <rect x="4" y="17" width="16" height="2" />
          </svg></button></div>
      <div class="flex items-center space-x-3">

        <div class="relative inline-flex" x-data="{ open: false }"><button class="inline-flex justify-center items-center group" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
            <svg width="32" height="32" viewBox="0 0 32 32">
              <defs>
                <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                  <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%"></stop>
                  <stop stop-color="#A5B4FC" offset="100%"></stop>
                </linearGradient>
                <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                  <stop stop-color="#38BDF8" stop-opacity="0" offset="0%"></stop>
                  <stop stop-color="#38BDF8" offset="100%"></stop>
                </linearGradient>
              </defs>
              <rect fill="#6366F1" width="32" height="32" rx="16"></rect>
              <path d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z" fill="#4F46E5"></path>
              <path d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z" fill="url(#logo-a)"></path>
              <path d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z" fill="url(#logo-b)"></path>
            </svg>
            <div class="flex items-center truncate"><span class="truncate ml-2 text-sm font-medium group-hover:text-gray-800"><?= $ADMIN["name"] ?></span> <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
              </svg></div>
          </button>
          <div class="origin-top-right z-10 absolute top-full right-0 min-w-44 bg-white border border-gray-200 py-1.5 rounded shadow-lg overflow-hidden mt-1" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
            <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-gray-200">
              <div class="font-medium text-gray-800"><?= $ADMIN["name"] ?></div>
              <div class="text-xs text-gray-500 italic">Administrator</div>
            </div>
            <ul>
              <li>
                <form method="post" action="./controllers/auth.controller.php">
                  <button name="logout" class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3" @click="open = false" @focus="open = true" @focusout="open = false">Sign Out</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>