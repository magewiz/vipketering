<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import MenuIncluded from '../Components/MenuIncluded.vue';
</script>

<template>
  <Head title="Мениа" />
  <Layout>
    <section class="relative pt-[78px] overflow-hidden">
      <div class="relative h-[52vh] min-h-[400px] lg:h-[262px] lg:min-h-[262px] flex items-end">
        <img src="/img/menia-cover.jpg" alt="" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.6),rgba(16,15,13,.4) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> Мениа</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">Нашите Мениа</h1>
          <p class="lead max-w-xl mt-4 hero-anim" data-d="3">Разновидни мениа за храна и посни мениа — секогаш расположени за измени според вашата потреба.</p>
        </div>
      </div>
    </section>


    <section class="py-20 md:py-28 bg-[var(--ink)]">
      <div class="maxw px-5 md:px-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14">
          <div><span class="eyebrow reveal">Шведска маса</span><h2 class="font-display d2 mt-4 reveal" data-d="1">Мениа по особа.</h2></div>
          <p class="lead max-w-sm reveal" data-d="2">Цените се по особа. Секое мени е целосно прилагодливо — менувајте го составот според вашиот вкус и бројот на гости.</p>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
          <article id="meni-1" class="menu-card p-6 md:p-7 reveal" data-d="1">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени 1</h3><span class="menu-group">Шведска маса</span></div>
        <button class="share-btn" data-share="Мени 1" data-price="550 ден." aria-label="Сподели Мени 1"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">550</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Мешана салата</b><i>зелка бела, зелка црвена, марула, морков, цвекло, краставица, домат</i></div><div class="menu-dish"><b>Шопска салата</b><i>домат, краставица, кромид, овчо сирење</i></div><div class="menu-dish"><b>Крем салати</b><i>урнебес, руска</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, пилешко филе, мартадела, чајна, св. шунка, пилешки гради</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кашкавал, тиквички, крокети, кромид</i></div><div class="menu-dish"><b>Тортиљи полнети со пилешко</b></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article><article id="meni-2" class="menu-card p-6 md:p-7 reveal" data-d="2">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени 2</h3><span class="menu-group">Шведска маса</span></div>
        <button class="share-btn" data-share="Мени 2" data-price="600 ден." aria-label="Сподели Мени 2"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">600</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Капрезе салата</b><i>домат, моцарела, босилок</i></div><div class="menu-dish"><b>Грчка салата</b><i>домат, краставица, овчо сирење, кромид, маслинки</i></div><div class="menu-dish"><b>Крем салати</b><i>пилешка, урнебес</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, чајна, голд филе, св. пршута, кашкавал</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кромид, крокети, кашкавал</i></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Банички со сирење</b></div><div class="menu-dish"><b>Тортиљи полнети со пилешко</b></div><div class="menu-dish"><b>Ситни колачи и сезонско овошје</b></div></div>
      <MenuIncluded />
    </article><article id="meni-3" class="menu-card p-6 md:p-7 reveal" data-d="3">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени 3</h3><span class="menu-group">Шведска маса</span></div>
        <button class="share-btn" data-share="Мени 3" data-price="750 ден." aria-label="Сподели Мени 3"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">750</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Цезар салата</b><i>марула, пилешко, кубети, пармезан, дресинг</i></div><div class="menu-dish"><b>Шопска салата</b><i>домат, краставица, кромид, овчо сирење</i></div><div class="menu-dish"><b>Крем салати</b><i>урнебес, пилешка</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, голд филе, чајна, свинска пршута, кашкавал, овчо сирење</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кашкавал, тиквички, крокети, кромид</i></div><div class="menu-dish"><b>Месо во купка</b><i>свински и пилешки ражничи, свинско каре, свинско филе, свински увијач, плескавица, пилешки стек, свежи печурки на жар</i></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Банички со сирење</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article><article id="meni-4" class="menu-card p-6 md:p-7 reveal" data-d="1">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени 4</h3><span class="menu-group">Шведска маса</span></div>
        <button class="share-btn" data-share="Мени 4" data-price="950 ден." aria-label="Сподели Мени 4"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">950</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Рукола салата</b><i>марула, рукола, сушен домат, пармезан, дресинг</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>свинска пршута, телешка пршута, чаден свински врат, димена печеница, пилешко филе, елпозо чајна</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кашкавал, тиквички, крокети, кромид</i></div><div class="menu-dish"><b>Мешани сирења</b><i>димен кашкавал, рокфорт сирење, пармезан, галички кашкавал, кашкавал со билки, овчо бело сирење</i></div><div class="menu-dish"><b>Месо во купка</b><i>пилешки и свински ражнич, свински увијач, свинско филе, св. печење, пилешки стек, свежи печурки на жар</i></div><div class="menu-dish"><b>Повеќе видови на брускети</b></div><div class="menu-dish"><b>Тортиљи полнети со пилешко</b></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Банички со сирење</b></div><div class="menu-dish"><b>Премиум полнет тарт со овошје</b></div><div class="menu-dish"><b>Апетисани</b></div></div>
      <MenuIncluded />
    </article><article id="premium" class="menu-card p-6 md:p-7 reveal" data-d="2">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Премиум</h3><span class="menu-group">Шведска маса</span></div>
        <button class="share-btn" data-share="Премиум" data-price="1200 ден." aria-label="Сподели Премиум"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">1200</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Вип салата</b><i>марула, рукола, горгонзола, пармезан, суво овошје, дресинг</i></div><div class="menu-dish"><b>Капрезе салата</b><i>домат, моцарела, босилок</i></div><div class="menu-dish"><b>Крем салати</b><i>руска, пилешка, француска</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, чајна, свинска и телешка пршута, голд филе, панцета</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, тиквички, кашкавал, кајмак, моцарела</i></div><div class="menu-dish"><b>Мешани сирења</b><i>пармезан, рокфорт сирење, овчо сирење, кашкавал, димен кашкавал</i></div><div class="menu-dish"><b>Месо во купка</b><i>свински пафлак во фурна, јунешки бифтек таљата со фламбе сос, свински и пилешки увијачи, свински и пилешка ражничи, свинско филе, свежи печурки на жар, топчиња од мелено месо, пилешки стек</i></div><div class="menu-dish"><b>Повеќе видови на канапеи</b></div><div class="menu-dish"><b>Повеќе видови на брускети</b></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Банички со сирење</b></div><div class="menu-dish"><b>Ситни колачи и сезонско овошје</b></div><div class="menu-dish"><b>Апетисани</b></div></div>
      <MenuIncluded />
    </article>
        </div>

        <div class="mt-20 mb-14">
          <span class="eyebrow reveal">Свечени мениа</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">За секоја прилика.</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
          <article id="slava" class="menu-card p-6 md:p-7 reveal" data-d="1">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени за слава</h3><span class="menu-group">Свечени мениа</span></div>
        <button class="share-btn" data-share="Мени за слава" data-price="800 ден." aria-label="Сподели Мени за слава"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">800</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Македонска салата</b><i>домат, краставица, пиперка, кромид</i></div><div class="menu-dish"><b>Шеф салата</b><i>марула, домат, кашкавал, св. пршута, пармезан, дресинг</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, елпозо, чајна, св. пршута, голд филе, кашкавал, сирење</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кашкавал, тиквички, кромид, крокети</i></div><div class="menu-dish"><b>Месо</b><i>свинско печење, свинско каре, пилешки стек, плескавица, сланина на скара, печурки на жар</i></div><div class="menu-dish"><b>Гравче тавче</b></div><div class="menu-dish"><b>Сарма</b></div><div class="menu-dish"><b>Лепиња</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article><article id="rodenden" class="menu-card p-6 md:p-7 reveal" data-d="2">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени за роденден</h3><span class="menu-group">Свечени мениа</span></div>
        <button class="share-btn" data-share="Мени за роденден" data-price="550 ден." aria-label="Сподели Мени за роденден"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">550</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
      <p class="menu-note">+ Мени за деца — 150 ден./дете (мини пици, пилешки прсти, клуб сендвичиња)</p>
      <div class="mt-4"><div class="menu-dish"><b>Крем салати</b><i>пилешка и урнебес</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>св. пршута, димена печеница, св. врат, димено пилешко филе, кулен, бело овчо сирење</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, пилешки прсти, зденки, крокети, тиквички, кашкавал, кромид</i></div><div class="menu-dish"><b>Бургери</b></div><div class="menu-dish"><b>Кифлички</b></div><div class="menu-dish"><b>Мини банички</b></div></div>
      <MenuIncluded />
    </article><article id="mekici" class="menu-card p-6 md:p-7 reveal" data-d="3">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Мени за мекици</h3><span class="menu-group">Свечени мениа</span></div>
        <button class="share-btn" data-share="Мени за мекици" data-price="500 ден." aria-label="Сподели Мени за мекици"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">500</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Шопска салата</b><i>домат, краставица, кромид, овчо сирење</i></div><div class="menu-dish"><b>Крем салати</b><i>урнебес, пилешка</i></div><div class="menu-dish"><b>Ладен ордевер</b><i>кулен, печеница, св. врат, чајна, св. пршута, голд филе, пилешки гради</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, зденки, пилешки прсти, кашкавал, тиквички, крокети, кромид</i></div><div class="menu-dish"><b>Овчо бело сирење</b></div><div class="menu-dish"><b>Мекици</b></div><div class="menu-dish"><b>Мармалад</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article><article id="posno" class="menu-card p-6 md:p-7 reveal" data-d="1">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Посно мени</h3><span class="menu-group">Свечени мениа</span></div>
        <button class="share-btn" data-share="Посно мени" data-price="700 ден." aria-label="Сподели Посно мени"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">700</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Компир салата</b></div><div class="menu-dish"><b>Макарони салата со туна</b><i>макарони, туна, маслинки, мајонез</i></div><div class="menu-dish"><b>Туна салата</b><i>марула, пченка, туна, дресинг</i></div><div class="menu-dish"><b>Зеленчук на скара</b><i>тиквица, модар домат, домат, зелка, печурки</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, крокети, кромид, тиквички, кашкавал</i></div><div class="menu-dish"><b>Риба</b><i>Ослич и Пастрмка</i></div><div class="menu-dish"><b>Пинџур</b></div><div class="menu-dish"><b>Гравче тавче</b></div><div class="menu-dish"><b>Посна сарма</b></div><div class="menu-dish"><b>Кифлички</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article><article id="koktel" class="menu-card p-6 md:p-7 reveal" data-d="2">
      <div class="flex items-start justify-between gap-3">
        <div><h3 class="menu-title font-display text-cream">Коктел мени</h3><span class="menu-group">Свечени мениа</span></div>
        <button class="share-btn" data-share="Коктел мени" data-price="750 ден." aria-label="Сподели Коктел мени"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.1 10.9l7.8-4.4M8.1 13.1l7.8 4.4"/></svg></button>
      </div>
      <div class="flex items-end gap-1.5 mt-3"><span class="price-tag text-[3.1rem]">750</span><span class="price-unit text-base mb-2">ден.</span><span class="price-per text-xs mb-2 ml-1">/ особа</span></div>
  
      <div class="mt-4"><div class="menu-dish"><b>Тортиљи полнети со пилешко</b></div><div class="menu-dish"><b>Повеќе видови канапеи</b></div><div class="menu-dish"><b>Брускети</b><i>домат и босилек, топено сирење, фламбе сос, песто, туна</i></div><div class="menu-dish"><b>Паниран ордевер</b><i>пирошки, пилешки прсти, зденки, крокети, кромид, тиквички, кашкавал</i></div><div class="menu-dish"><b>Мешани сирења</b><i>димен кашкавал, рокфорт сирење, пармезан, галички кашкавал, кашкавал со билки, овчо бело сирење</i></div><div class="menu-dish"><b>Италијанска пршута</b></div><div class="menu-dish"><b>Полнети шампињони</b><i>песто, кашкавал, сланина</i></div><div class="menu-dish"><b>Мини ражничи</b><i>пилешки и свински</i></div><div class="menu-dish"><b>Медаљони</b><i>пилешки медаљони, медаљони од свинско каре</i></div><div class="menu-dish"><b>Бомбици од мелено месо со кашкавал</b></div><div class="menu-dish"><b>Лиснати кифли</b></div><div class="menu-dish"><b>Банички со сирење</b></div><div class="menu-dish"><b>Ситни колачи</b></div></div>
      <MenuIncluded />
    </article>
        </div>

        <p class="text-center text-sm muted mt-12 reveal">Сите мениа се ориентациони и прилагодливи. За точна понуда и достапност, <Link href="/contact" class="link-gold">контактирајте нè</Link>.</p>
      </div>
    </section>



    <section class="py-20 md:py-28 bg-ink2 border-t border-[var(--line-soft)]">
      <div class="maxw px-5 md:px-10">
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="eyebrow reveal">Галерија</span>
          <h2 class="font-display d2 mt-4 reveal" data-d="1">Дел од нашите специјалитети</h2>
          <p class="lead mt-4 reveal" data-d="2">Кликнете на фотографија за поголем приказ.</p>
        </div>
        <div class="columns-2 md:columns-3 lg:columns-4 gap-3 md:gap-4 [&>*]:mb-3 md:[&>*]:mb-4">
          <div class="gal-item reveal" data-lb="/img/food-01.jpg"><img src="/img/food-01.jpg" alt="" class="aspect-square"></div>
          <div class="gal-item reveal" data-d="1" data-lb="/img/food-02.jpg"><img src="/img/food-02.jpg" alt="" class="aspect-[3/4]"></div>
          <div class="gal-item reveal" data-d="2" data-lb="/img/food-03.jpg"><img src="/img/food-03.jpg" alt="" class="aspect-square"></div>
          <div class="gal-item reveal" data-d="3" data-lb="/img/food-04.jpg"><img src="/img/food-04.jpg" alt="" class="aspect-[4/5]"></div>
          <div class="gal-item reveal" data-lb="/img/food-05.jpg"><img src="/img/food-05.jpg" alt="" class="aspect-[3/4]"></div>
          <div class="gal-item reveal" data-d="1" data-lb="/img/food-06.jpg"><img src="/img/food-06.jpg" alt="" class="aspect-square"></div>
          <div class="gal-item reveal" data-d="2" data-lb="/img/food-07.jpg"><img src="/img/food-07.jpg" alt="" class="aspect-[4/5]"></div>
          <div class="gal-item reveal" data-d="3" data-lb="/img/food-08.jpg"><img src="/img/food-08.jpg" alt="" class="aspect-square"></div>
          <div class="gal-item reveal" data-lb="/img/food-09.jpg"><img src="/img/food-09.jpg" alt="" class="aspect-[3/4]"></div>
          <div class="gal-item reveal" data-d="1" data-lb="/img/food-10.jpg"><img src="/img/food-10.jpg" alt="" class="aspect-square"></div>
          <div class="gal-item reveal" data-d="2" data-lb="/img/food-11.jpg"><img src="/img/food-11.jpg" alt="" class="aspect-[4/5]"></div>
          <div class="gal-item reveal" data-d="3" data-lb="/img/food-12.jpg"><img src="/img/food-12.jpg" alt="" class="aspect-square"></div>
        </div>
      </div>
    </section>


    <section class="relative py-24 md:py-32 overflow-hidden">
      <img src="/img/hero-1.jpg" alt="" class="absolute inset-0 w-full h-full object-cover">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,var(--ink),rgba(16,15,13,.8),var(--ink))"></div>
      <div class="relative maxw px-5 md:px-10 text-center">
        <h2 class="font-display d1 reveal">Составете го вашето<br>совршено мени.</h2>
        <p class="lead max-w-xl mx-auto mt-6 reveal" data-d="1">Јавете се и заедно ќе ја создадеме понудата за вашиот настан.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-9 reveal" data-d="2"><a href="tel:+38978226005" class="btn btn-gold">078 226 005</a><Link href="/contact" class="btn btn-ghost">Контакт <span class="arr">→</span></Link></div>
      </div>
    </section>
  </Layout>
</template>
