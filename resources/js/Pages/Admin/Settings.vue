<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Components/Admin/AdminLayout.vue';
import ImageField from '../../Components/Admin/ImageField.vue';

const props = defineProps({
  settings: { type: Object, required: true },
});

const form = useForm({
  brand_name: props.settings.brand_name ?? '',
  tagline: props.settings.tagline ?? '',
  logo: props.settings.logo ?? '',
  phone_primary: props.settings.phone_primary ?? '',
  phone_primary_label: props.settings.phone_primary_label ?? '',
  phone_secondary: props.settings.phone_secondary ?? '',
  phone_secondary_label: props.settings.phone_secondary_label ?? '',
  email: props.settings.email ?? '',
  address: props.settings.address ?? '',
  facebook_url: props.settings.facebook_url ?? '',
  instagram_url: props.settings.instagram_url ?? '',
});

function submit() {
  form.put('/admin/settings', { preserveScroll: true });
}
</script>

<template>
  <Head title="Поставки — Админ" />
  <AdminLayout title="Поставки на страницата">
    <form @submit.prevent="submit" class="space-y-6 max-w-3xl">
      <div class="bg-white rounded-xl border border-neutral-200 p-6 space-y-4">
        <h2 class="font-semibold text-neutral-900">Бренд</h2>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Име на бренд</label>
            <input v-model="form.brand_name" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Слоган (tagline)</label>
            <input v-model="form.tagline" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
        </div>
        <ImageField v-model="form.logo" label="Лого" />
      </div>

      <div class="bg-white rounded-xl border border-neutral-200 p-6 space-y-4">
        <h2 class="font-semibold text-neutral-900">Телефони</h2>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Телефон 1</label>
            <input v-model="form.phone_primary" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Ознака за тел. 1 (на пр. Димитар)</label>
            <input v-model="form.phone_primary_label" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Телефон 2</label>
            <input v-model="form.phone_secondary" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Ознака за тел. 2 (на пр. Мартин)</label>
            <input v-model="form.phone_secondary_label" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-neutral-200 p-6 space-y-4">
        <h2 class="font-semibold text-neutral-900">Контакт и социјални мрежи</h2>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Е-пошта</label>
            <input v-model="form.email" type="email" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Адреса</label>
            <input v-model="form.address" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Facebook URL</label>
            <input v-model="form.facebook_url" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
          <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1.5">Instagram URL</label>
            <input v-model="form.instagram_url" class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          </div>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <button type="submit" :disabled="form.processing"
                class="px-5 py-2.5 rounded-md bg-neutral-900 text-white font-medium hover:bg-neutral-700 disabled:opacity-50">
          {{ form.processing ? 'Се зачувува…' : 'Зачувај' }}
        </button>
      </div>
    </form>
  </AdminLayout>
</template>
