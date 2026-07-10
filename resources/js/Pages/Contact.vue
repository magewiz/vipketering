<script setup>
import { computed, ref } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Layout from '../Components/Layout.vue';
import { telHref } from '../lib/format';

const props = defineProps({
  page: { type: Object, required: true },
});

const c = computed(() => props.page.content ?? {});
const settings = computed(() => usePage().props.settings ?? {});
const contactPhones = computed(() => [
  { number: settings.value.phone_primary, label: settings.value.phone_primary_label },
  { number: settings.value.phone_secondary, label: settings.value.phone_secondary_label },
].filter((p) => p.number));

const sent = ref(false);
const form = useForm({
  name: '',
  phone: '',
  email: '',
  event_type: '',
  event_date: '',
  guests: '',
  message: '',
  website: '', // honeypot — must stay empty
});

function submitContact() {
  form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      sent.value = true;
      setTimeout(() => (sent.value = false), 6000);
    },
  });
}
</script>

<template>
  <Head :title="page.meta_title || 'Контакт'" />
  <Layout>
    <section class="dark-zone relative pt-[78px] overflow-hidden">
      <div class="relative h-[42vh] min-h-[340px] lg:h-[265px] lg:min-h-[265px] flex items-end">
        <img :src="c.hero.image" alt="" class="absolute inset-0 w-full h-full object-cover kenburns">
        <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(16,15,13,.6),rgba(16,15,13,.45) 45%,var(--ink))"></div>
        <div class="relative maxw w-full px-5 md:px-10 pb-12">
          <nav class="text-xs tracking-[.2em] uppercase text-cream/60 mb-4 hero-anim" data-d="1"><Link href="/" class="hover:text-[var(--gold-bright)]">Почетна</Link> <span class="text-[var(--gold)] mx-2">/</span> {{ c.hero.title }}</nav>
          <h1 class="font-display d2 hero-anim" data-d="2">{{ c.hero.title }}</h1>
          <p class="lead max-w-xl mt-4 hero-anim" data-d="3">{{ c.hero.lead }}</p>
        </div>
      </div>
    </section>


    <section class="py-16 md:py-24 bg-paper">
      <div class="maxw px-5 md:px-10 grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">

        <div class="reveal">
          <span class="eyebrow">{{ c.form.eyebrow }}</span>
          <h2 class="font-display d2 mt-4">{{ c.form.heading }}</h2>
          <p class="lead mt-4">{{ c.form.lead }}</p>
          <form @submit.prevent="submitContact" class="mt-9 space-y-7" autocomplete="off" novalidate>
            <!-- Honeypot: hidden from humans, ignored by screen readers; bots that fill it are dropped server-side -->
            <div aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden">
              <label>Веб-страница<input v-model="form.website" type="text" tabindex="-1" autocomplete="off"></label>
            </div>
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Име и презиме</label><input v-model="form.name" class="field" type="text" placeholder="Вашето име" autocomplete="off" required><p v-if="form.errors.name" class="text-[var(--gold-bright)] text-xs mt-1.5">{{ form.errors.name }}</p></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Телефон</label><input v-model="form.phone" class="field" type="tel" placeholder="07X XXX XXX" autocomplete="off" required><p v-if="form.errors.phone" class="text-[var(--gold-bright)] text-xs mt-1.5">{{ form.errors.phone }}</p></div>
            </div>
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Е-пошта</label><input v-model="form.email" class="field" type="email" placeholder="email@пример.com" autocomplete="off"><p v-if="form.errors.email" class="text-[var(--gold-bright)] text-xs mt-1.5">{{ form.errors.email }}</p></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Тип на настан</label>
                <select v-model="form.event_type" class="field" autocomplete="off" required>
                  <option value="" class="bg-[var(--paper)]">Изберете…</option>
                  <option v-for="t in c.form.event_types" :key="t" :value="t" class="bg-[var(--paper)]">{{ t }}</option>
                </select>
                <p v-if="form.errors.event_type" class="text-[var(--gold-bright)] text-xs mt-1.5">{{ form.errors.event_type }}</p>
              </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-7">
              <div><label class="eyebrow text-[.62rem] block mb-2">Датум</label><input v-model="form.event_date" class="field" type="date" autocomplete="off"></div>
              <div><label class="eyebrow text-[.62rem] block mb-2">Број на гости</label><input v-model="form.guests" class="field" type="number" min="1" placeholder="нпр. 120" autocomplete="off"></div>
            </div>
            <div><label class="eyebrow text-[.62rem] block mb-2">Порака</label><textarea v-model="form.message" class="field" placeholder="Раскажете ни за вашиот настан…" autocomplete="off"></textarea></div>
            <div class="flex flex-wrap items-center gap-4">
              <button type="submit" class="btn btn-gold w-full sm:w-auto" :disabled="form.processing">{{ form.processing ? 'Се испраќа…' : 'Испрати порака' }} <span class="arr">→</span></button>
              <p v-if="sent" class="text-[var(--gold-bright)] text-sm">Пораката е успешно испратена. Ви благодариме!</p>
            </div>
          </form>
        </div>


        <div class="reveal" data-d="1">
          <div class="bg-ink2 border border-[var(--line-soft)] p-8 lg:p-10">
            <h3 class="font-display text-3xl text-cream" v-html="c.aside.heading"></h3>
            <p class="lead mt-4">{{ c.aside.lead }}</p>
            <div class="flex flex-col gap-5 mt-7">
              <a v-for="p in contactPhones" :key="p.number" :href="telHref(p.number)" class="flex items-center gap-3 font-display text-3xl md:text-4xl text-cream hover:text-[var(--gold-bright)] transition"><span class="ico ico-gold text-[1.5rem]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span>{{ p.number }} <span v-if="p.label" class="muted text-base font-sans">· {{ p.label }}</span></a>
            </div>
            <div class="hairline opacity-40 my-7"></div>
            <div class="flex items-center gap-3">
              <a v-if="settings.facebook_url" :href="settings.facebook_url" target="_blank" rel="noopener" aria-label="Facebook" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span></a>
              <a v-if="settings.instagram_url" :href="settings.instagram_url" target="_blank" rel="noopener" aria-label="Instagram" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span></a>
              <span v-if="c.aside.social_note" class="muted text-sm ml-1">{{ c.aside.social_note }}</span>
            </div>
            <p v-if="settings.address" class="muted text-xs mt-5 flex items-center gap-2"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/></svg></span> {{ settings.address }}</p>
          </div>
        </div>
      </div>
    </section>
  </Layout>
</template>
