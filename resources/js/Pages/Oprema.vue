<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import MenuIncluded from '../Components/MenuIncluded.vue';

const equipment = [
  { name: 'Маса со чаршаф', price: '600' },
  { name: 'Тифани столче', price: '120' },
  { name: 'Коњопои со прекривка', price: '350' },
  { name: 'Тенда (3 × 3)', price: '700' },
  { name: 'Фрижидер за пијалок', price: '2.000' },
  { name: 'Келнер', price: '2.000' },
  { name: 'Изнајмување на скара со готвач', note: 'Подготвување скара на самиот настан, за над 100 особи', price: '4.000' },
];
</script>

<template>
  <Head title="Опрема" />
  <Layout>
    <section class="relative pt-[78px] overflow-hidden">
      <div class="relative h-[48vh] min-h-[380px] lg:h-[298px] lg:min-h-[298px] flex items-end">
        <img src="/img/equip-03.jpg" alt="" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.62),rgba(16,15,13,.42) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> Опрема</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">Опрема за изнајмување</h1>
          <p class="lead max-w-2xl mt-4 hero-anim" data-d="3">Покрај кетерингот нудиме и дополнително изнајмување на опрема. Тука сме за да ви помогнеме да ја направите вашата прослава како што замислувате.</p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-[var(--ink)]">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-12 gap-12">
    
        <div class="lg:col-span-7 self-start">
          <span class="eyebrow reveal">Ценовник за изнајмување</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Опрема по<br>фер цени.</h2>
          <p class="lead mt-6 reveal" data-d="1">Изнајмуваме сè што е потребно за прослава на отворено или во затворен простор — од мебел до целосна организација на настанот:</p>

          <article id="oprema-cenovnik" class="menu-card p-6 md:p-8 mt-8 reveal" data-d="1">
            <div class="flex items-start justify-between gap-3">
              <div>
                <h3 class="menu-title font-display text-cream">Изнајмување опрема</h3>
                <span class="menu-group">Ценовник</span>
              </div>
              <button class="share-btn" data-share="Изнајмување опрема" aria-label="Сподели ценовник за опрема"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
            </div>
            <ul class="mt-6 border-t border-[var(--line-soft)]">
              <li v-for="(item, i) in equipment" :key="i" class="flex items-baseline gap-4 py-4 border-b border-[var(--line-soft)]">
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

          <p class="text-sm muted italic mt-6 reveal">* Целосна организација на секаков вид настани.</p>

          <p class="lead mt-8 reveal">За достапност и резервација на опрема, јавете се:</p>
          <div class="flex flex-wrap gap-4 mt-5 reveal" data-d="1">
            <a href="tel:+38978226005" class="btn btn-ghost"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> 078 226 005</a>
            <a href="tel:+38978410416" class="btn btn-ghost"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> 078 410 416</a>
          </div>
        </div>

    
        <div class="lg:col-span-5">
          <div class="card p-8 reveal" data-d="1">
            <h3 class="eyebrow">Партнери за декорација</h3>
            <p class="muted text-sm mt-3">Декорацијата и фотографијата ги обезбедуваме преку нашите проверени партнери:</p>
            <div class="mt-6 space-y-6">
              <div class="pb-6 border-b border-[var(--line-soft)]">
                <h4 class="font-display text-2xl text-cream">Декорации и китење</h4>
                <p class="muted text-sm mt-1">IR Creations</p>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-3">
                  <a href="tel:+389071664028" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> 071 664 028</a>
                  <a href="tel:+389071200863" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> 071 200 863</a>
                </div>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-2">
                  <a href="https://www.instagram.com/ir.creations.mk" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span> Instagram</a>
                  <a href="https://www.facebook.com/ir.creations.mk" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span> Facebook</a>
                </div>
              </div>
              <div>
                <h4 class="font-display text-2xl text-cream">Фото студио</h4>
                <p class="muted text-sm mt-1">Creative Photography</p>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-3">
                  <a href="tel:+389076266058" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> 076 266 058</a>
                </div>
                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-2">
                  <a href="https://www.instagram.com/creative.photographymk/" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span> Instagram</a>
                  <a href="https://www.facebook.com/creative.photographymk1" target="_blank" rel="noopener" class="link-gold inline-flex items-center gap-2"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span> Facebook</a>
                </div>
              </div>
            </div>
            <img src="/img/equip-05.jpg" alt="" class="w-full h-44 object-cover mt-8">
          </div>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-ink2 border-t border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="eyebrow reveal">Галерија</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Декорација & аранжмани</h2>
          <p class="lead mt-4 reveal" data-d="2">Инспирација од нашите изминати настани. Кликнете за поголем приказ.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
          <div class="gal-item aspect-[4/5] reveal" data-lb="/img/equip-01.jpg"><img src="/img/equip-01.jpg" alt="Маси и столчиња"><div class="gal-cap"><span class="text-sm text-cream font-medium">Маси и столчиња</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="1" data-lb="/img/equip-02.jpg"><img src="/img/equip-02.jpg" alt="Коњопои и шведска маса"><div class="gal-cap"><span class="text-sm text-cream font-medium">Коњопои и шведска маса</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="2" data-lb="/img/equip-03.jpg"><img src="/img/equip-03.jpg" alt="Декорација на двор за свадба"><div class="gal-cap"><span class="text-sm text-cream font-medium">Декорација на двор за свадба</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="3" data-lb="/img/equip-04.jpg"><img src="/img/equip-04.jpg" alt="Шведска маса и тенда"><div class="gal-cap"><span class="text-sm text-cream font-medium">Шведска маса и тенда</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-lb="/img/equip-05.jpg"><img src="/img/equip-05.jpg" alt="Невестинска маса"><div class="gal-cap"><span class="text-sm text-cream font-medium">Невестинска маса</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="1" data-lb="/img/equip-06.jpg"><img src="/img/equip-06.jpg" alt="Декорација за роденден"><div class="gal-cap"><span class="text-sm text-cream font-medium">Декорација за роденден</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="2" data-lb="/img/equip-07.jpg"><img src="/img/equip-07.jpg" alt="Сервирана округла маса"><div class="gal-cap"><span class="text-sm text-cream font-medium">Сервирана округла маса</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="3" data-lb="/img/equip-08.jpg"><img src="/img/equip-08.jpg" alt="Столчиња со китенки"><div class="gal-cap"><span class="text-sm text-cream font-medium">Столчиња со китенки</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-lb="/img/equip-09.jpg"><img src="/img/equip-09.jpg" alt="Декорација на маса"><div class="gal-cap"><span class="text-sm text-cream font-medium">Декорација на маса</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="1" data-lb="/img/equip-10.jpg"><img src="/img/equip-10.jpg" alt="Прием на гости"><div class="gal-cap"><span class="text-sm text-cream font-medium">Декорација за прием на гости</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="2" data-lb="/img/equip-11.jpg"><img src="/img/equip-11.jpg" alt="Венец за на врата"><div class="gal-cap"><span class="text-sm text-cream font-medium">Венец за на врата</span></div></div>
          <div class="gal-item aspect-[4/5] reveal" data-d="3" data-lb="/img/equip-12.jpg"><img src="/img/equip-12.jpg" alt="Декорирани маси со свежо цвеќе"><div class="gal-cap"><span class="text-sm text-cream font-medium">Декорирани маси со свежо цвеќе</span></div></div>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 overflow-hidden">
      <img src="/img/hero-3.jpg" alt="" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal">Ние ќе ја опремиме<br>вашата веселба.</h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">Кажете ни го вашиот настан — ние ќе се погрижиме за опремата и декорацијата.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2"><Link href="/contact" class="btn btn-gold">Контакт <span class="arr">→</span></Link><a href="tel:+38978226005" class="btn btn-ghost">078 226 005</a></div>
      </div>
    </section>
  </Layout>
</template>
