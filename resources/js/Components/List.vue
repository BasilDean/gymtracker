<script setup>

import XListItem from '@/Components/ListItem.vue';

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

console.log(props.items);

</script>

<template>
    <ul class="divide-y divide-gray-100 px-5" role="list">
        <X-List-Item v-for="item in items.data" :item="item"/>
    </ul>
</template>

<style lang="stylus"></style>
