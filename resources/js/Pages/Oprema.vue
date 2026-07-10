<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import MenuIncluded from '../Components/MenuIncluded.vue';
import { telHref } from '../lib/format';

const props = defineProps({
  page: { type: Object, required: true },
  equipment: { type: Array, default: () => [] },
  gallery: { type: Array, default: () => [] },
});

const c = computed(() => props.page.content ?? {});
const partners = computed(() => c.value.partners ?? {});
const settings = computed(() => usePage().props.settings ?? {});
const phones = computed(() => [settings.value.phone_primary, settings.value.phone_secondary].filter(Boolean));
</script>

<template>
  <Head :title="page.meta_title || 'Опрема'">
    <link rel="preload" as="image" :href="c.hero.image" fetchpriority="high" />
  </Head>
  <Layout>
    <section class="dark-zone relative pt-[78px] overflow-hidden">
      <div class="relative h-[48vh] min-h-[380px] lg:h-[298px] lg:min-h-[298px] flex items-end">
        <img :src="c.hero.image" alt="" fetchpriority="high" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.62),rgba(16,15,13,.42) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> {{ c.hero.title }}</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">{{ c.hero.title }}</h1>
          <p class="lead max-w-2xl mt-4 hero-anim" data-d="3">{{ c.hero.lead }}</p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-paper">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-12 gap-12">

        <div class="lg:col-span-7 self-start">
          <span class="eyebrow reveal">{{ c.pricing.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.pricing.heading"></h2>
          <p class="lead mt-6 reveal" data-d="1">{{ c.pricing.intro }}</p>

          <article id="oprema-cenovnik" class="menu-card p-6 md:p-8 mt-8 reveal" data-d="1">
            <div class="flex items-start justify-between gap-3">
              <div>
                <h3 class="menu-title font-display text-cream">{{ c.pricing.card_title }}</h3>
                <span class="menu-group">{{ c.pricing.card_group }}</span>
              </div>
              <button class="share-btn" :data-share="c.pricing.card_title" aria-label="Сподели ценовник за опрема"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
            </div>
            <ul class="mt-6 border-t border-[var(--line-soft)]">
              <li v-for="(item, i) in equipment" :key="item.id ?? i" class="flex items-baseline gap-4 py-4 border-b border-[var(--line-soft)]">
                <div class="min-w-0">
                  <h4 class="font-display text-xl md:text-2xl text-cream leading-tight">{{ item.name }}</h4>
                  <p v-if="item.note" class="text-sm muted italic mt-1">{{ item.note }}</p>
                </div>
                <span class="flex-1 -translate-y-1 border-b border-dotted border-[var(--line-soft)]"></span>
                <span class="font-display text-xl md:text-2xl text-[var(--gold-bright)] whitespace-nowrap">{{ item.price }} <span class="text-sm muted">ден.</span></span>
              </li>
            </ul>
            <MenuIncluded />
          </article>

          <p class="text-sm muted italic mt-6 reveal">{{ c.pricing.footnote }}</p>

          <p class="lead mt-8 reveal">{{ c.pricing.contact_intro }}</p>
          <div class="flex flex-wrap gap-4 mt-5 reveal" data-d="1">
            <a v-for="p in phones" :key="p" :href="telHref(p)" class="btn btn-ghost"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ p }}</a>
          </div>
        </div>


        <div class="lg:col-span-5">
          <div class="card p-8 reveal" data-d="1">
            <h3 class="eyebrow">Партнери за декорација</h3>
            <p class="muted text-sm mt-3">{{ partners.intro }}</p>
            <div class="mt-6 space-y-6">
              <div v-for="(pt, i) in partners.items" :key="i" :class="i < partners.items.length - 1 ? 'pb-6 border-b border-[var(--line-soft)]' : ''">
                <h4 class="font-display text-2xl text-cream">{{ pt.title }}</h4>
                <p class="muted text-sm mt-1">{{ pt.label }}</p>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-3">
                  <a v-if="pt.phone1" :href="telHref(pt.phone1)" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ pt.phone1 }}</a>
                  <a v-if="pt.phone2" :href="telHref(pt.phone2)" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ pt.phone2 }}</a>
                </div>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-2">
                  <a v-if="pt.instagram" :href="pt.instagram" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span> Instagram</a>
                  <a v-if="pt.facebook" :href="pt.facebook" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span> Facebook</a>
                </div>
              </div>
            </div>
            <img v-if="partners.image" :src="partners.image" alt="" loading="lazy" decoding="async" class="w-full h-44 object-cover mt-8">
          </div>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-surface border-t border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="eyebrow reveal">{{ c.gallery.eyebrow }}</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1" v-html="c.gallery.heading"></h2>
          <p class="lead mt-4 reveal" data-d="2">{{ c.gallery.lead }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
          <div v-for="(g, i) in gallery" :key="i" class="gal-item aspect-[4/5] reveal" :data-d="(i % 4)" :data-lb="g.src"><img :src="g.src" :alt="g.alt || ''" loading="lazy" decoding="async"><div v-if="g.caption" class="gal-cap"><span class="text-sm text-cream font-medium">{{ g.caption }}</span></div></div>
        </div>
      </div>
    </section>


    <section class="dark-zone relative py-24 md:py-32 overflow-hidden">
      <img :src="c.cta.image" alt="" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal" v-html="c.cta.heading"></h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">{{ c.cta.lead }}</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2"><Link href="/contact" class="btn btn-gold">Контакт <span class="arr">→</span></Link><a v-if="phones[0]" :href="telHref(phones[0])" class="btn btn-ghost">{{ phones[0] }}</a></div>
      </div>
    </section>
  </Layout>
</template>
