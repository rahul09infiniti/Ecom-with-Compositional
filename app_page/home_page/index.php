<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.2.0/mdb.min.css"
    rel="stylesheet"
  /> -->

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />

  <!-- <link rel="stylesheet" href="style.css" /> -->
<!-- 
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  /> -->

  <!-- Favicons -->
  <link
    rel="apple-touch-icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png"
    sizes="180x180"
  />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png"
    sizes="32x32"
    type="image/png"
  />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png"
    sizes="16x16"
    type="image/png"
  />
  <link
    rel="manifest"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json"
  />
  <link
    rel="mask-icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg"
    color="#712cf9"
  />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico"
  />
  <meta name="theme-color" content="#712cf9" />
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <!-- <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
  /> -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  
</head>
<body>
    <div id="app">
        <home-page></home-page>
        
    </div>

    <script type="importmap">
        {
            "imports": {
                "vue": "../../resources/esmodules/vue.3.4.31.esm-browser.js",
                "vue-sfc-loader": "../../resources/esmodules/vue3-sfc-loader.0.9.5.esm.js",
                "axios": "../../resources/esmodules/axios/dist/axios.min.js"
                
            }
        }
    </script>
    

    <script type=module>
        import { createApp, defineAsyncComponent } from "vue";
        import * as Vue from 'vue';
        import { loadModule, version } from "vue-sfc-loader";

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
                'home-page' : defineAsyncComponent(() => loadModule('../../resources/view/HomePage.vue', options)),
            }
        }).mount('#app');
    </script>




</body>
</html>