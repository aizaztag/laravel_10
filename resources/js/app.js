import './bootstrap';

import router from "./router/index";
import axios from 'axios';
import VueAxios from 'vue-axios';


import { createApp } from 'vue'
import PostsIndex from './components/Posts/Index.vue'
import App from './components/App.vue'

createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .mount("#app");
