<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import XList from '@/Components/Roles/List.vue';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {computed, provide} from "vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    roles: Object,
    translations_roles: Object,
});
const page = usePage();
provide('delete_item_confirm', props.translations_roles.delete_item_confirm);
provide('item_type', 'role');

const showModal = computed(() => {
    return page.props.flash.success !== null;
})

const closeModal = () => {
    page.props.flash.success = null;
};
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
        <Modal :show="showModal">
            <div class="p-6 text-white">
                <div>
                    {{ page.props.flash.success }}
                </div>
                <div class="flex justify-end">
                    <SecondaryButton @click="closeModal"> {{ $page.props.translations.close }}</SecondaryButton>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>
