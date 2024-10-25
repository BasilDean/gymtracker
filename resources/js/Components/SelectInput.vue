<script setup>
import {onMounted, ref} from 'vue';

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    translations: {
        type: Object,
        required: true,
    }
})

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <select ref="input" v-model="model"
            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
        <option v-for="option in options" :value="option">{{ translations[option] }}</option>
    </select>
</template>
