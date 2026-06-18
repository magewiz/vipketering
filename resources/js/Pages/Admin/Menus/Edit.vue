<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({ menu: { type: Object, required: true } });

const isNew = computed(() => !props.menu.id);

const form = useForm({
  title: props.menu.title ?? '',
  slug: props.menu.slug ?? '',
  group: props.menu.group ?? 'shvedska',
  group_label: props.menu.group_label ?? 'Шведска маса',
  price: props.menu.price ?? '',
  price_unit: props.menu.price_unit ?? 'ден.',
  price_per: props.menu.price_per ?? '/ особа',
  note: props.menu.note ?? '',
  dishes: (props.menu.dishes ?? []).map((d) => ({ name: d.name ?? '', detail: d.detail ?? '' })),
  included: [...(props.menu.included ?? [])],
  is_published: props.menu.is_published ?? true,
});

const groupLabels = { shvedska: 'Шведска маса', svecheni: 'Свечени мениа' };
function onGroupChange() {
  if (!form.group_label || Object.values(groupLabels).includes(form.group_label)) {
    form.group_label = groupLabels[form.group];
  }
}

function addDish() { form.dishes.push({ name: '', detail: '' }); }
function removeDish(i) { form.dishes.splice(i, 1); }
function moveDish(i, dir) {
  const j = i + dir;
  if (j < 0 || j >= form.dishes.length) return;
  [form.dishes[i], form.dishes[j]] = [form.dishes[j], form.dishes[i]];
}
function addIncluded() { form.included.push(''); }
function removeIncluded(i) { form.included.splice(i, 1); }

function submit() {
  if (isNew.value) {
    form.post('/admin/menus');
  } else {
    form.put(`/admin/menus/${props.menu.id}`);
  }
}
</script>

<template>
  <Head :title="`${isNew ? 'Ново мени' : menu.title} — Админ`" />
  <AdminLayout :title="isNew ? 'Ново мени' : `Уреди: ${menu.title}`">
    <div class="mb-4">
      <Link href="/admin/menus" class="text-sm text-neutral-500 hover:text-neutral-900">← Сите мениа</Link>
    </div>

    <form @submit.prevent="submit" class="space-y-5 max-w-3xl">
      <div class="bg-white rounded-xl border border-neutral-200 p-6 space-y-4">
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Наслов</label>
            <input v-model="form.title" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
            <p v-if="form.errors.title" class="text-xs text-red-600 mt-1">{{ form.errors.title }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Група</label>
            <select v-model="form.group" @change="onGroupChange" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
              <option value="shvedska">Шведска маса</option>
              <option value="svecheni">Свечени мениа</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Ознака на група</label>
            <input v-model="form.group_label" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Slug (за линк, опционално)</label>
            <input v-model="form.slug" placeholder="авто" class="w-full px-3 py-2 rounded-md border border-neutral-300 font-mono text-sm outline-none focus:border-neutral-900">
          </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Цена</label>
            <input v-model="form.price" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Единица</label>
            <input v-model="form.price_unit" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">По (на пр. / особа)</label>
            <input v-model="form.price_per" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-neutral-700 mb-1.5">Забелешка (опционално)</label>
          <input v-model="form.note" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        </div>

        <label class="flex items-center gap-2 text-sm text-neutral-700">
          <input v-model="form.is_published" type="checkbox" class="rounded border-neutral-300"> Објавено
        </label>
      </div>

      <!-- Dishes -->
      <div class="bg-white rounded-xl border border-neutral-200 p-6">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-semibold text-neutral-900">Јадења</h2>
          <button type="button" @click="addDish" class="text-sm px-2.5 py-1 rounded border border-neutral-300 hover:bg-neutral-100">+ Јадење</button>
        </div>
        <div class="space-y-3">
          <div v-for="(d, i) in form.dishes" :key="i" class="rounded-lg border border-neutral-200 bg-neutral-50 p-3">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs text-neutral-400">#{{ i + 1 }}</span>
              <div class="flex gap-1">
                <button type="button" @click="moveDish(i, -1)" class="px-2 text-neutral-400 hover:text-neutral-900">↑</button>
                <button type="button" @click="moveDish(i, 1)" class="px-2 text-neutral-400 hover:text-neutral-900">↓</button>
                <button type="button" @click="removeDish(i)" class="px-2 text-red-500 hover:text-red-700">✕</button>
              </div>
            </div>
            <input v-model="d.name" placeholder="Име на јадење (задебелено)" class="w-full px-3 py-2 mb-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
            <input v-model="d.detail" placeholder="Состојки / опис (закосено, опционално)" class="w-full px-3 py-2 rounded-md border border-neutral-300 text-sm outline-none focus:border-neutral-900">
          </div>
          <p v-if="!form.dishes.length" class="text-sm text-neutral-400">Нема јадења.</p>
        </div>
      </div>

      <!-- Included -->
      <div class="bg-white rounded-xl border border-neutral-200 p-6">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-semibold text-neutral-900">Во цената е вклучено</h2>
          <button type="button" @click="addIncluded" class="text-sm px-2.5 py-1 rounded border border-neutral-300 hover:bg-neutral-100">+ Ставка</button>
        </div>
        <div class="space-y-2">
          <div v-for="(it, i) in form.included" :key="i" class="flex gap-2">
            <input v-model="form.included[i]" class="flex-1 px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
            <button type="button" @click="removeIncluded(i)" class="px-2 text-red-500 hover:text-red-700">✕</button>
          </div>
          <p v-if="!form.included.length" class="text-sm text-neutral-400">Празно.</p>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <button type="submit" :disabled="form.processing"
                class="px-5 py-2.5 rounded-md bg-neutral-900 text-white font-medium hover:bg-neutral-700 disabled:opacity-50">
          {{ form.processing ? 'Се зачувува…' : 'Зачувај' }}
        </button>
        <Link href="/admin/menus" class="text-sm text-neutral-500 hover:text-neutral-900">Откажи</Link>
      </div>
    </form>
  </AdminLayout>
</template>
