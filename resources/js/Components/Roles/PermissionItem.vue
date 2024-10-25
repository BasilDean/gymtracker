<template>
    <li :item="item" class="flex justify-between gap-x-6 py-5">
        <div class="flex min-w-0 gap-x-4">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-white-900">{{
                        item.locale_title
                    }}</p>
            </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            <input :checked="isPermissionChecked(item.id)"
                   :name="`permissions[${item.id}]`"
                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                   type="checkbox"
                   @change="togglePermission(item.id)">
        </div>
    </li>
</template>
<script setup>
import {inject} from "vue";

defineProps(
    {
        item: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
        },
        isPermissionChecked: {
            type: Function,
        },
        togglePermission: {
            type: Function,
        },
    }
);

let form = inject('form');

const isPermissionChecked = (id) => {
    return form.permissions.includes(id);
};

const togglePermission = (id) => {
    if (isPermissionChecked(id)) {
        form.permissions = form.permissions.filter(permissionId => permissionId !== id);
    } else {
        form.permissions.push(id);
    }
};

</script>
