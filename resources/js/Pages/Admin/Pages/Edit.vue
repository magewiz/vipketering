<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';
import FieldRenderer from '../../../Components/Admin/FieldRenderer.vue';

const props = defineProps({
  page: { type: Object, required: true },
  schema: { type: Array, default: () => [] },
});

const form = useForm({
  meta_title: props.page.meta_title ?? '',
  meta_description: props.page.meta_description ?? '',
  content: JSON.parse(JSON.stringify(props.page.content ?? {})),
});

// Collapsible sections — first one open by default.
const open = ref(props.schema.map((_, i) => i === 0));
const toggle = (i) => (open.value[i] = !open.value[i]);

function submit() {
  form.put(`/admin/pages/${props.page.slug}`, { preserveScroll: true });
}
</script>

<template>
  <Head :title="`${page.title} — Админ`" />
  <AdminLayout :title="`Уреди: ${page.title}`">
    <div class="mb-4">
      <Link href="/admin/pages" class="text-sm text-neutral-500 hover:text-neutral-900">← Сите страници</Link>
    </div>

    <form @submit.prevent="submit" class="space-y-5 max-w-3xl pb-24">
      <!-- SEO -->
      <div class="bg-white rounded-xl border border-neutral-200 p-6 space-y-4">
        <h2 class="font-semibold text-neutral-900">SEO</h2>
        <div>
          <label class="block text-sm font-medium text-neutral-700 mb-1.5">Мета наслов</label>
          <input v-model="form.meta_title" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        </div>
        <div>
          <label class="block text-sm font-medium text-neutral-700 mb-1.5">Мета опис</label>
          <textarea v-model="form.meta_description" rows="2" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900"></textarea>
        </div>
      </div>

      <!-- Content sections -->
      <div v-for="(section, si) in schema" :key="si" class="bg-white rounded-xl border border-neutral-200 overflow-hidden">
        <button type="button" @click="toggle(si)"
                class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-neutral-50">
          <span class="font-semibold text-neutral-900">{{ section.title }}</span>
          <span class="text-neutral-400">{{ open[si] ? '−' : '+' }}</span>
        </button>
        <div v-show="open[si]" class="px-6 pb-6 space-y-5 border-t border-neutral-100 pt-5">
          <FieldRenderer v-for="f in section.fields" :key="f.key" :field="f" :model="form.content" />
        </div>
      </div>

      <!-- Sticky save bar -->
      <div class="fixed bottom-0 left-0 right-0 lg:pl-64 bg-white/95 backdrop-blur border-t border-neutral-200">
        <div class="max-w-6xl px-4 sm:px-8 py-3 flex items-center gap-3">
          <button type="submit" :disabled="form.processing"
                  class="px-5 py-2.5 rounded-md bg-neutral-900 text-white font-medium hover:bg-neutral-700 disabled:opacity-50">
            {{ form.processing ? 'Се зачувува…' : 'Зачувај промени' }}
          </button>
          <a :href="page.slug === 'home' ? '/' : `/${page.slug}`" target="_blank"
             class="text-sm text-neutral-500 hover:text-neutral-900">Прегледај ↗</a>
          <span v-if="form.recentlySuccessful" class="text-sm text-green-600">Зачувано ✓</span>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
