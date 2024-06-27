import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { Head, Link, createInertiaApp } from '@inertiajs/vue3';
import Layout from './Layouts/Layout.vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { i18nVue } from 'laravel-vue-i18n';


const appName = import.meta.env.VITE_APP_NAME || 'Vuezz';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue)
        .component('Link', Link)
        .component('Head', Head)
        .use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
        .mount(el)
    },
})