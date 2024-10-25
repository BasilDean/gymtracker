<script setup>

import ButtonDelete from "@/Components/ButtonDelete.vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import {inject} from "vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    }
});

const item_type = inject('item_type');

</script>

<template>
    <li class="flex justify-between gap-x-6 py-5 text-white">
        <div class="flex min-w-0 gap-x-4">
            <p>{{ item.id }}</p>
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6">
                    {{ item.locale_title }}
                </p>
            </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            <div class="mt-1 flex items-center gap-x-1.5">
                <ButtonCreate :href="route(item_type + '.edit', item.slug)">{{
                        $page.props.translations.edit
                    }}
                </ButtonCreate>
                <ButtonDelete :item_id="item.id">{{ $page.props.translations.delete }}</ButtonDelete>
            </div>
        </div>
    </li>
</template>

<style scoped>
</style>
