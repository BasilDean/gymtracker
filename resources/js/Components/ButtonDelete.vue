<script setup>

import Button from "@/Components/Button.vue";
import {inject} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    item_id: {
        type: Number,
        required: true,
    },
});

const delete_item_confirm = inject('delete_item_confirm');

const item_type = inject('item_type');
const deleteRoute = (id) => {
    return route(item_type + '.destroy', id);
};

const form = useForm({});
const deleteItem = (id) => {
    if (confirm(delete_item_confirm)) {
        form.delete(deleteRoute(id));
    }
};

</script>

<template>
    <Button
        class="bg-red-700 hover:bg-red-900 text-xs text-white font-bold py-2 px-4 rounded"
        @click.prevent="deleteItem(item_id)">
        <slot/>
    </Button>

</template>

<style scoped>

</style>
