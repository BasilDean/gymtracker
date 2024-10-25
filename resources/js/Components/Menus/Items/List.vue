<script setup>

import XListItem from '@/Components/Menus/Items/Item.vue';

const props = defineProps({
    items: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <ul class="divide-y divide-gray-100 px-5" role="list">
        <X-List-Item v-for="item in items" :item="item"/>
    </ul>
</template>

<style lang="stylus"></style>
