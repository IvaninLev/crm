import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import DefaultLayout from "./Layouts/DefaultLayout.vue";
import {ZiggyVue} from "ziggy-js"
import {toast} from "vue3-toastify";

import "../sass/app.scss"
import "vue3-toastify/dist/index.css";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || DefaultLayout
        return page
    },
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
        app.config.globalProperties.$toast = toast
        app.mount(el)
    },
})
