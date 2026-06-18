<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../Components/Admin/AdminLayout.vue';

defineProps({
  stats: { type: Object, default: () => ({}) },
  pages: { type: Array, default: () => [] },
});

const cards = [
  { key: 'pages', label: 'Страници', href: '/admin/pages' },
  { key: 'menus', label: 'Мениа', href: '/admin/menus' },
  { key: 'equipment', label: 'Опрема', href: '/admin/equipment' },
  { key: 'images', label: 'Слики во галерии', href: '/admin/gallery' },
];
</script>

<template>
  <Head title="Преглед — Админ" />
  <AdminLayout title="Преглед">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <Link v-for="c in cards" :key="c.key" :href="c.href"
            class="bg-white rounded-xl border border-neutral-200 p-5 hover:shadow-md transition">
        <div class="text-3xl font-bold text-neutral-900">{{ stats[c.key] ?? 0 }}</div>
        <div class="text-sm text-neutral-500 mt-1">{{ c.label }}</div>
      </Link>
    </div>

    <div class="bg-white rounded-xl border border-neutral-200 p-6">
      <h2 class="font-semibold text-neutral-900 mb-1">Уреди страница</h2>
      <p class="text-sm text-neutral-500 mb-4">Изберете страница за да го промените текстот и сликите.</p>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <Link v-for="p in pages" :key="p.slug" :href="`/admin/pages/${p.slug}`"
              class="flex items-center justify-between px-4 py-3 rounded-lg border border-neutral-200 hover:border-neutral-900 transition">
          <span class="font-medium text-neutral-800">{{ p.title }}</span>
          <span class="text-neutral-400">→</span>
        </Link>
      </div>
    </div>
  </AdminLayout>
</template>
