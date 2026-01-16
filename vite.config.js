import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'
import copy from "rollup-plugin-copy";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
        vue({
            template:{
                transformAssetUrls:{
                    base:null,
                    includeAbsolute:false,
                }
            }
        }),
        copy({
            targets:[
                {
                    src:"resources/img",
                    dest:"public"
                }
            ]
        })
    ],
});
