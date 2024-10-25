<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {provide} from "vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Edit from "@/Components/Menus/Edit.vue"

const props = defineProps({
    menu: {
        type: Object,
        required: true
    },
    translations_menus: {
        type: Object,
        required: true
    },
    menu_placements: {
        type: Object,
        required: true
    }
});

const page = usePage();


provide('item_type', 'menu');
const {props: pageProps} = usePage();
provide('translations_menus', props.translations_menus);

const closeModal = () => {
    page.props.flash.success = null;
};
</script>

<template>
    <Head :title="translations_menus.edit"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ translations_menus.edit }}</h2>
            <ButtonCreate>{{ $page.props.translations.create }}</ButtonCreate>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <Edit :item="menu" :menu_placements="menu_placements"></Edit>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="page.props.flash.success">
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
