<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <detail-page></detail-page>
    </div>

    <script type="importmap">
        {
            "imports" :{
                "vue": "../../resources/esmodules/vue.3.4.31.esm-browser.js",
                "vue-sfc-loader": "../../resources/esmodules/vue3-sfc-loader.0.9.5.esm.js",
                "axios": "../../resources/esmodules/axios/dist/axios.min.js"
            }
        }
    </script>


    <script type="module">
        import {createApp, ref, defineAsyncComponent} from 'vue';
        import * as Vue from 'vue';
        import { loadModule, version} from "vue-sfc-loader"


        const options = {

            moduleCache: {
                vue: Vue,
                // axios: axios.default,    
            },

            async getFile(url) {
                // return fetch(url).then(response => response.ok ? response.text() : Promise.reject(response));
                const res = await fetch(url);
                if ( !res.ok )
                    throw Object.assign(new Error(url+' '+res.statusText), { res });
                return await res.text(); 
            },

            addStyle(styleStr) {
                const style = document.createElement('style');
                style.textContent = styleStr;
                const ref = document.head.getElementsByTagName('style')[0] || null;
                document.head.insertBefore(style, ref);
            },

            log(type, ...args) {
                console.log(type, ...args);
            },

            handleModule(type, source, path, options) {                  
                if ( type === '.json' )
                    return JSON.parse(source);
            }

        }

        const app = createApp({
            components:{
                'detail-page' : defineAsyncComponent(() => loadModule('../../resources/view/DetailPage.vue', options))
            }
        }).mount('#app')


        </script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>