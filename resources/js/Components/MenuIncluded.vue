<script setup>
defineProps({
  items: {
    type: Array,
    default: () => ['Чинии', 'Чаши (вода, виски, ракија, пиво итн.)', 'Есцајг', 'Чаршафи за маси'],
  },
  label: {
    type: String,
    default: 'Во цената на менито е вклучено',
  },
});
</script>

<template>
  <div v-if="items && items.length" class="menu-incl">
    <span class="menu-incl-label">{{ label }}</span>
    <ul class="grid grid-cols-2 gap-x-4 gap-y-1.5 mt-2.5">
      <li v-for="x in items" :key="x" class="flex items-baseline gap-2 text-cream/70">
        <span class="text-[var(--gold)] leading-none text-[.7rem]">—</span>
        <span class="text-[.72rem] leading-snug">{{ x }}</span>
      </li>
    </ul>
  </div>
</template>
