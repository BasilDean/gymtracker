<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {inject} from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import NavLinkBlank from "@/Components/NavLinkBlank.vue";
import SelectInput from "@/Components/SelectInput.vue";
import XList from "@/Components/Menus/Items/List.vue";

const props = defineProps({
    menu_placements: {
        type: Array,
        required: true,
    },
    item: {
        type: Object,
        required: true,
    }
})

const goBack = route('menu.index');
const form = useForm({
    id: String(props.item.id),
    slug: props.item.slug,
    title: {
        en: props.item.title.en,
        es: props.item.title.es,
        ru: props.item.title.ru,
    },
    placement: props.item.placement,
    type: props.item.type,
})
const translations_menus = inject('translations_menus');

const create_menu = () => {
    form.patch(route('menu.update', props.item.id));
}
</script>

<template>
    <Head :title="translations_menus.create"/>

    <form @submit.prevent="create_menu">
        <div class="space-y-2">
            <div class="border-b border-gray-900/10 pb-2">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <TextInput v-model="form.id" name="id" type="hidden"/>
                    <textInput v-model="form.slug" name="slug" type="hidden"/>
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
                    <XList :items="item.menu_items" class="p-6"/>
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
                {{ $page.props.translations.save }}
            </button>
        </div>
    </form>
</template>

