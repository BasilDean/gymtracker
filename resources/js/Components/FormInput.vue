<script setup>
defineProps({
    type: {
        type: String,
        required: false,
        default: 'text'
    },
    id: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: false
    },
    value: {
        type: String,
        required: false,
        default: ''
    }
})
</script>

<template>
    <div>
        <label v-if="label" :for="id" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <div class="relative mt-2 rounded-md shadow-sm">
            <input :id="id"
                   :name="id"
                   :placeholder="id"
                   :type="type"
                   :value=value
                   class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
        </div>
    </div>
</template>

<style scoped>

</style>
