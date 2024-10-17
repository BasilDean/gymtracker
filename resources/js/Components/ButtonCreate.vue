<script setup>

import {inject} from "vue";
import NavLinkBlank from "@/Components/NavLinkBlank.vue";


const item_type = inject('item_type');
const createRoute = route(item_type + '.create');

</script>

<template>
    <NavLinkBlank :href="createRoute"
                  class="bg-green-700 hover:bg-green-900 text-xs text-white font-bold py-2 px-4 rounded">
        <slot/>
    </NavLinkBlank>
</template>

<style scoped>

</style>
