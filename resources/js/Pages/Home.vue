<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import { telHref, aspectClass } from '../lib/format';

const props = defineProps({
    page: { type: Object, required: true },
    gallery: { type: Array, default: () => [] },
});

const c = computed(() => props.page.content ?? {});
const settings = computed(() => usePage().props.settings ?? {});
const phones = computed(() => [settings.value.phone_primary, settings.value.phone_secondary].filter(Boolean));
const pad = (i) => String(i + 1).padStart(2, '0');
</script>

<template>
  <Head :title="page.meta_title || ''">
    <link rel="preload" as="image" :href="c.hero.image" :imagesrcset="c.hero.image_srcset" :imagesizes="c.hero.image_srcset ? '100vw' : null" fetchpriority="high" />
  </Head>
  <Layout>
    <section class="dark-zone relative min-h-screen flex items-end overflow-hidden">
      <div class="absolute inset-0">
        <img :src="c.hero.image" :srcset="c.hero.image_srcset" :sizes="c.hero.image_srcset ? '100vw' : null" alt="" fetchpriority="high" class="w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.72) 0%,rgba(16,15,13,.30) 40%,rgba(16,15,13,.55) 75%,var(--ink) 100%)"></div>
        <div class="absolute inset-0" style="background:radial-gradient(120% 80% at 0% 100%,rgba(16,15,13,.85),transparent 60%)"></div>
      </div>

      <div class="relative maxw w-full px-5 md:px-10 pb-16 md:pb-24 pt-32">
        <div class="hero-anim" data-d="1">
          <span class="eyebrow">{{ c.hero.eyebrow }}</span>
        </div>
        <h1 class="font-display d1 mt-6 max-w-5xl hero-anim" data-d="2" v-html="c.hero.heading"></h1>
        <p class="lead max-w-xl mt-7 hero-anim" data-d="3">{{ c.hero.lead }}</p>
        <div class="flex flex-wrap items-center gap-4 mt-10 hero-anim" data-d="4">
          <Link href="/contact" class="btn btn-gold">{{ c.hero.cta_primary }} <span class="arr">→</span></Link>
          <Link href="/menia" class="btn btn-ghost">{{ c.hero.cta_secondary }}</Link>
        </div>

        <div class="flex flex-wrap items-center gap-x-8 gap-y-3 mt-12 hero-anim" data-d="5">
          <a v-for="p in phones" :key="p" :href="telHref(p)" class="font-display text-2xl md:text-3xl text-cream hover:text-[var(--gold-bright)] transition flex items-center gap-3"><span class="ico ico-gold text-[1.4rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>{{ p }}</a>
        </div>
      </div>

      <div class="scrollcue absolute right-6 md:right-10 bottom-10 hidden md:flex flex-col items-center gap-3">
        <span></span>
        <em class="text-[.6rem] tracking-[.3em] uppercase text-[var(--muted)] [writing-mode:vertical-rl] not-italic">Скролај</em>
      </div>
    </section>


    <section class="relative bg-paper py-24 md:py-32 overflow-hidden">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
        <div class="relative reveal">
          <div class="absolute -top-5 -left-5 w-24 h-24 border border-[var(--gold)] opacity-40 hidden md:block"></div>
          <img :src="c.welcome.image" alt="VIP Ketering буфет" loading="lazy" decoding="async" class="relative w-full aspect-[4/5] object-cover shadow-2xl">
          <div class="dark-zone absolute -bottom-6 -right-4 md:-right-8 bg-[var(--ink)] px-7 py-5 shadow-xl">
            <span class="font-display text-4xl text-[var(--gold-bright)] leading-none">{{ c.welcome.badge_number }}</span>
            <span class="block text-[.7rem] tracking-[.22em] uppercase mt-1 text-cream/70">{{ c.welcome.badge_label }}</span>
          </div>
        </div>
        <div>
          <span class="eyebrow reveal">{{ c.welcome.eyebrow }}</span>
          <h2 class="font-display d2 mt-5 reveal" data-d="1" v-html="c.welcome.heading"></h2>
          <p v-for="(p, i) in c.welcome.paragraphs" :key="i" class="lead reveal" :class="i === 0 ? 'mt-7' : 'mt-4'" data-d="2" v-html="p"></p>
          <div class="grid sm:grid-cols-3 gap-6 mt-10">
            <div v-for="(f, i) in c.welcome.features" :key="i" class="reveal" :data-d="i + 1"><span class="card-num">✦</span><h3 class="font-semibold mt-2">{{ f.title }}</h3><p class="text-sm muted mt-1">{{ f.text }}</p></div>
          </div>
        </div>
      </div>
    </section>


    <section class="relative bg-paper py-20 md:py-24 border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10 grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-6">
        <div v-for="(s, i) in c.stats" :key="i" class="text-center reveal" :data-d="i + 1">
          <div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span :data-count="s.value">0</span><span :class="{ 'text-3xl align-top': s.suffix === '★' }">{{ s.suffix }}</span></div>
          <div class="hairline w-12 mx-auto my-4 opacity-60"></div>
          <p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">{{ s.label }}</p>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-surface overflow-hidden">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16">
          <div>
            <span class="eyebrow reveal">{{ c.services.eyebrow }}</span>
            <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.services.heading"></h2>
          </div>
          <p class="lead max-w-sm reveal" data-d="2">{{ c.services.lead }}</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-[var(--line-soft)] border border-[var(--line-soft)]">
          <article v-for="(s, i) in c.services.items" :key="i" class="svc reveal" :data-d="(i % 3) + 1">
            <span class="card-num">{{ pad(i) }}</span>
            <h3 class="font-display text-2xl mt-4 text-cream">{{ s.title }}</h3>
            <p class="text-sm muted mt-3 leading-relaxed">{{ s.text }}</p>
          </article>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-paper overflow-hidden">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-16 items-center">
        <div class="order-2 lg:order-1">
          <span class="eyebrow reveal">{{ c.why.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.why.heading"></h2>
          <div class="mt-10 space-y-px">
            <div v-for="(pt, i) in c.why.points" :key="i" class="flex gap-6 py-6 reveal" :class="i === c.why.points.length - 1 ? 'border-y border-[var(--line-soft)]' : 'border-t border-[var(--line-soft)]'" :data-d="i + 1">
              <span class="index-num">{{ pad(i) }}</span>
              <p class="lead self-center">{{ pt.text }}</p>
            </div>
          </div>
        </div>
        <div class="order-1 lg:order-2 grid grid-cols-2 gap-4 reveal" data-d="2">
          <img v-if="c.why.images[0]" :src="c.why.images[0]" alt="" loading="lazy" decoding="async" class="w-full aspect-[3/4] object-cover translate-y-6">
          <img v-if="c.why.images[1]" :src="c.why.images[1]" alt="" loading="lazy" decoding="async" class="w-full aspect-[3/4] object-cover">
          <img v-if="c.why.images[2]" :src="c.why.images[2]" alt="" loading="lazy" decoding="async" class="w-full aspect-[4/3] object-cover col-span-2">
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-surface">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
          <div>
            <span class="eyebrow reveal">{{ c.gallery.eyebrow }}</span>
            <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.gallery.heading"></h2>
          </div>
          <Link href="/menia" class="btn btn-ghost self-start reveal" data-d="2">{{ c.gallery.link_label }} <span class="arr">→</span></Link>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
          <div v-for="(g, i) in gallery" :key="i" class="gal-item reveal" :class="[aspectClass(g.aspect), { 'md:mt-8': i % 2 === 1 }]" :data-d="i + 1"><img :src="g.src" :alt="g.alt || ''" loading="lazy" decoding="async"></div>
        </div>
      </div>
    </section>


    <section class="dark-zone relative py-24 md:py-36 overflow-hidden">
      <img :src="c.cta.image" alt="" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.78),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <span class="eyebrow reveal">{{ c.cta.eyebrow }}</span>
        <h2 class="font-display d1 mt-5 reveal" data-d="1" v-html="c.cta.heading"></h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="2">{{ c.cta.lead }}</p>
        <div class="flex flex-wrap justify-center items-center gap-5 mt-10 reveal" data-d="3">
          <a v-for="(p, i) in phones" :key="p" :href="telHref(p)" class="btn" :class="i === 0 ? 'btn-gold' : 'btn-ghost'">{{ p }}</a>
        </div>
      </div>
    </section>
  </Layout>
</template>
