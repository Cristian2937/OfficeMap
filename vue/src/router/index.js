import {createRouter, createWebHistory} from 'vue-router';
import EmptyView from "../views/EmptyView.vue";
import CustomTable from "@/components/CustomTable/CustomTable.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path:'/home',
            alias: '/home',
            name: 'home',
            component: EmptyView,
        },
        {
            path:'/prova',
            alias: '/prova',
            name: 'prova',
            component: CustomTable,
        },
    ]
});

export default router;