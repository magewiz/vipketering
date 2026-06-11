<!DOCTYPE html>
<html lang="mk" class="grain-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title inertia>{{ config('app.name', 'VIP Ketering') }}</title>
    <meta name="description" content="VIP Ketering — професионален кетеринг за свадби, прослави и компании во Скопје. Let us do all the work.">

    {{-- PWA --}}
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="theme-color" content="#100F0D">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="VIP Ketering">
    <link rel="apple-touch-icon" href="/img/icon-180.png">
    <link rel="icon" href="/img/icon-192.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Manrope:wght@400;500;600;700&display=swap&subset=cyrillic,cyrillic-ext,latin" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="grain">
    @inertia

    {{-- PWA install prompt --}}
    <div id="pwa-install" class="pwa-install" role="dialog" aria-label="Инсталирај апликација" hidden>
        <span class="pwa-badge"><img src="/img/logo-vip.png" alt="VIP Ketering"></span>
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

        function show() {
            if (localStorage.getItem('pwa-dismissed') === '1') return;
            if (window.matchMedia('(display-mode: standalone)').matches) return; // already installed
            banner.hidden = false;
            requestAnimationFrame(function () { banner.classList.add('show'); });
        }
        function hide() {
            banner.classList.remove('show');
            setTimeout(function () { banner.hidden = true; }, 400);
        }

        window.addEventListener('beforeinstallprompt', function (e) {
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
