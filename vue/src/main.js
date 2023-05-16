import { createApp } from "vue";

require('bootstrap');

import '@/styles/base.css';
import  '@/styles/scss/app.scss';

import App from "@/App";
import router from "@/router";

import { library } from '@fortawesome/fontawesome-svg-core';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

const $ = require('jquery');
global.$ = global.jQuery = $;

library.add(fas, far, fab);

createApp(App).use(router).component('font-awesome-icon', FontAwesomeIcon).mount('#app');


