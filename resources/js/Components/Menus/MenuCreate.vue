<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {inject} from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import NavLinkBlank from "@/Components/NavLinkBlank.vue";
import SelectInput from "@/Components/SelectInput.vue";

const goBack = route('menu.index');
const form = useForm({
    title: {
        en: '',
        es: '',
        ru: '',
    },
    placement: '',
    type: 'private',
})


const props = defineProps({
    menu_placements: Array
})
const translations_menus = inject('translations_menus');

const create_menu = () => {
    form.post(route('menu.store'));
}
</script>

<template>
    <Head :title="translations_menus.create"/>
    <form @submit.prevent="create_menu">
        <div class="space-y-2">
            <div class="border-b border-gray-900/10 pb-2">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 sm:col-start-1">
                        <InputLabel :value="translations_menus.title_en"/>
                        <div class="mt-2">
                            <TextInput id="title_en" v-model="form.title.en" class="w-full" name="title[en]"
                                       type="text"/>
                            <InputError v-if="form.errors" :message="form.errors['title.en']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">

                        <InputLabel :value="translations_menus.title_es"/>
                        <div class="mt-2">
                            <TextInput id="title_es" v-model="form.title.es" class="w-full" name="title[es]"
                                       type="text"/>
                            <InputError :message="form.errors['title.es']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <InputLabel :value="translations_menus.title_ru"/>
                        <div class="mt-2">
                            <TextInput id="title_ru" v-model="form.title.ru" class="w-full" name="title[ru]"
                                       type="text"/>
                            <InputError :message="form.errors['title.ru']"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel :value="translations_menus.placement"/>
                        <div class="mt-2">
                            <SelectInput v-model="form.placement" :options="menu_placements"
                                         :translations="translations_menus"/>
                            <InputError :message="form.errors.placement"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel :value="translations_menus.type"/>
                        <div class="mt-2">
                            <SelectInput v-model="form.type" :options="['public', 'private']"
                                         :translations="translations_menus"/>
                            <InputError :message="form.errors.type"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-900/10 pb-2">
                <h2 class=" font-semibold leading-7 "></h2>

                <div class="mt-10 grid gap-x-6 gap-y-8">
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

