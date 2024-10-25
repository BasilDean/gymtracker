<script setup>
import NavLinkBlank from "@/Components/NavLinkBlank.vue";
import {inject, provide} from "vue";
import {Head, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PermissionsList from "@/Components/Roles/PermissionsList.vue";
import InputError from "@/Components/InputError.vue";

const goBack = route('role.index');

const permissions = inject('permissions');
const form = useForm({
    title: {
        en: '',
        es: '',
        ru: '',
    },
    permissions: [],
});

provide('form', form);
const translations_roles = inject('translations_roles');

const create_role = () => {
    form.post(route('role.store'));
};

</script>

<template>
    <Head :title="translations_roles.create"/>
    <form @submit.prevent="create_role">
        <div class="space-y-2">
            <div class="border-b border-gray-900/10 pb-2">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 sm:col-start-1">
                        <InputLabel :value="translations_roles.title_en"/>
                        <div class="mt-2">
                            <TextInput id="title_en" v-model="form.title.en" class="w-full" name="title[en]"
                                       type="text"/>
                            <InputError v-if="form.errors" :message="form.errors['title.en']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">

                        <InputLabel :value="translations_roles.title_es"/>
                        <div class="mt-2">
                            <TextInput id="title_es" v-model="form.title.es" class="w-full" name="title[es]"
                                       type="text"/>
                            <InputError :message="form.errors['title.es']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <InputLabel :value="translations_roles.title_ru"/>
                        <div class="mt-2">
                            <TextInput id="title_ru" v-model="form.title.ru" class="w-full" name="title[ru]"
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
            <NavLinkBlank :href="goBack"
                          class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                          type="button">{{ $page.props.translations.cancel }}
            </NavLinkBlank>
            <button
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                type="submit">
                {{ $page.props.translations.create }}
            </button>
        </div>
    </form>
</template>
