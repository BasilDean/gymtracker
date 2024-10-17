<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {provide} from "vue";
import RoleCreate from "@/Components/RoleCreate.vue";

const props = defineProps({
    roles: Array,
    translations_roles: Array,
});


provide('item_type', 'role');
const {props: pageProps} = usePage();
const permissions = pageProps.permissions;
provide('permissions', permissions);
provide('translations_roles', props.translations_roles);

</script>

<template>
    <Head title="Roles"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ translations_roles.create }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <RoleCreate></RoleCreate>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
