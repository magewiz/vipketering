<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';

const props = defineProps({
    page: { type: Object, required: true },
});

const c = computed(() => props.page.content ?? {});
const pad = (i) => String(i + 1).padStart(2, '0');
// services are split into two columns of three
const servicesLeft = computed(() => (c.value.services?.items ?? []).slice(0, 3));
const servicesRight = computed(() => (c.value.services?.items ?? []).slice(3, 6));
</script>

<template>
  <Head :title="page.meta_title || 'За Нас'">
    <link rel="preload" as="image" :href="c.hero.image" fetchpriority="high" />
  </Head>
  <Layout>
    <section class="dark-zone relative pt-[78px] overflow-hidden">
      <div class="relative h-[46vh] min-h-[360px] lg:h-[210px] lg:min-h-[210px] flex items-end">
        <img :src="c.hero.image" alt="" fetchpriority="high" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.65),rgba(16,15,13,.45) 50%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> {{ c.hero.title }}</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">{{ c.hero.title }}</h1>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-paper">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
          <img :src="c.intro.image" alt="VIP Catering — Најдобриот кетеринг во градот" loading="lazy" decoding="async" class="w-full rounded-sm shadow-[0_30px_60px_-30px_rgba(0,0,0,.85)] reveal">
        </div>
        <div class="lg:col-span-7 space-y-5">
          <p v-for="(p, i) in c.intro.paragraphs" :key="i" class="lead reveal" :data-d="i" v-html="p"></p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-surface border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="max-w-2xl mb-14">
          <span class="eyebrow reveal">{{ c.services.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.services.heading"></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-x-12">
          <ul class="divide-y divide-[var(--line-soft)]">
            <li v-for="(s, i) in servicesLeft" :key="i" class="flex items-center gap-5 py-6 reveal" :data-d="i"><span class="card-num">{{ pad(i) }}</span><div><h3 class="font-display text-2xl text-cream">{{ s.title }}</h3><p class="text-sm muted mt-1">{{ s.text }}</p></div></li>
          </ul>
          <ul class="divide-y divide-[var(--line-soft)]">
            <li v-for="(s, i) in servicesRight" :key="i" class="flex items-center gap-5 py-6 reveal" :data-d="i"><span class="card-num">{{ pad(i + 3) }}</span><div><h3 class="font-display text-2xl text-cream">{{ s.title }}</h3><p class="text-sm muted mt-1">{{ s.text }}</p></div></li>
          </ul>
        </div>
      </div>
    </section>


    <section class="py-24 md:py-32 bg-paper">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-16 items-center">
        <div class="grid grid-cols-2 gap-4 reveal">
          <img v-if="c.why.images[0]" :src="c.why.images[0]" alt="" loading="lazy" decoding="async" class="w-full aspect-[3/4] object-cover">
          <img v-if="c.why.images[1]" :src="c.why.images[1]" alt="" loading="lazy" decoding="async" class="w-full aspect-[3/4] object-cover translate-y-8">
          <img v-if="c.why.images[2]" :src="c.why.images[2]" alt="" loading="lazy" decoding="async" class="w-full aspect-[16/10] object-cover col-span-2">
        </div>
        <div>
          <span class="eyebrow reveal">{{ c.why.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.why.heading"></h2>
          <div class="mt-8 space-y-px">
            <div v-for="(pt, i) in c.why.points" :key="i" class="flex gap-6 py-6 reveal" :class="i === c.why.points.length - 1 ? 'border-y border-[var(--line-soft)]' : 'border-t border-[var(--line-soft)]'" :data-d="i + 1"><span class="index-num">{{ pad(i) }}</span><p class="lead self-center">{{ pt.text }}</p></div>
          </div>
        </div>
      </div>
    </section>


    <section class="bg-surface py-20 border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10 grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-6">
        <div v-for="(s, i) in c.stats" :key="i" class="text-center reveal" :data-d="i + 1"><div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span :data-count="s.value">0</span><span :class="{ 'text-3xl align-top': s.suffix === '★' }">{{ s.suffix }}</span></div><div class="hairline w-12 mx-auto my-4 opacity-60"></div><p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">{{ s.label }}</p></div>
      </div>
    </section>


    <section class="dark-zone relative py-24 md:py-32 overflow-hidden">
      <img :src="c.cta.image" alt="" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal" v-html="c.cta.heading"></h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">{{ c.cta.lead }}</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2">
          <Link href="/contact" class="btn btn-gold">Контакт <span class="arr">→</span></Link>
          <Link href="/menia" class="btn btn-ghost">Разгледај мениа</Link>
        </div>
      </div>
    </section>
  </Layout>
</template>
