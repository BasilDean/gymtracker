<script setup>

defineProps({
    item: Object,
    action: String,
})


</script>

<template>
    <form :action="action" method="post">
        <input v-for="(field, key) in item" :name="key" :value="field" type="text">
    </form>
</template>

<style scoped>

</style>
