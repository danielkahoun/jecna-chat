<script setup lang="ts">
import { computed, defineProps } from "vue";

const props = defineProps<{
    content: string;
    active: boolean;
    author: string;
    createdAt: string;
}>();

const classes = computed(() => {
    return {
        "bg-slate-200 ml-auto": props.active,
        "bg-slate-100 mr-auto": !props.active,
    };
});
</script>

<template>
    <div class="w-2/5 p-3 rounded color-white" :class="classes">
        <p class="mb-2 text-sm text-gray-500">
            {{ author }} &middot; {{ createdAt }}
        </p>

        <p>
            {{ content }}
        </p>
    </div>
</template>
