<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
</script>

<template>
  <Head title="" />
  <Layout>
    <section class="relative min-h-screen flex items-end overflow-hidden">
      <div class="absolute inset-0">
        <img src="/img/hero-1.jpg" alt="" class="w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.72) 0%,rgba(16,15,13,.30) 40%,rgba(16,15,13,.55) 75%,var(--ink) 100%)"></div>
        <div class="absolute inset-0" style="background:radial-gradient(120% 80% at 0% 100%,rgba(16,15,13,.85),transparent 60%)"></div>
      </div>

      <div class="relative maxw w-full px-5 md:px-10 pb-16 md:pb-24 pt-32">
        <div class="hero-anim" data-d="1">
          <span class="eyebrow">Кетеринг &nbsp;·&nbsp; Скопје, Македонија</span>
        </div>
        <h1 class="font-display d1 mt-6 max-w-5xl hero-anim" data-d="2">
          Оставете <span class="italic-accent text-[var(--gold-bright)]">нас</span> да се<br>погрижиме за сè.
        </h1>
        <p class="lead max-w-xl mt-7 hero-anim" data-d="3">
          Професионален кетеринг за свадби, прослави и компании. Свежо приготвена храна, целосна организација и беспрекорна декорација — а вие бидете гости на својата веселба.
        </p>
        <div class="flex flex-wrap items-center gap-4 mt-10 hero-anim" data-d="4">
          <Link href="/contact" class="btn btn-gold">Резервирај термин <span class="arr">→</span></Link>
          <Link href="/menia" class="btn btn-ghost">Разгледај мениа</Link>
        </div>

        <div class="flex flex-wrap items-center gap-x-8 gap-y-3 mt-12 hero-anim" data-d="5">
          <a href="tel:+38978226005" class="font-display text-2xl md:text-3xl text-cream hover:text-[var(--gold-bright)] transition flex items-center gap-3"><span class="ico ico-gold text-[1.4rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>078 226 005</a>
          <a href="tel:+38978410416" class="font-display text-2xl md:text-3xl text-cream hover:text-[var(--gold-bright)] transition flex items-center gap-3"><span class="ico ico-gold text-[1.4rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>078 410 416</a>
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
          <img src="/img/welcome.jpg" alt="VIP Ketering буфет" class="relative w-full aspect-[4/5] object-cover shadow-2xl">
          <div class="absolute -bottom-6 -right-4 md:-right-8 bg-[var(--ink)] text-cream px-7 py-5 shadow-xl">
            <span class="font-display text-4xl text-[var(--gold-bright)] leading-none">15+</span>
            <span class="block text-[.7rem] tracking-[.22em] uppercase mt-1 text-cream/70">години искуство</span>
          </div>
        </div>
        <div>
          <span class="eyebrow reveal">VIP Ketering — Професионална услуга</span>
          <h2 class="font-display d2 mt-5 reveal" data-d="1">Секогаш вкусно,<br>секогаш свежо.</h2>
          <p class="lead mt-7 reveal" data-d="2">
            Вип Кетеринг постои за Вас, а нашата цел е да ги задоволиме нашите клиенти. Нашето мото <span class="italic-accent text-[var(--gold-deep)]">„Let us do all the work“</span> значи дека не треба да се грижите за ништо — оставете ние да се погрижиме за сè.
          </p>
          <p class="lead mt-4 reveal" data-d="2">
            Неуморно се трудиме секојдневно да внесуваме новитети во услугите што ги нудиме, со што го зголемуваме бројот на задоволни клиенти.
          </p>
          <div class="grid sm:grid-cols-3 gap-6 mt-10">
            <div class="reveal" data-d="1"><span class="card-num">✦</span><h3 class="font-semibold mt-2">Свежо & вкусно</h3><p class="text-sm muted mt-1">Храна приготвена со внимание на детал.</p></div>
            <div class="reveal" data-d="2"><span class="card-num">✦</span><h3 class="font-semibold mt-2">Целосна организација</h3><p class="text-sm muted mt-1">Од менито до последната декорација.</p></div>
            <div class="reveal" data-d="3"><span class="card-num">✦</span><h3 class="font-semibold mt-2">Посветен тим</h3><p class="text-sm muted mt-1">Сервирање и апсервирање со сопствен инвентар.</p></div>
          </div>
        </div>
      </div>
    </section>


    <section class="relative bg-[var(--ink)] py-20 md:py-24 border-y border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10 grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-6">
        <div class="text-center reveal" data-d="1">
          <div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="600">0</span><span>+</span></div>
          <div class="hairline w-12 mx-auto my-4 opacity-60"></div>
          <p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Задоволни клиенти</p>
        </div>
        <div class="text-center reveal" data-d="2">
          <div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="1000">0</span><span>+</span></div>
          <div class="hairline w-12 mx-auto my-4 opacity-60"></div>
          <p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Изработени настани</p>
        </div>
        <div class="text-center reveal" data-d="3">
          <div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="5000">0</span><span>+</span></div>
          <div class="hairline w-12 mx-auto my-4 opacity-60"></div>
          <p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Зготвени оброци</p>
        </div>
        <div class="text-center reveal" data-d="4">
          <div class="font-display text-5xl md:text-6xl text-[var(--gold-bright)]"><span data-count="5">0</span><span class="text-3xl align-top">★</span></div>
          <div class="hairline w-12 mx-auto my-4 opacity-60"></div>
          <p class="text-[.72rem] tracking-[.24em] uppercase text-cream/65">Рејтинг на клиентите</p>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-ink2 overflow-hidden">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16">
          <div>
            <span class="eyebrow reveal">Што нудиме</span>
            <h2 class="font-display d2 mt-4 reveal" data-d="1">Кетеринг за секоја<br>пригода.</h2>
          </div>
          <p class="lead max-w-sm reveal" data-d="2">Нудиме секаков вид кетеринг — секогаш расположени за измени на менијата според вашата потреба.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-[var(--line-soft)] border border-[var(--line-soft)]">
      
          <article class="svc reveal" data-d="1">
            <span class="card-num">01</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Outdoor настани</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Кетеринг на отворено со секаков вид услуга — од подготовка до сервирање на локација.</p>
          </article>
      
          <article class="svc reveal" data-d="2">
            <span class="card-num">02</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Свадбени мениа</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Шведска маса или редење на храна по маса — незаборавно искуство за вашиот најважен ден.</p>
          </article>
      
          <article class="svc reveal" data-d="3">
            <span class="card-num">03</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Домашен кетеринг</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Шведска маса или славско поставување во вашиот дом, со целосен инвентар.</p>
          </article>
      
          <article class="svc reveal" data-d="1">
            <span class="card-num">04</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Коктел кетеринг</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Коктели и канапеа со подвижен бар и професионално приготвен кетеринг со инвентар.</p>
          </article>
      
          <article class="svc reveal" data-d="2">
            <span class="card-num">05</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Кетеринг за деца</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Во игротека или домашни услови — забавно и вкусно мени прилагодено за најмладите.</p>
          </article>
      
          <article class="svc reveal" data-d="3">
            <span class="card-num">06</span>
            <h3 class="font-display text-2xl mt-4 text-cream">Оброци за компании</h3>
            <p class="text-sm muted mt-3 leading-relaxed">Порции со топол оброк за компании — навремена достава и постојан квалитет.</p>
          </article>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-[var(--ink)] overflow-hidden">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-16 items-center">
        <div class="order-2 lg:order-1">
          <span class="eyebrow reveal">Зошто токму ние</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Доверба изградена<br>настан по настан.</h2>
          <div class="mt-10 space-y-px">
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="1">
              <span class="index-num">01</span>
              <p class="lead self-center">За вашата веселба да биде незаборавна нудиме и подготовка на разновидни коктели во склоп со подвижен бар и професионално приготвен кетеринг со инвентар.</p>
            </div>
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="2">
              <span class="index-num">02</span>
              <p class="lead self-center">Со ангажманот добивате сервирана, декорирана и свежо приготвена храна и пијалоци, комплетен инвентар — маси, чаршафи, тањири, чаши и прибор.</p>
            </div>
            <div class="flex gap-6 py-6 border-t border-[var(--line-soft)] reveal" data-d="3">
              <span class="index-num">03</span>
              <p class="lead self-center">ВИП Кетеринг се пофали со долгогодишна соработка и взаемна доверба со компании присутни на нашиот пазар.</p>
            </div>
            <div class="flex gap-6 py-6 border-y border-[var(--line-soft)] reveal" data-d="4">
              <span class="index-num">04</span>
              <p class="lead self-center">Уживајте во вашите најубави моменти и оставете на нас да се погрижиме за останатото!</p>
            </div>
          </div>
        </div>
        <div class="order-1 lg:order-2 grid grid-cols-2 gap-4 reveal" data-d="2">
          <img src="/img/feature-1.jpg" alt="" class="w-full aspect-[3/4] object-cover translate-y-6">
          <img src="/img/feature-2.jpg" alt="" class="w-full aspect-[3/4] object-cover">
          <img src="/img/feature-3.jpg" alt="" class="w-full aspect-[4/3] object-cover col-span-2">
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 bg-ink2">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
          <div>
            <span class="eyebrow reveal">Од нашата кујна</span>
            <h2 class="font-display d2 mt-4 reveal" data-d="1">Вкус што се памети.</h2>
          </div>
          <Link href="/menia" class="btn btn-ghost self-start reveal" data-d="2">Сите мениа <span class="arr">→</span></Link>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
          <div class="gal-item aspect-square reveal" data-d="1"><img src="/img/food-01.jpg" alt=""></div>
          <div class="gal-item aspect-square reveal md:mt-8" data-d="2"><img src="/img/food-05.jpg" alt=""></div>
          <div class="gal-item aspect-square reveal" data-d="3"><img src="/img/food-08.jpg" alt=""></div>
          <div class="gal-item aspect-square reveal md:mt-8" data-d="4"><img src="/img/food-11.jpg" alt=""></div>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-36 overflow-hidden">
      <img src="/img/hero-2.jpg" alt="" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.78),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <span class="eyebrow reveal">Резервирај</span>
        <h2 class="font-display d1 mt-5 reveal" data-d="1">Бидете гости на<br>својата забава.</h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="2">Секогаш се грижиме за целосна организација на вашиот настан. Контактирајте нè и резервирајте го вашиот термин.</p>
        <div class="flex flex-wrap justify-center items-center gap-5 mt-10 reveal" data-d="3">
          <a href="tel:+38978226005" class="btn btn-gold">078 226 005</a>
          <a href="tel:+38978410416" class="btn btn-ghost">078 410 416</a>
        </div>
      </div>
    </section>
  </Layout>
</template>
