<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

defineProps({ pages: { type: Array, default: () => [] } });
</script>

<template>
  <Head title="Страници — Админ" />
  <AdminLayout title="Страници">
    <div class="bg-white rounded-xl border border-neutral-200 divide-y divide-neutral-100">
      <Link v-for="p in pages" :key="p.id" :href="`/admin/pages/${p.slug}`"
            class="flex items-center justify-between px-5 py-4 hover:bg-neutral-50 transition">
        <div>
          <div class="font-medium text-neutral-900">{{ p.title }}</div>
          <div class="text-xs text-neutral-400 font-mono">/{{ p.slug === 'home' ? '' : p.slug }}</div>
        </div>
        <span class="text-sm text-neutral-500">Уреди →</span>
      </Link>
    </div>
  </AdminLayout>
</template>
