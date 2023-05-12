<template>
    <Nav :key="useRenderStore().render" />
    <router-view></router-view>
</template>

<script setup>
import { useRenderStore } from "../stores/tokenStore";

import Nav from "./Nav.vue";
</script>

<style lang="scss" scoped>
a {
    margin-left: 5px;
}
</style>
