<script setup>
import {inject, reactive} from "vue";
import FormInput from "@/Components/FormInput.vue";

const props = defineProps({
    action: String,
});

let itemFields = reactive(inject('itemFields'));
const translatable = inject('translatable');
</script>

<template>
    <form :action="action" class="p-4" method="post">
        <div v-for="(field, key) in itemFields" :key="key">
            <div v-if="translatable.includes(key)">
                <div v-for="(value, lang) in field" :key="lang">
                    <FormInput :id="key + '[' + lang + ']' " v-model="itemFields[key][lang]"></FormInput>
                </div>
            </div>
            <div v-else>
                <FormInput :id="key" v-model="itemFields[key]"></FormInput>
            </div>
        </div>
    </form>
</template>

<style scoped>
/* Add your styles here */
</style>
