<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

function submit() {
  form.post('/admin/login', {
    onFinish: () => form.reset('password'),
  });
}
</script>

<template>
  <Head title="Најава — Админ" />
  <div class="min-h-screen bg-neutral-900 flex items-center justify-center p-4 font-sans">
    <div class="w-full max-w-sm">
      <div class="text-center mb-8">
        <div class="inline-grid place-items-center w-14 h-14 rounded-lg bg-[#C29A4B] text-neutral-900 text-2xl font-bold mb-4">V</div>
        <h1 class="text-white text-xl font-semibold">VIP Ketering</h1>
        <p class="text-neutral-400 text-sm mt-1">Админ панел</p>
      </div>

      <form @submit.prevent="submit" class="bg-white rounded-xl shadow-xl p-6 space-y-4">
        <div>
          <label class="block text-sm font-medium text-neutral-700 mb-1.5">Е-пошта</label>
          <input v-model="form.email" type="email" autofocus required
                 class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          <p v-if="form.errors.email" class="text-xs text-red-600 mt-1">{{ form.errors.email }}</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-neutral-700 mb-1.5">Лозинка</label>
          <input v-model="form.password" type="password" required
                 class="w-full px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
          <p v-if="form.errors.password" class="text-xs text-red-600 mt-1">{{ form.errors.password }}</p>
        </div>
        <label class="flex items-center gap-2 text-sm text-neutral-600">
          <input v-model="form.remember" type="checkbox" class="rounded border-neutral-300"> Запомни ме
        </label>
        <button type="submit" :disabled="form.processing"
                class="w-full py-2.5 rounded-md bg-neutral-900 text-white font-medium hover:bg-neutral-700 disabled:opacity-50">
          {{ form.processing ? 'Се најавува…' : 'Најави се' }}
        </button>
      </form>

      <p class="text-center text-neutral-500 text-xs mt-6">
        <a href="/" class="hover:text-neutral-300">← Назад на страницата</a>
      </p>
    </div>
  </div>
</template>
