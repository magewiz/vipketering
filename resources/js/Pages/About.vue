<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
</script>

<template>
  <Head title="За Нас" />
  <Layout>
    <section class="relative pt-[78px] overflow-hidden">
      <div class="relative h-[46vh] min-h-[360px] lg:h-[210px] lg:min-h-[210px] flex items-end">
        <img src="/img/hero-3.jpg" alt="" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.65),rgba(16,15,13,.45) 50%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> За Нас</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">За Нас</h1>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-[var(--ink)]">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
          <img src="/img/about-vip.jpg" alt="VIP Catering — Најдобриот кетеринг во градот" class="w-full rounded-sm shadow-[0_30px_60px_-30px_rgba(0,0,0,.85)] reveal">
        </div>
        <div class="lg:col-span-7 space-y-5">
          <p class="lead reveal">Вип кетеринг постои за Вас, а нашата цел е да ги задоволиме нашите клиенти. Нашето мото е <span class="italic-accent text-[var(--gold-bright)]">„Let us do all the work“</span> — со тоа сакаме да кажеме да не се грижите за ништо, него да бидете гости на вашата веселба. Оставете ние да се погрижиме за сè.</p>
          <p class="lead reveal" data-d="1">Вип Кетеринг располага со разноврсни мениа за храна, исто така и посни мениа, секогаш расположени за измени на истите во зависност од вашата потреба.</p>
          <p class="lead reveal" data-d="2">Неуморно се трудиме секојдневно да внесуваме новитети на услугите што ги нудиме, така што ќе го зголемиме бројот на задоволни клиенти.</p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-ink2 border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="max-w-2xl mb-14">
          <span class="eyebrow reveal">Нашите услуги</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Нудиме секаков вид кетеринг.</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-x-12">
          <ul class="divide-y divide-[var(--line-soft)]">
            <li class="flex items-center gap-5 py-6 reveal"><span class="card-num">01</span><div><h3 class="font-display text-2xl text-cream">Outdoor настани</h3><p class="text-sm muted mt-1">Со секаков вид на услуга.</p></div></li>
            <li class="flex items-center gap-5 py-6 reveal" data-d="1"><span class="card-num">02</span><div><h3 class="font-display text-2xl text-cream">Свадбени мениа</h3><p class="text-sm muted mt-1">Шведска маса и редење на храна по маса.</p></div></li>
            <li class="flex items-center gap-5 py-6 reveal" data-d="2"><span class="card-num">03</span><div><h3 class="font-display text-2xl text-cream">Домашен кетеринг</h3><p class="text-sm muted mt-1">Шведска маса или славско поставување.</p></div></li>
          </ul>
          <ul class="divide-y divide-[var(--line-soft)]">
            <li class="flex items-center gap-5 py-6 reveal"><span class="card-num">04</span><div><h3 class="font-display text-2xl text-cream">Коктел кетеринг</h3><p class="text-sm muted mt-1">Шведска маса или славско поставување.</p></div></li>
            <li class="flex items-center gap-5 py-6 reveal" data-d="1"><span class="card-num">05</span><div><h3 class="font-display text-2xl text-cream">Кетеринг за деца</h3><p class="text-sm muted mt-1">Во игротека или домашни услови.</p></div></li>
            <li class="flex items-center gap-5 py-6 reveal" data-d="2"><span class="card-num">06</span><div><h3 class="font-display text-2xl text-cream">Оброци за компании</h3><p class="text-sm muted mt-1">Порции со топол оброк за компании.</p></div></li>
          </ul>
        </div>
      </div>
    </section>


    <section class="py-24 md:py-32 bg-[var(--ink)]">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-16 items-center">
        <div class="grid grid-cols-2 gap-4 reveal">
          <img src="/img/feature-2.jpg" alt="" class="w-full aspect-[3/4] object-cover">
          <img src="/img/feature-1.jpg" alt="" class="w-full aspect-[3/4] object-cover translate-y-8">
          <img src="/img/welcome.jpg" alt="" class="w-full aspect-[16/10] object-cover col-span-2">
        </div>
        <div>
          <span class="eyebrow reveal">Зошто токму ние</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Четири причини да<br>ни верувате.</h2>
          <div class="mt-8 space-y-px">
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="1"><span class="index-num">01</span><p class="lead self-center">За вашата веселба да биде незаборавна нудиме и подготовка на разновидни коктели во склоп со подвижен бар и професионално приготвен кетеринг со инвентар.</p></div>
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="2"><span class="index-num">02</span><p class="lead self-center">Со ангажманот добивате сервирана, декорирана и свежо приготвена храна и пијалоци, комплетен инвентар — маси, чаршафи, тањири, чаши и прибор, плус дополнителна опрема.</p></div>
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="3"><span class="index-num">03</span><p class="lead self-center">Во изминатиов период ВИП Кетеринг може да се пофали со добра соработка и взаемна доверба на компании присутни на нашиот пазар.</p></div>
            <div class="flex gap-6 py-6 border-y border-[var(--line-soft)] reveal" data-d="4"><span class="index-num">04</span><p class="lead self-center">Уживајте во вашите најубави моменти и оставете на нас да се погрижиме за останатото!</p></div>
          </div>
        </div>
      </div>
    </section>


    <section class="bg-ink2 py-20 border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10 grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-6">
        <div class="text-center reveal" data-d="1"><div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="600">0</span>+</div><div class="hairline w-12 mx-auto my-4 opacity-60"></div><p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Задоволни клиенти</p></div>
        <div class="text-center reveal" data-d="2"><div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="1000">0</span>+</div><div class="hairline w-12 mx-auto my-4 opacity-60"></div><p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Изработени настани</p></div>
        <div class="text-center reveal" data-d="3"><div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="5000">0</span>+</div><div class="hairline w-12 mx-auto my-4 opacity-60"></div><p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Зготвени оброци</p></div>
        <div class="text-center reveal" data-d="4"><div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="5">0</span><span class="text-3xl align-top">★</span></div><div class="hairline w-12 mx-auto my-4 opacity-60"></div><p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Рејтинг на клиентите</p></div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 overflow-hidden">
      <img src="/img/hero-1.jpg" alt="" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal">Бидете гости на<br>својата забава.</h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">Контактирајте нè денес и резервирајте го вашиот термин.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2">
          <Link href="/contact" class="btn btn-gold">Контакт <span class="arr">→</span></Link>
          <Link href="/menia" class="btn btn-ghost">Разгледај мениа</Link>
        </div>
      </div>
    </section>
  </Layout>
</template>
