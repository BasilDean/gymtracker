<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {provide} from "vue";
import MenuCreate from "@/Components/Menus/MenuCreate.vue";

const props = defineProps({
    menu_placements: Array,
    translations_menus: Array,
});


provide('item_type', 'menu');
const {props: pageProps} = usePage();
provide('translations_menus', props.translations_menus);

</script>

<template>
    <Head title="Roles"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ translations_menus.create }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <MenuCreate :menu_placements="menu_placements"></MenuCreate>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
