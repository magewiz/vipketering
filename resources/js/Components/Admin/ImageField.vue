<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  modelValue: { type: String, default: '' },
  label: { type: String, default: '' },
});
const emit = defineEmits(['update:modelValue']);

const uploading = ref(false);
const error = ref('');
const input = ref(null);

async function onFile(e) {
  const file = e.target.files?.[0];
  if (!file) return;
  uploading.value = true;
  error.value = '';
  try {
    const data = new FormData();
    data.append('file', file);
    const res = await axios.post('/admin/media', data, {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
    emit('update:modelValue', res.data.src);
  } catch (err) {
    error.value = err.response?.data?.message || 'Прикачувањето не успеа.';
  } finally {
    uploading.value = false;
    if (input.value) input.value.value = '';
  }
}

function clear() {
  emit('update:modelValue', '');
}
</script>

<template>
  <div>
    <label v-if="label" class="block text-sm font-medium text-neutral-700 mb-1.5">{{ label }}</label>
    <div class="flex items-start gap-4">
      <div class="w-28 h-20 shrink-0 rounded-md border border-neutral-200 bg-neutral-50 overflow-hidden grid place-items-center">
        <img v-if="modelValue" :src="modelValue" alt="" class="w-full h-full object-cover">
        <span v-else class="text-neutral-300 text-xs">нема слика</span>
      </div>
      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center gap-2">
          <button type="button" @click="input.click()" :disabled="uploading"
                  class="px-3 py-1.5 text-sm rounded-md bg-neutral-900 text-white hover:bg-neutral-700 disabled:opacity-50">
            {{ uploading ? 'Се прикачува…' : 'Прикачи / замени' }}
          </button>
          <button v-if="modelValue" type="button" @click="clear"
                  class="px-3 py-1.5 text-sm rounded-md border border-neutral-300 hover:bg-neutral-100">Отстрани</button>
          <input ref="input" type="file" accept="image/*" class="hidden" @change="onFile">
        </div>
        <input
          :value="modelValue"
          @input="emit('update:modelValue', $event.target.value)"
          class="mt-2 w-full text-xs px-2.5 py-1.5 rounded border border-neutral-200 text-neutral-500 font-mono"
          placeholder="/img/...jpg или URL"
        >
        <p v-if="error" class="text-xs text-red-600 mt-1">{{ error }}</p>
      </div>
    </div>
  </div>
</template>
