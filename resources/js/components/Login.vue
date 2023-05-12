<template>
    <div class="w-25">
        <input
            v-model="email"
            type="email"
            placeholder="email"
            class="form-control mt-5"
        />
        <input
            v-model="password"
            type="password"
            placeholder="password"
            class="form-control mt-3"
        />
        <input
            @click.prevent="login"
            type="submit"
            class="btn btn-primary mt-3"
        />
    </div>
</template>

<script setup>
import axios from "axios";
import { useRenderStore } from "../stores/tokenStore";
import { ref } from "vue";
import router from "../router";
const password = ref("");
const email = ref("");
const store = useRenderStore();

//
// const login = async () => {
//     await axios
//         .get("/sanctum/csrf-cookie")
//         .then((response) => {
//             // axios
//             //     .post("/login", { email: email.value, password: password.value })
//             //     .then((res) => {
//             //         console.log(res);
//             //     });
//             console.log(response);
//         });

// };
// export default {
// 	name: 'Login',
// 	data() {
// 		return  {
// 			email: null,
// 			password: null
// 		}
// 	},

const login = function () {
    axios.get("/sanctum/csrf-cookie").then((response) => {
        console.log(response);
        axios
            .post("/login", { email: email.value, password: password.value })
            .then((res) => {
                console.log(res);
                localStorage.setItem(
                    "x-xsrf-token",
                    res.config.headers["X-XSRF-TOKEN"]
                );
                router.push("/user/personal");
                store.forceRender();
                console.log(res);
            });
        // .catch((err) => {
        //     console.log(err);
        // });
    });
};
</script>

<style lang="scss" scoped></style>
