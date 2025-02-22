import { createWebHistory, createRouter } from "vue-router";

import EmailIndex from "./Pages/Email/EmailIndex.vue";
import EmailShow from "./Pages/Email/EmailShow.vue";

const routes = [
    {
        path: "/",
        component: EmailIndex,
        name: "email.index",
    },
    {
        path: "/:id",
        component: EmailShow,
        name: "email.show",
    },
];

const router = createRouter({
    history: createWebHistory("/mail-log"),
    routes,
});

export default router;
