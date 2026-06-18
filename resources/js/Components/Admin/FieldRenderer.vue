<script setup>
import { computed } from 'vue';
import { getByPath, setByPath } from '../../lib/path';
import ImageField from './ImageField.vue';

// Named so the template can reference itself recursively (repeater sub-fields).
defineOptions({ name: 'FieldRenderer' });

const props = defineProps({
  field: { type: Object, required: true },
  // The object this field's key is resolved against (page content, or a repeater item).
  model: { type: Object, required: true },
});

// Writable proxy for scalar field types.
const val = computed({
  get: () => getByPath(props.model, props.field.key) ?? '',
  set: (v) => setByPath(props.model, props.field.key, v),
});

// Array accessor for list / images / repeater. Ensures an array exists.
function arr() {
  let a = getByPath(props.model, props.field.key);
  if (!Array.isArray(a)) {
    a = [];
    setByPath(props.model, props.field.key, a);
  }
  return a;
}
const items = computed(() => {
  getByPath(props.model, props.field.key); // touch for reactivity
  return arr();
});

function addListItem() { arr().push(''); }
function addImage() { arr().push(''); }
function addRepeaterItem() {
  const blank = {};
  (props.field.fields || []).forEach((f) => { blank[f.key] = ''; });
  arr().push(blank);
}
function removeAt(i) { arr().splice(i, 1); }
function move(i, dir) {
  const a = arr();
  const j = i + dir;
  if (j < 0 || j >= a.length) return;
  [a[i], a[j]] = [a[j], a[i]];
}
function setListItem(i, v) { arr()[i] = v; }
</script>

<template>
  <!-- text -->
  <div v-if="field.type === 'text'">
    <label class="block text-sm font-medium text-neutral-700 mb-1.5">{{ field.label }}</label>
    <input v-model="val" type="text" class="w-full px-3 py-2 rounded-md border border-neutral-300 focus:border-neutral-900 focus:ring-0 outline-none">
    <p v-if="field.help" class="text-xs text-neutral-400 mt-1" v-html="field.help"></p>
  </div>

  <!-- textarea -->
  <div v-else-if="field.type === 'textarea'">
    <label class="block text-sm font-medium text-neutral-700 mb-1.5">{{ field.label }}</label>
    <textarea v-model="val" rows="3" class="w-full px-3 py-2 rounded-md border border-neutral-300 focus:border-neutral-900 outline-none"></textarea>
    <p v-if="field.help" class="text-xs text-neutral-400 mt-1" v-html="field.help"></p>
  </div>

  <!-- html -->
  <div v-else-if="field.type === 'html'">
    <label class="block text-sm font-medium text-neutral-700 mb-1.5">{{ field.label }} <span class="text-[10px] uppercase tracking-wide text-amber-600 ml-1">HTML</span></label>
    <textarea v-model="val" rows="2" class="w-full px-3 py-2 rounded-md border border-neutral-300 font-mono text-sm focus:border-neutral-900 outline-none"></textarea>
    <p class="text-xs text-neutral-400 mt-1" v-html="field.help || 'Дозволено е <br> и едноставен HTML.'"></p>
  </div>

  <!-- single image -->
  <div v-else-if="field.type === 'image'">
    <ImageField v-model="val" :label="field.label" />
  </div>

  <!-- list of images -->
  <div v-else-if="field.type === 'images'">
    <div class="flex items-center justify-between mb-2">
      <label class="block text-sm font-medium text-neutral-700">{{ field.label }}</label>
      <button type="button" @click="addImage" class="text-sm px-2.5 py-1 rounded border border-neutral-300 hover:bg-neutral-100">+ Слика</button>
    </div>
    <div class="space-y-3">
      <div v-for="(it, i) in items" :key="i" class="flex items-start gap-2">
        <div class="flex-1"><ImageField :model-value="it" @update:model-value="(v) => setListItem(i, v)" /></div>
        <div class="flex flex-col gap-1 pt-1">
          <button type="button" @click="move(i, -1)" class="px-2 text-neutral-400 hover:text-neutral-900" title="Нагоре">↑</button>
          <button type="button" @click="move(i, 1)" class="px-2 text-neutral-400 hover:text-neutral-900" title="Надолу">↓</button>
          <button type="button" @click="removeAt(i)" class="px-2 text-red-500 hover:text-red-700" title="Избриши">✕</button>
        </div>
      </div>
      <p v-if="!items.length" class="text-sm text-neutral-400">Нема слики.</p>
    </div>
  </div>

  <!-- list of strings -->
  <div v-else-if="field.type === 'list'">
    <div class="flex items-center justify-between mb-2">
      <label class="block text-sm font-medium text-neutral-700">{{ field.label }}</label>
      <button type="button" @click="addListItem" class="text-sm px-2.5 py-1 rounded border border-neutral-300 hover:bg-neutral-100">+ Додај</button>
    </div>
    <div class="space-y-2">
      <div v-for="(it, i) in items" :key="i" class="flex items-start gap-2">
        <textarea v-if="field.html" :value="it" @input="setListItem(i, $event.target.value)" rows="2"
                  class="flex-1 px-3 py-2 rounded-md border border-neutral-300 font-mono text-sm outline-none focus:border-neutral-900"></textarea>
        <input v-else :value="it" @input="setListItem(i, $event.target.value)" type="text"
               class="flex-1 px-3 py-2 rounded-md border border-neutral-300 outline-none focus:border-neutral-900">
        <button type="button" @click="move(i, -1)" class="px-2 text-neutral-400 hover:text-neutral-900">↑</button>
        <button type="button" @click="move(i, 1)" class="px-2 text-neutral-400 hover:text-neutral-900">↓</button>
        <button type="button" @click="removeAt(i)" class="px-2 text-red-500 hover:text-red-700">✕</button>
      </div>
      <p v-if="!items.length" class="text-sm text-neutral-400">Празно.</p>
    </div>
  </div>

  <!-- repeater -->
  <div v-else-if="field.type === 'repeater'">
    <div class="flex items-center justify-between mb-2">
      <label class="block text-sm font-medium text-neutral-700">{{ field.label }}</label>
      <button type="button" @click="addRepeaterItem" class="text-sm px-2.5 py-1 rounded border border-neutral-300 hover:bg-neutral-100">+ Додај</button>
    </div>
    <div class="space-y-3">
      <div v-for="(it, i) in items" :key="i" class="rounded-lg border border-neutral-200 bg-neutral-50 p-4">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-neutral-400">#{{ i + 1 }}</span>
          <div class="flex items-center gap-1">
            <button type="button" @click="move(i, -1)" class="px-2 text-neutral-400 hover:text-neutral-900">↑</button>
            <button type="button" @click="move(i, 1)" class="px-2 text-neutral-400 hover:text-neutral-900">↓</button>
            <button type="button" @click="removeAt(i)" class="px-2 text-red-500 hover:text-red-700">✕</button>
          </div>
        </div>
        <div class="space-y-3">
          <FieldRenderer v-for="sf in field.fields" :key="sf.key" :field="sf" :model="it" />
        </div>
      </div>
      <p v-if="!items.length" class="text-sm text-neutral-400">Нема ставки.</p>
    </div>
  </div>
</template>
