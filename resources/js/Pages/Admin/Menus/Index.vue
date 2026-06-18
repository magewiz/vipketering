<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

defineProps({ menus: { type: Array, default: () => [] } });

const groupLabel = { shvedska: 'Шведска маса', svecheni: 'Свечени мениа' };

function destroy(menu) {
  if (confirm(`Избриши „${menu.title}“?`)) {
    router.delete(`/admin/menus/${menu.id}`, { preserveScroll: true });
  }
}
</script>

<template>
  <Head title="Мениа — Админ" />
  <AdminLayout title="Мениа">
    <div class="flex justify-end mb-4">
      <Link href="/admin/menus/create" class="px-4 py-2 rounded-md bg-neutral-900 text-white text-sm font-medium hover:bg-neutral-700">+ Ново мени</Link>
    </div>

    <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-neutral-50 text-neutral-500 text-left">
          <tr>
            <th class="px-5 py-3 font-medium">Наслов</th>
            <th class="px-5 py-3 font-medium">Група</th>
            <th class="px-5 py-3 font-medium">Цена</th>
            <th class="px-5 py-3 font-medium">Објавено</th>
            <th class="px-5 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100">
          <tr v-for="m in menus" :key="m.id" class="hover:bg-neutral-50">
            <td class="px-5 py-3 font-medium text-neutral-900">{{ m.title }}</td>
            <td class="px-5 py-3 text-neutral-500">{{ groupLabel[m.group] || m.group }}</td>
            <td class="px-5 py-3 text-neutral-500">{{ m.price }} {{ m.price_unit }}</td>
            <td class="px-5 py-3">
              <span :class="m.is_published ? 'text-green-600' : 'text-neutral-400'">{{ m.is_published ? 'Да' : 'Не' }}</span>
            </td>
            <td class="px-5 py-3 text-right whitespace-nowrap">
              <Link :href="`/admin/menus/${m.id}/edit`" class="text-neutral-600 hover:text-neutral-900 mr-4">Уреди</Link>
              <button @click="destroy(m)" class="text-red-500 hover:text-red-700">Избриши</button>
            </td>
          </tr>
          <tr v-if="!menus.length"><td colspan="5" class="px-5 py-8 text-center text-neutral-400">Нема мениа.</td></tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>
