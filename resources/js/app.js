import './bootstrap';
// import './custom';

import '../css/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Layout from './Layouts/App.vue'
import Helpers from './helpers';
import Cart from './cart';
import Favorites from './favorites';
import Addresses from './addresses';
import Snackbar from 'node-snackbar';
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
       const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
       page.then((module) => {
        module.default.layout = module.default.layout || Layout;
      });
      return page;
    },
    setup({ el, App, props, plugin }) {
        const app =  createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy);
            app.config.globalProperties.$route = route;
            app.config.globalProperties.$helpers = Helpers;
            app.config.globalProperties.$cart = Cart;
            app.config.globalProperties.$favorites = Favorites;
            app.config.globalProperties.$addresses = Addresses;
            app.config.globalProperties.$notify = Snackbar;
            app.mount(el);
            return app;
    },
    progress: {
        color: '#4B5563',
    },
});
