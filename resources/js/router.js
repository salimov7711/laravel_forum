import Index from "./components/Login.vue";
import Get from "./components/Get.vue";
import Login from "./components/Login.vue";
import Personal from "./components/Personal.vue";
import { createRouter, createWebHistory } from "vue-router";
import Registration from "./components/Registration.vue";
const routes = [
    {
        path: "/",
        component: Index,
    },
    {
        path: "/get",
        component: Get,
    },
    {
        path: "/user/login",
        component: Login,
				name: 'user.login'
    },
    {
        path: "/user/registration",
        component: Registration,
				name: 'user.registration'
    },
    {
        path: "/user/personal",
        component: Personal,
				name: 'user.personal'
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("x-xsrf-token");
    if (!token) {
        if (to.name === "user.login" || to.name === "user.registration") {
            return next();
        } else {
            return next({
                name: "user.login",
            });
        }
    }

		if(to.name === "user.login" || to.name === "user.registration" && token) {
			return next({
				name:'user.personal'
			})
		}
		next()
});
export default router;
