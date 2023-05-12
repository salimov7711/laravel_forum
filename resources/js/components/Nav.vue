<template>
    <div>
        <router-link to="/get">Get</router-link>
        <router-link v-if="!getToken()" to="/user/login">Login</router-link>
        <router-link v-if="!getToken()" to="/user/registration"
            >Registration
        </router-link>
        <router-link v-if="getToken()" to="/user/personal"
            >Personal</router-link
        >
        <a v-if="getToken()" @click.prevent="logOut()" href="#">Logout</a>
    </div>
</template>

<script setup>
import router from "../router";
import axios from "axios";
import { useRenderStore } from "../stores/tokenStore";
import { onMounted, onUpdated } from "vue";
const store = useRenderStore();

const getToken = () => {
    let token = localStorage.getItem("x-xsrf-token");
    
    return token;
};
const logOut = () => {
    axios.get("/logout").then((res) => {
        localStorage.removeItem("x-xsrf-token");
        router.push("/user/login");
				
				store.forceRender();
    });
};

onMounted(() => {
   
});

//export default {
// name: "Nav",
// data() {
//     return {
//         token: null,
//         count: 0,
//     };
// },
// mounted() {
//     this.getToken();
// },
// updated() {},
// methods: {
//     getToken() {
//         this.token = localStorage.getItem("x-xsrf-token");
//     },
//     logout() {
//         axios.get("/logout").then((res) => {
//             localStorage.removeItem("x-xsrf-token");
//             this.$router.push("/user/login");
//             this.getToken();
//         });
//     },
// },
//};
</script>

<style lang="scss" scoped>
a {
    margin-left: 5px;
}
</style>
