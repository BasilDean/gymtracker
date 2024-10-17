<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {provide} from "vue";
import RoleEdit from "@/Components/RoleEdit.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ButtonCreate from "@/Components/ButtonCreate.vue";

const props = defineProps({
    role: Object,
    translations_roles: Object,
    assignedPermissions: Array,
});

const page = usePage();

provide('assignedPermissions', props.role.permissionIds);

provide('item_type', 'role');
const {props: pageProps} = usePage();
const permissions = pageProps.permissions;
provide('permissions', permissions);
provide('translations_roles', props.translations_roles);

const closeModal = () => {
    page.props.flash.success = null;
};
</script>

<template>
    <Head :title="translations_roles.edit"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ translations_roles.edit }}</h2>
            <ButtonCreate>{{ $page.props.translations.create }}</ButtonCreate>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <RoleEdit :role="role"></RoleEdit>
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
