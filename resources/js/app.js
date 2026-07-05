import './bootstrap';

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

import { createSSRApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import {ZiggyVue} from "ziggy-js";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        const vueApp = createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, props.initialPage.props.ziggy)

        // On the server `el` is null: return the app for renderToString.
        // On the client `el` exists: mount (hydrate) it.
        if (el) {
            vueApp.mount(el)
        }

        return vueApp
    },
})
