<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

defineProps({
  submissions: { type: Array, default: () => [] },
  unreadCount: { type: Number, default: 0 },
});

const openId = ref(null);

function toggle(s) {
  openId.value = openId.value === s.id ? null : s.id;
  if (!s.is_read) setRead(s, true);
}

function setRead(s, value) {
  router.patch(`/admin/contacts/${s.id}`, { is_read: value }, { preserveScroll: true, preserveState: false });
}

function destroy(s) {
  if (confirm(`Избриши ја пораката од „${s.name}“?`)) {
    router.delete(`/admin/contacts/${s.id}`, { preserveScroll: true });
  }
}

function fmtDate(v) {
  if (!v) return '—';
  return new Date(v).toLocaleString('mk-MK', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
}

function fmtDay(v) {
  if (!v) return '—';
  return new Date(v).toLocaleDateString('mk-MK', { day: '2-digit', month: '2-digit', year: 'numeric' });
}
</script>

<template>
  <Head title="Пораки — Админ" />
  <AdminLayout title="Пораки од контакт формата">
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-neutral-500">
        Вкупно {{ submissions.length }} пораки<span v-if="unreadCount"> · <span class="font-medium text-neutral-900">{{ unreadCount }}</span> непрочитани</span>
      </p>
    </div>

    <div class="bg-white rounded-xl border border-neutral-200 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-neutral-50 text-neutral-500 text-left">
          <tr>
            <th class="px-5 py-3 font-medium w-8"></th>
            <th class="px-5 py-3 font-medium">Име</th>
            <th class="px-5 py-3 font-medium">Телефон</th>
            <th class="px-5 py-3 font-medium">Тип на настан</th>
            <th class="px-5 py-3 font-medium">Датум на настан</th>
            <th class="px-5 py-3 font-medium">Примено</th>
            <th class="px-5 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100">
          <template v-for="s in submissions" :key="s.id">
            <tr class="hover:bg-neutral-50 cursor-pointer" :class="{ 'font-medium': !s.is_read }" @click="toggle(s)">
              <td class="px-5 py-3">
                <span class="inline-block w-2 h-2 rounded-full" :class="s.is_read ? 'bg-neutral-300' : 'bg-[#C29A4B]'" :title="s.is_read ? 'Прочитано' : 'Непрочитано'"></span>
              </td>
              <td class="px-5 py-3 text-neutral-900">{{ s.name }}</td>
              <td class="px-5 py-3 text-neutral-600">{{ s.phone }}</td>
              <td class="px-5 py-3 text-neutral-600">{{ s.event_type }}</td>
              <td class="px-5 py-3 text-neutral-600">{{ fmtDay(s.event_date) }}</td>
              <td class="px-5 py-3 text-neutral-500 whitespace-nowrap">{{ fmtDate(s.created_at) }}</td>
              <td class="px-5 py-3 text-right whitespace-nowrap">
                <span class="text-neutral-400">{{ openId === s.id ? '▲' : '▼' }}</span>
              </td>
            </tr>
            <tr v-if="openId === s.id" class="bg-neutral-50/60">
              <td></td>
              <td colspan="6" class="px-5 py-5">
                <dl class="grid sm:grid-cols-2 gap-x-8 gap-y-3 max-w-2xl">
                  <div><dt class="text-xs uppercase tracking-wide text-neutral-400">Е-пошта</dt><dd class="text-neutral-800">{{ s.email || '—' }}</dd></div>
                  <div><dt class="text-xs uppercase tracking-wide text-neutral-400">Телефон</dt><dd class="text-neutral-800"><a :href="`tel:${s.phone}`" class="text-[#9a7a2f] hover:underline">{{ s.phone }}</a></dd></div>
                  <div><dt class="text-xs uppercase tracking-wide text-neutral-400">Тип на настан</dt><dd class="text-neutral-800">{{ s.event_type }}</dd></div>
                  <div><dt class="text-xs uppercase tracking-wide text-neutral-400">Датум на настан</dt><dd class="text-neutral-800">{{ fmtDay(s.event_date) }}</dd></div>
                  <div><dt class="text-xs uppercase tracking-wide text-neutral-400">Број на гости</dt><dd class="text-neutral-800">{{ s.guests || '—' }}</dd></div>
                </dl>
                <div class="mt-4">
                  <dt class="text-xs uppercase tracking-wide text-neutral-400 mb-1">Порака</dt>
                  <dd class="text-neutral-800 whitespace-pre-line">{{ s.message || '—' }}</dd>
                </div>
                <div class="mt-5 flex items-center gap-4">
                  <a v-if="s.email" :href="`mailto:${s.email}`" class="px-3 py-1.5 rounded-md bg-neutral-900 text-white text-xs font-medium hover:bg-neutral-700">Одговори по е-пошта</a>
                  <button @click.stop="setRead(s, !s.is_read)" class="text-neutral-600 hover:text-neutral-900 text-xs">
                    {{ s.is_read ? 'Означи како непрочитано' : 'Означи како прочитано' }}
                  </button>
                  <button @click.stop="destroy(s)" class="text-red-500 hover:text-red-700 text-xs ml-auto">Избриши</button>
                </div>
              </td>
            </tr>
          </template>
          <tr v-if="!submissions.length"><td colspan="7" class="px-5 py-10 text-center text-neutral-400">Сè уште нема пораки.</td></tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>
