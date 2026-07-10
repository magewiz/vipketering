import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';

createInertiaApp({
    title: (title) => (title ? `${title} — VIP Ketering` : 'VIP Ketering'),
    resolve: (name) => {
        // Lazy glob → every page becomes its own chunk, so public visitors
        // never download the admin panel code (and vice versa).
        const pages = import.meta.glob('./Pages/**/*.vue');
        return pages[`./Pages/${name}.vue`]();
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .mount(el);
    },
    progress: { color: '#C29A4B' },
});
