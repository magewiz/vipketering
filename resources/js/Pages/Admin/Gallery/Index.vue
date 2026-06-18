<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';
import ImageField from '../../../Components/Admin/ImageField.vue';

const props = defineProps({
  collections: { type: Array, default: () => [] },
  current: { type: String, required: true },
  images: { type: Array, default: () => [] },
});

const aspects = ['square', '3/4', '4/5', '16/10'];

const rows = ref([]);
watch(() => props.images, (v) => { rows.value = v.map((i) => ({ ...i })); }, { immediate: true });

const newImg = ref({ src: '', alt: '', caption: '', aspect: 'square' });

function save(row) {
  router.put(`/admin/gallery/${row.id}`, {
    src: row.src, alt: row.alt, caption: row.caption, aspect: row.aspect, is_published: row.is_published,
  }, { preserveScroll: true });
}
function destroy(row) {
  if (confirm('Избриши ја сликата?')) {
    router.delete(`/admin/gallery/${row.id}`, { preserveScroll: true });
  }
}
function add() {
  if (!newImg.value.src) { alert('Прикачете или внесете слика прво.'); return; }
  router.post('/admin/gallery', { collection: props.current, ...newImg.value }, {
    preserveScroll: true,
    onSuccess: () => { newImg.value = { src: '', alt: '', caption: '', aspect: 'square' }; },
  });
}
</script>

<template>
  <Head title="Галерии — Админ" />
  <AdminLayout title="Галерии">
    <!-- Collection tabs -->
    <div class="flex flex-wrap gap-2 mb-6">
      <Link v-for="c in collections" :key="c.key" :href="`/admin/gallery?collection=${c.key}`"
            class="px-4 py-2 rounded-full text-sm border transition"
            :class="c.key === current ? 'bg-neutral-900 text-white border-neutral-900' : 'bg-white border-neutral-300 hover:border-neutral-900'">
        {{ c.label }}
      </Link>
    </div>

    <!-- Add new -->
    <div class="bg-neutral-50 rounded-xl border border-dashed border-neutral-300 p-5 mb-6 max-w-3xl">
      <h2 class="font-medium text-neutral-800 mb-3">Додај слика</h2>
      <ImageField v-model="newImg.src" />
      <div class="grid sm:grid-cols-3 gap-3 mt-3">
        <input v-model="newImg.caption" placeholder="Опис (caption)" class="px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        <input v-model="newImg.alt" placeholder="Alt текст" class="px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        <select v-model="newImg.aspect" class="px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          <option v-for="a in aspects" :key="a" :value="a">{{ a }}</option>
        </select>
      </div>
      <button @click="add" class="mt-3 px-4 py-2 text-sm rounded-md bg-neutral-900 text-white hover:bg-neutral-700">+ Додај во галерија</button>
    </div>

    <!-- Existing images -->
    <div class="grid sm:grid-cols-2 gap-4 max-w-3xl">
      <div v-for="row in rows" :key="row.id" class="bg-white rounded-xl border border-neutral-200 p-4">
        <ImageField v-model="row.src" />
        <div class="grid grid-cols-2 gap-2 mt-3">
          <input v-model="row.caption" placeholder="Опис" class="col-span-2 px-3 py-2 rounded-md border border-neutral-300 text-sm outline-none focus:border-neutral-900">
          <input v-model="row.alt" placeholder="Alt" class="px-3 py-2 rounded-md border border-neutral-300 text-sm outline-none focus:border-neutral-900">
          <select v-model="row.aspect" class="px-3 py-2 rounded-md border border-neutral-300 text-sm outline-none focus:border-neutral-900">
            <option :value="null">—</option>
            <option v-for="a in aspects" :key="a" :value="a">{{ a }}</option>
          </select>
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
      <p v-if="!rows.length" class="text-sm text-neutral-400">Нема слики во оваа галерија.</p>
    </div>
  </AdminLayout>
</template>
