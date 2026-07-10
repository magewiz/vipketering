<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import MenuCard from '../Components/MenuCard.vue';
import { telHref, aspectClass } from '../lib/format';

const props = defineProps({
  page: { type: Object, required: true },
  menus: { type: Object, default: () => ({}) },
  gallery: { type: Array, default: () => [] },
});

const c = computed(() => props.page.content ?? {});
const shvedska = computed(() => props.menus.shvedska ?? []);
const svecheni = computed(() => props.menus.svecheni ?? []);
const settings = computed(() => usePage().props.settings ?? {});
const primaryPhone = computed(() => settings.value.phone_primary);
</script>

<template>
  <Head :title="page.meta_title || 'Мениа'">
    <link rel="preload" as="image" :href="c.hero.image" fetchpriority="high" />
  </Head>
  <Layout>
    <section class="dark-zone relative pt-[78px] overflow-hidden">
      <div class="relative h-[52vh] min-h-[400px] lg:h-[262px] lg:min-h-[262px] flex items-end">
        <img :src="c.hero.image" alt="" fetchpriority="high" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.6),rgba(16,15,13,.4) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> {{ c.hero.title }}</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">{{ c.hero.title }}</h1>
          <p class="lead max-w-xl mt-4 hero-anim" data-d="3">{{ c.hero.lead }}</p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-paper">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14">
          <div><span class="eyebrow reveal">{{ c.shvedska.eyebrow }}</span><h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.shvedska.heading"></h2></div>
          <p class="lead max-w-sm reveal" data-d="2">{{ c.shvedska.lead }}</p>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
          <MenuCard v-for="(m, i) in shvedska" :key="m.id" :menu="m" :index="i" />
        </div>

        <div class="mt-20 mb-14">
          <span class="eyebrow reveal">{{ c.svecheni.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.svecheni.heading"></h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
          <MenuCard v-for="(m, i) in svecheni" :key="m.id" :menu="m" :index="i" />
        </div>

        <p class="text-center text-sm muted mt-12 reveal" v-html="c.footnote"></p>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-surface border-t border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="eyebrow reveal">{{ c.gallery.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.gallery.heading"></h2>
          <p class="lead mt-4 reveal" data-d="2">{{ c.gallery.lead }}</p>
        </div>
        <div class="columns-2 md:columns-3 lg:columns-4 gap-3 md:gap-4 [&>*]:mb-3 md:[&>*]:mb-4">
          <div v-for="(g, i) in gallery" :key="i" class="gal-item reveal" :data-d="(i % 4)" :data-lb="g.src"><img :src="g.src" :alt="g.alt || ''" loading="lazy" decoding="async" :class="aspectClass(g.aspect)"></div>
        </div>
      </div>
    </section>


    <section class="dark-zone relative py-24 md:py-32 overflow-hidden">
      <img :src="c.cta.image" alt="" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal" v-html="c.cta.heading"></h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">{{ c.cta.lead }}</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2"><a v-if="primaryPhone" :href="telHref(primaryPhone)" class="btn btn-gold">{{ primaryPhone }}</a><Link href="/contact" class="btn btn-ghost">Контакт <span class="arr">→</span></Link></div>
      </div>
    </section>
  </Layout>
</template>
