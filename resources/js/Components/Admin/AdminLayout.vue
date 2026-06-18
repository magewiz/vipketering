<script setup>
import { computed, ref, watch } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

defineProps({ title: { type: String, default: '' } });

const page = usePage();
const user = computed(() => page.props.auth?.user);
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);

const nav = [
    { label: 'Преглед', href: '/admin', icon: '▦' },
    { label: 'Страници', href: '/admin/pages', icon: '▤' },
    { label: 'Мениа', href: '/admin/menus', icon: '☰' },
    { label: 'Опрема', href: '/admin/equipment', icon: '⚙' },
    { label: 'Галерии', href: '/admin/gallery', icon: '▥' },
    { label: 'Поставки', href: '/admin/settings', icon: '✎' },
];

const url = computed(() => page.url.split('?')[0]);
const isActive = (href) => href === '/admin' ? url.value === '/admin' : url.value.startsWith(href);

const toast = ref('');
let toastTimer;
watch([flashSuccess, flashError], ([s, e]) => {
    const msg = s || e;
    if (!msg) return;
    toast.value = msg;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => (toast.value = ''), 3200);
}, { immediate: true });

const sidebarOpen = ref(false);

function logout() {
    router.post('/admin/logout');
}
</script>

<template>
  <div class="min-h-screen bg-neutral-100 text-neutral-800 font-sans">
    <!-- Sidebar -->
    <aside
      class="fixed inset-y-0 left-0 z-40 w-64 bg-neutral-900 text-neutral-200 flex flex-col transition-transform lg:translate-x-0"
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
      <div class="h-16 flex items-center gap-3 px-6 border-b border-white/10">
        <span class="w-9 h-9 grid place-items-center rounded bg-[#C29A4B] text-neutral-900 font-bold">V</span>
        <div class="leading-tight">
          <div class="font-semibold text-sm">VIP Ketering</div>
          <div class="text-[11px] text-neutral-400">Админ панел</div>
        </div>
      </div>
      <nav class="flex-1 py-4 px-3 space-y-1 overflow-y-auto">
        <Link
          v-for="l in nav" :key="l.href" :href="l.href"
          class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm transition"
          :class="isActive(l.href) ? 'bg-[#C29A4B] text-neutral-900 font-medium' : 'hover:bg-white/5'"
          @click="sidebarOpen = false"
        >
          <span class="w-5 text-center opacity-80">{{ l.icon }}</span> {{ l.label }}
        </Link>
      </nav>
      <div class="p-3 border-t border-white/10">
        <a href="/" target="_blank" class="block px-3 py-2 text-sm text-neutral-400 hover:text-white">↗ Види ја страницата</a>
        <button type="button" @click="logout" class="w-full text-left px-3 py-2 text-sm text-neutral-400 hover:text-white">⎋ Одјави се</button>
      </div>
    </aside>

    <!-- Overlay on mobile -->
    <div v-if="sidebarOpen" class="fixed inset-0 z-30 bg-black/40 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Main -->
    <div class="lg:pl-64">
      <header class="h-16 bg-white border-b border-neutral-200 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-20">
        <div class="flex items-center gap-3">
          <button class="lg:hidden text-2xl" @click="sidebarOpen = true" aria-label="Мени">☰</button>
          <h1 class="text-lg font-semibold text-neutral-900">{{ title }}</h1>
        </div>
        <div class="text-sm text-neutral-500 hidden sm:block">{{ user?.name }}</div>
      </header>

      <main class="p-4 sm:p-8 max-w-6xl">
        <slot />
      </main>
    </div>

    <!-- Toast -->
    <transition name="fade">
      <div v-if="toast" class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-lg shadow-lg text-sm text-white"
           :class="flashError ? 'bg-red-600' : 'bg-neutral-900'">
        {{ toast }}
      </div>
    </transition>
  </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity .25s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>
