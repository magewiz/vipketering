<!DOCTYPE html>
<html lang="mk" class="grain-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title inertia>{{ config('app.name', 'VIP Ketering') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'VIP Ketering — професионален кетеринг за свадби, прослави и компании во Скопје. Let us do all the work.' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- PWA --}}
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="theme-color" content="#100F0D">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="VIP Ketering">
    <link rel="apple-touch-icon" href="/img/icon-180.png">
    <link rel="icon" href="/img/icon-192.png">

    {{-- Fonts are self-hosted (see resources/css/fonts.css); preload the faces used above the fold --}}
    <link rel="preload" href="/fonts/cormorant-500-cyrillic.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/cormorant-500-latin.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/manrope-400-cyrillic.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/manrope-400-latin.woff2" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead

    @foreach ($jsonLd ?? [] as $schema)
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endforeach
</head>
<body class="grain">
    @inertia

    {{-- PWA install prompt --}}
    <div id="pwa-install" class="pwa-install" role="dialog" aria-label="Инсталирај апликација" hidden>
        <span class="pwa-badge"><img src="/img/logo-vip-96.png" alt="VIP Ketering" width="96" height="96"></span>
        <div class="pwa-text">
            <strong>Инсталирај го VIP Ketering</strong>
            <span>Додај ја апликацијата на почетниот екран за брз пристап.</span>
        </div>
        <div class="pwa-actions">
            <button type="button" id="pwa-install-btn">Инсталирај</button>
            <button type="button" id="pwa-dismiss-btn" aria-label="Затвори">Не сега</button>
        </div>
    </div>

    <script>
    (function () {
        // Register the service worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js').catch(function (e) { console.warn('SW registration failed', e); });
            });
        }

        // Custom install prompt
        var deferred = null;
        var banner = document.getElementById('pwa-install');
        var installBtn = document.getElementById('pwa-install-btn');
        var dismissBtn = document.getElementById('pwa-dismiss-btn');

        // Only offer the install prompt on phones/tablets — not on desktop.
        function isMobileOrTablet() {
            var coarse = window.matchMedia('(any-pointer: coarse)').matches;
            var touch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
            var narrow = window.matchMedia('(max-width: 1024px)').matches;
            return (coarse || touch) && narrow;
        }

        function show() {
            if (localStorage.getItem('pwa-dismissed') === '1') return;
            if (window.matchMedia('(display-mode: standalone)').matches) return; // already installed
            if (!isMobileOrTablet()) return; // mobile + tablet only
            banner.hidden = false;
            requestAnimationFrame(function () { banner.classList.add('show'); });
        }
        function hide() {
            banner.classList.remove('show');
            setTimeout(function () { banner.hidden = true; }, 400);
        }

        window.addEventListener('beforeinstallprompt', function (e) {
            // Only intercept when our custom banner will actually be shown —
            // otherwise let the browser handle it (avoids the "banner not
            // shown" console warning on desktop).
            if (localStorage.getItem('pwa-dismissed') === '1') return;
            if (window.matchMedia('(display-mode: standalone)').matches) return;
            if (!isMobileOrTablet()) return;
            e.preventDefault();
            deferred = e;
            show();
        });

        installBtn && installBtn.addEventListener('click', async function () {
            hide();
            if (!deferred) return;
            deferred.prompt();
            try { await deferred.userChoice; } catch (_) {}
            deferred = null;
        });
        dismissBtn && dismissBtn.addEventListener('click', function () {
            localStorage.setItem('pwa-dismissed', '1');
            hide();
        });

        window.addEventListener('appinstalled', function () { hide(); deferred = null; });
    })();
    </script>
</body>
</html>
