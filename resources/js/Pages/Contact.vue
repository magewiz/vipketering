<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
</script>

<template>
  <Head title="Контакт" />
  <Layout>
    <section class="relative pt-[78px] overflow-hidden">
      <div class="relative h-[42vh] min-h-[340px] lg:h-[265px] lg:min-h-[265px] flex items-end">
        <img src="/img/hero-2.jpg" alt="" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.6),rgba(16,15,13,.45) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> Контакт</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">Контакт</h1>
          <p class="lead max-w-xl mt-4 hero-anim" data-d="3">Овде сме да ви помогнеме! Имате прашања за нашите услуги? Контактирајте нè денес.</p>
        </div>
      </div>
    </section>


    <section class="py-16 md:py-24 bg-[var(--ink)]">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
    
        <div class="reveal">
          <span class="eyebrow">Резервирај</span>
          <h2 class="font-display d2 mt-4">Испратете ни порака</h2>
          <p class="lead mt-4">Пополнете ги деталите за вашиот настан и ќе ве контактираме во најкус можен рок.</p>
          <form data-form class="mt-9 space-y-7">
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Име и презиме</label><input class="field" type="text" placeholder="Вашето име" required></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Телефон</label><input class="field" type="tel" placeholder="07X XXX XXX" required></div>
            </div>
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Е-пошта</label><input class="field" type="email" placeholder="email@пример.com"></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Тип на настан</label>
                <select class="field" required>
                  <option value="" class="bg-[var(--ink)]">Изберете…</option>
                  <option class="bg-[var(--ink)]">Свадба</option>
                  <option class="bg-[var(--ink)]">Роденден</option>
                  <option class="bg-[var(--ink)]">Коктел / прием</option>
                  <option class="bg-[var(--ink)]">Корпоративен настан</option>
                  <option class="bg-[var(--ink)]">Друго</option>
                </select>
              </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Датум</label><input class="field" type="date"></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Број на гости</label><input class="field" type="number" min="1" placeholder="нпр. 120"></div>
            </div>
            <div><label class="eyebrow text-[.62rem] block mb-2">Порака</label><textarea class="field" placeholder="Раскажете ни за вашиот настан…"></textarea></div>
            <button type="submit" class="btn btn-gold w-full sm:w-auto">Испрати порака <span class="arr">→</span></button>
          </form>
        </div>

    
        <div class="reveal" data-d="1">
          <div class="bg-ink2 border border-[var(--line-soft)] p-8 lg:p-10">
            <h3 class="font-display text-3xl text-cream">Бидете гостин на<br>својата забава.</h3>
            <p class="lead mt-4">Јавете се директно за брза резервација:</p>
            <div class="flex flex-col gap-5 mt-7">
              <a href="tel:+38978226005" class="flex items-center gap-3 font-display text-3xl md:text-4xl text-cream hover:text-[var(--gold-bright)] transition"><span class="ico ico-gold text-[1.5rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>078 226 005 <span class="muted text-base font-sans">· Димитар</span></a>
              <a href="tel:+38978410416" class="flex items-center gap-3 font-display text-3xl md:text-4xl text-cream hover:text-[var(--gold-bright)] transition"><span class="ico ico-gold text-[1.5rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>078 410 416 <span class="muted text-base font-sans">· Мартин</span></a>
            </div>
            <div class="hairline opacity-40 my-7"></div>
            <div class="flex items-center gap-3">
              <a href="https://www.facebook.com/vipketering" target="_blank" rel="noopener" aria-label="Facebook" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span></a>
              <a href="https://www.instagram.com/vipketering" target="_blank" rel="noopener" aria-label="Instagram" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span></a>
              <span class="muted text-sm ml-1">Следете нè на Facebook и Instagram</span>
            </div>
            <p class="muted text-xs mt-5 flex items-center gap-2"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/></svg></span> Скопје 1000, Македонија</p>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
