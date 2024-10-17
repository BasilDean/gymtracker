<script setup>
import NavLinkBlank from "@/Components/NavLinkBlank.vue";
import {inject, provide} from "vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PermissionsList from "@/Components/PermissionsList.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    role: Object,
});

const permissions = inject('permissions');
const assignedPermissions = inject('assignedPermissions');
const form = useForm({
    id: props.role.id,
    name: props.role.name,
    title: {
        en: props.role.title.en,
        es: props.role.title.es,
        ru: props.role.title.ru,
    },
    permissions: assignedPermissions,
});
provide('form', form);
const translations_roles = inject('translations_roles');

const update_role = () => {
    form.patch(route('role.update', props.role.id));
};
</script>

<template>
    <form @submit.prevent="update_role">
        <div class="space-y-2">
            <div class="border-b border-gray-900/10 pb-2">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <TextInput v-model="form.id" name="id" type="hidden"/>
                    <textInput v-model="form.name" name="name" type="hidden"/>
                    <div class="sm:col-span-2 sm:col-start-1">
                        <InputLabel :value="translations_roles.title_en"/>
                        <div class="mt-2">
                            <TextInput id="title_en" v-model="form.title.en" class="w-full" type="text"/>
                            <InputError v-if="form.errors" :message="form.errors['title.en']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">

                        <InputLabel :value="translations_roles.title_es"/>
                        <div class="mt-2">
                            <TextInput id="title_es" v-model="form.title.es" class="w-full"
                                       type="text"/>
                            <InputError :message="form.errors['title.es']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <InputLabel :value="translations_roles.title_ru"/>
                        <div class="mt-2">
                            <TextInput id="title_ru" v-model="form.title.ru" class="w-full"
                                       type="text"/>
                            <InputError :message="form.errors['title.ru']"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-900/10 pb-2">
                <h2 class=" font-semibold leading-7 ">{{ translations_roles.permissions }}</h2>

                <div class="mt-10 grid gap-x-6 gap-y-8">
                    <PermissionsList :permissions="permissions"/>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <NavLinkBlank :href="route('role.index')"
                          class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                          type="button">{{ $page.props.translations.cancel }}
            </NavLinkBlank>
            <button
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                type="submit">
                {{ $page.props.translations.save }}
            </button>
        </div>
    </form>
</template>
