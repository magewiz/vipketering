<script setup>
import { ref, computed, onMounted, onBeforeUnmount, nextTick, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { initEffects } from '../effects';
import { telHref } from '../lib/format';

const page = usePage();
const settings = computed(() => page.props.settings ?? {});
const path = computed(() => page.url.split('?')[0].replace(/\/$/, '') || '/');
const isActive = (p) => path.value === p;
const alwaysSolid = computed(() => path.value !== '/');

// The nav renders the logo at ~40px — use the small variant for the default
// logo so we don't ship the 512px file; admin-uploaded logos are used as-is.
const navLogo = computed(() => {
    const logo = settings.value.logo || '/img/logo-vip.png';
    return logo === '/img/logo-vip.png' ? '/img/logo-vip-96.png' : logo;
});

const scrolled = ref(false);
const menuOpen = ref(false);

const onScroll = () => { scrolled.value = alwaysSolid.value || window.scrollY > 40; };

const nav = [
    { label: 'Почетна', href: '/' },
    { label: 'За Нас', href: '/about' },
    { label: 'Мениа', href: '/menia' },
    { label: 'Опрема', href: '/oprema' },
    { label: 'Контакт', href: '/contact' },
];

function openMenu() { menuOpen.value = true; document.body.style.overflow = 'hidden'; }
function closeMenu() { menuOpen.value = false; document.body.style.overflow = ''; }

onMounted(() => {
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    nextTick(() => initEffects(document));
});
onBeforeUnmount(() => window.removeEventListener('scroll', onScroll));
watch(path, () => { closeMenu(); onScroll(); });

const year = new Date().getFullYear();
</script>

<template>
    <header class="nav" :class="{ scrolled: scrolled }">
        <div class="maxw px-5 md:px-10 h-[78px] flex items-center justify-between">
            <Link href="/" class="flex items-center gap-3">
                <span class="logo-badge w-12 h-12 md:w-[52px] md:h-[52px]"><img :src="navLogo" :alt="settings.brand_name" width="96" height="96" class="w-9 md:w-10 h-auto"></span>
                <span class="leading-none">
                    <span class="wordmark text-xl md:text-2xl text-cream">{{ settings.brand_name }}</span>
                    <span v-if="settings.tagline" class="block eyebrow text-[.58rem] mt-1" style="letter-spacing:.32em">{{ settings.tagline }}</span>
                </span>
            </Link>
            <nav class="hidden lg:flex items-center gap-9">
                <Link v-for="l in nav" :key="l.href" :href="l.href" class="nav-link" :class="{ active: isActive(l.href) }">{{ l.label }}</Link>
            </nav>
            <div class="flex items-center gap-4">
                <a v-if="settings.phone_primary" :href="telHref(settings.phone_primary)" class="hidden xl:flex items-center gap-2 text-sm text-cream/80 hover:text-[var(--gold-bright)] transition">
                    <span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ settings.phone_primary }}
                </a>
                <Link href="/contact" class="btn btn-gold nav-cta !py-3 !px-6">Резервирај</Link>
                <button @click="openMenu" class="burger lg:hidden" aria-label="Отвори мени"><span></span></button>
            </div>
        </div>
    </header>

    <!-- mobile menu -->
    <div class="mobile-menu" :class="{ open: menuOpen }">
        <div class="flex items-center justify-between px-5 h-[78px] border-b border-[var(--line-soft)]">
            <Link href="/" @click="closeMenu" class="flex items-center gap-3"><span class="logo-badge w-12 h-12 md:w-[52px] md:h-[52px]"><img :src="navLogo" :alt="settings.brand_name" width="96" height="96" class="w-9 md:w-10 h-auto"></span><span class="leading-none"><span class="wordmark text-xl md:text-2xl text-cream">{{ settings.brand_name }}</span><span v-if="settings.tagline" class="block eyebrow text-[.58rem] mt-1" style="letter-spacing:.32em">{{ settings.tagline }}</span></span></Link>
            <button @click="closeMenu" class="w-11 h-11 grid place-items-center rounded-sm border border-[var(--line-soft)] text-3xl leading-none text-[var(--gold-bright)] hover:border-[var(--gold)] transition" aria-label="Затвори">&times;</button>
        </div>
        <nav class="mm-nav flex-1 flex flex-col justify-center px-6">
            <Link v-for="l in nav" :key="l.href" :href="l.href" @click="closeMenu">{{ l.label }}</Link>
        </nav>
        <div class="px-6 pb-9">
            <Link href="/contact" @click="closeMenu" class="btn btn-gold w-full justify-center !py-4 mb-6">Резервирај термин</Link>
            <div class="grid grid-cols-2 gap-3">
                <a v-if="settings.phone_primary" :href="telHref(settings.phone_primary)" class="flex items-center gap-2 text-[var(--gold-bright)] font-display text-xl"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ settings.phone_primary }}</a>
                <a v-if="settings.phone_secondary" :href="telHref(settings.phone_secondary)" class="flex items-center gap-2 text-[var(--gold-bright)] font-display text-xl"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> {{ settings.phone_secondary }}</a>
            </div>
            <div class="flex items-center gap-3 mt-6 pt-6 border-t border-[var(--line-soft)]">
                <a v-if="settings.facebook_url" :href="settings.facebook_url" target="_blank" rel="noopener" aria-label="Facebook" class="ico-box w-10 h-10"><span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span></a>
                <a v-if="settings.instagram_url" :href="settings.instagram_url" target="_blank" rel="noopener" aria-label="Instagram" class="ico-box w-10 h-10"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span></a>
                <a v-if="settings.email" :href="`mailto:${settings.email}`" class="text-sm muted ml-auto hover:text-[var(--gold-bright)] transition">{{ settings.email }}</a>
            </div>
        </div>
    </div>

    <main>
        <slot />
    </main>

    <!-- footer -->
    <footer class="dark-zone bg-[var(--ink)] pt-20 pb-8 border-t border-[var(--line-soft)]">
        <div class="maxw px-5 md:px-10">
            <div class="grid md:grid-cols-12 gap-12 pb-14">
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3"><span class="logo-badge w-14 h-14"><img :src="navLogo" class="w-11 h-auto" width="96" height="96" loading="lazy" :alt="settings.brand_name"></span><span class="wordmark text-2xl">{{ settings.brand_name }}</span></div>
                    <p class="lead mt-6 max-w-sm">Професионален кетеринг во Скопје. Оставете ние да се погрижиме за сè — а вие уживајте во вашите најубави моменти.</p>
                    <p v-if="settings.tagline" class="italic-accent text-[var(--gold)] text-xl mt-5">{{ settings.tagline }}.</p>
                </div>
                <div class="md:col-span-3">
                    <h4 class="eyebrow mb-5">Навигација</h4>
                    <ul class="space-y-3 text-cream/75">
                        <li v-for="l in nav" :key="l.href"><Link :href="l.href" class="hover:text-[var(--gold-bright)]">{{ l.label }}</Link></li>
                    </ul>
                </div>
                <div class="md:col-span-4">
                    <h4 class="eyebrow mb-5">Контакт</h4>
                    <ul class="space-y-3 text-cream/75">
                        <li v-if="settings.phone_primary" class="flex items-center gap-3"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> <a :href="telHref(settings.phone_primary)" class="hover:text-[var(--gold-bright)]">{{ settings.phone_primary }}</a></li>
                        <li v-if="settings.phone_secondary" class="flex items-center gap-3"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3.5h3l1.4 4.6-2 1.4a12 12 0 0 0 5.1 5.1l1.4-2 4.6 1.4v3a2 2 0 0 1-2.1 2A16.4 16.4 0 0 1 4.5 5.6a2 2 0 0 1 2-2.1Z"/></svg></span> <a :href="telHref(settings.phone_secondary)" class="hover:text-[var(--gold-bright)]">{{ settings.phone_secondary }}</a></li>
                        <li v-if="settings.email" class="flex items-center gap-3"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path d="M4.2 7.2 12 12.4l7.8-5.2"/></svg></span> <a :href="`mailto:${settings.email}`" class="hover:text-[var(--gold-bright)]">{{ settings.email }}</a></li>
                        <li v-if="settings.address" class="flex items-center gap-3"><span class="ico ico-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/><circle cx="12" cy="10" r="2.4"/></svg></span> {{ settings.address }}</li>
                    </ul>
                    <div class="flex gap-3 mt-6">
                        <a v-if="settings.facebook_url" :href="settings.facebook_url" target="_blank" rel="noopener" aria-label="Facebook" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.6 21v-7.1h2.4l.4-2.8h-2.8V9.3c0-.8.2-1.4 1.4-1.4h1.5V5.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.7 1.3-3.7 3.8v2h-2.4v2.8h2.4V21h3Z"/></svg></span></a>
                        <a v-if="settings.instagram_url" :href="settings.instagram_url" target="_blank" rel="noopener" aria-label="Instagram" class="ico-box"><span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3.6" y="3.6" width="16.8" height="16.8" rx="4.6"/><circle cx="12" cy="12" r="3.5"/><circle cx="16.9" cy="7.1" r="1.05" fill="currentColor" stroke="none"/></svg></span></a>
                    </div>
                </div>
            </div>
            <div class="hairline opacity-40"></div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-3 pt-6 text-xs text-[var(--muted)]">
                <p>© {{ year }} {{ settings.brand_name }}. Сите права задржани.</p>
                <p class="tracking-[.2em] uppercase">Скопје · Македонија</p>
            </div>
        </div>
    </footer>

    <!-- lightbox -->
    <div class="lb"><button class="lb-close" data-lb-close>&times;</button><button class="lb-nav left-2 md:left-6" data-lb-prev>‹</button><figure class="lb-figure"><img src="" alt=""><figcaption class="lb-cap"></figcaption></figure><button class="lb-nav right-2 md:right-6" data-lb-next>›</button></div>
</template>
