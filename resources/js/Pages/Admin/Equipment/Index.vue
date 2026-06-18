<script setup>
import { ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({ items: { type: Array, default: () => [] } });

// Local editable copies of the rows.
const rows = ref([]);
watch(() => props.items, (v) => {
  rows.value = v.map((i) => ({ ...i }));
}, { immediate: true });

const newItem = ref({ name: '', note: '', price: '', is_published: true });

function save(row) {
  router.put(`/admin/equipment/${row.id}`, {
    name: row.name, note: row.note, price: row.price, is_published: row.is_published,
  }, { preserveScroll: true });
}
function destroy(row) {
  if (confirm(`Избриши „${row.name}“?`)) {
    router.delete(`/admin/equipment/${row.id}`, { preserveScroll: true });
  }
}
function add() {
  if (!newItem.value.name) return;
  router.post('/admin/equipment', newItem.value, {
    preserveScroll: true,
    onSuccess: () => { newItem.value = { name: '', note: '', price: '', is_published: true }; },
  });
}
</script>

<template>
  <Head title="Опрема — Админ" />
  <AdminLayout title="Опрема за изнајмување">
    <p class="text-sm text-neutral-500 mb-4">Ценовник за опрема прикажан на страницата „Опрема“.</p>

    <div class="space-y-3 max-w-3xl">
      <div v-for="row in rows" :key="row.id" class="bg-white rounded-xl border border-neutral-200 p-4">
        <div class="grid sm:grid-cols-12 gap-3 items-start">
          <div class="sm:col-span-5">
            <label class="block text-xs font-medium text-neutral-500 mb-1">Назив</label>
            <input v-model="row.name" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div class="sm:col-span-2">
            <label class="block text-xs font-medium text-neutral-500 mb-1">Цена</label>
            <input v-model="row.price" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div class="sm:col-span-5">
            <label class="block text-xs font-medium text-neutral-500 mb-1">Забелешка</label>
            <input v-model="row.note" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
        </div>
        <div class="flex items-center justify-between mt-3">
          <label class="flex items-center gap-2 text-sm text-neutral-600">
            <input v-model="row.is_published" type="checkbox" class="rounded border-neutral-300"> Објавено
          </label>
          <div class="flex items-center gap-3">
            <button @click="save(row)" class="px-3 py-1.5 text-sm rounded-md bg-neutral-900 text-white hover:bg-neutral-700">Зачувај</button>
            <button @click="destroy(row)" class="text-sm text-red-500 hover:text-red-700">Избриши</button>
          </div>
        </div>
      </div>

      <!-- Add new -->
      <div class="bg-neutral-50 rounded-xl border border-dashed border-neutral-300 p-4">
        <h2 class="font-medium text-neutral-800 mb-3">Нова ставка</h2>
        <div class="grid sm:grid-cols-12 gap-3">
          <input v-model="newItem.name" placeholder="Назив" class="sm:col-span-5 px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          <input v-model="newItem.price" placeholder="Цена" class="sm:col-span-2 px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          <input v-model="newItem.note" placeholder="Забелешка" class="sm:col-span-5 px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        </div>
        <button @click="add" class="mt-3 px-4 py-2 text-sm rounded-md bg-neutral-900 text-white hover:bg-neutral-700">+ Додај ставка</button>
      </div>
    </div>
  </AdminLayout>
</template>
