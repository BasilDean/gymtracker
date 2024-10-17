<template>
    <ul class="divide-y divide-gray-100" role="list">
        <PermissionItem v-for="item in permissions.data" :item="item"/>
    </ul>
</template>
<script setup>
import PermissionItem from "@/Components/PermissionItem.vue";

defineProps({
    permissions: {
        type: Object,
    },
});
</script>
