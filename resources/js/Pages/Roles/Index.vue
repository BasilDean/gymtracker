<script setup>
import {Head} from '@inertiajs/vue3';
import XList from '@/Components/List.vue';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {provide} from "vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";

const props = defineProps({
    roles: Array,
    translations_roles: Array,
});


provide('item_type', 'role');

</script>

<template>
    <Head title="Roles"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{
                    translations_roles.title
                }}</h2>
            <ButtonCreate>{{ $page.props.translations.create }}</ButtonCreate>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <XList :items="roles" class="p-6" item-type="role"/>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
