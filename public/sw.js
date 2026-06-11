/* VIP Ketering — service worker */
const CACHE = 'vip-cache-v1';

self.addEventListener('install', () => self.skipWaiting());

self.addEventListener('activate', (event) => {
    event.waitUntil((async () => {
        const keys = await caches.keys();
        await Promise.all(keys.filter((k) => k !== CACHE).map((k) => caches.delete(k)));
        await self.clients.claim();
    })());
});

self.addEventListener('fetch', (event) => {
    const req = event.request;
    if (req.method !== 'GET') return;

    const url = new URL(req.url);
    if (url.origin !== self.location.origin) return; // ignore cross-origin (fonts/CDN)

    // Navigations: network-first, fall back to cache, then to home.
    if (req.mode === 'navigate') {
        event.respondWith((async () => {
            try {
                const net = await fetch(req);
                const cache = await caches.open(CACHE);
                cache.put(req, net.clone());
                return net;
            } catch (_) {
                return (await caches.match(req)) || (await caches.match('/')) || Response.error();
            }
        })());
        return;
    }

    // Static assets: stale-while-revalidate. Everything else (e.g. Inertia XHR): straight to network.
    const cacheable = ['style', 'script', 'image', 'font'].includes(req.destination)
        || url.pathname.startsWith('/build/')
        || url.pathname.startsWith('/img/');
    if (!cacheable) return;

    event.respondWith((async () => {
        const cached = await caches.match(req);
        const network = fetch(req).then((res) => {
            if (res && res.status === 200) {
                caches.open(CACHE).then((c) => c.put(req, res.clone()));
            }
            return res;
        }).catch(() => cached);
        return cached || network;
    })());
});
