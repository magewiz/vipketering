<script setup>
import MenuIncluded from './MenuIncluded.vue';

const props = defineProps({
  menu: { type: Object, required: true },
  index: { type: Number, default: 0 },
});

const sharePrice = props.menu.price ? `${props.menu.price} ${props.menu.price_unit || 'ден.'}` : '';
</script>

<template>
  <article :id="menu.slug" class="menu-card p-6 md:p-7 reveal" :data-d="(index % 3) + 1">
    <div class="flex items-start justify-between gap-3">
      <div>
        <h3 class="menu-title font-display text-cream">{{ menu.title }}</h3>
        <span class="menu-group">{{ menu.group_label }}</span>
      </div>
      <button class="share-btn" :data-share="menu.title" :data-price="sharePrice" :aria-label="`Сподели ${menu.title}`"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
    </div>
    <div class="flex items-end gap-1.5 mt-3">
      <span class="price-tag text-[3.1rem]">{{ menu.price }}</span>
      <span class="price-unit text-base mb-2">{{ menu.price_unit || 'ден.' }}</span>
      <span class="price-per text-xs mb-2 ml-1">{{ menu.price_per || '/ особа' }}</span>
    </div>
    <p v-if="menu.note" class="menu-note">{{ menu.note }}</p>
    <div class="mt-4">
      <div v-for="(dish, i) in menu.dishes" :key="i" class="menu-dish"><b>{{ dish.name }}</b><i v-if="dish.detail">{{ dish.detail }}</i></div>
    </div>
    <MenuIncluded :items="menu.included" />
  </article>
</template>
