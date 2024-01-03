<script setup lang="ts">
const props = defineProps<{
    name: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex flex-col gap-2 p-6 transition rounded bg-slate-100 hover:bg-slate-200"
    >
        <h1 class="font-semibold">{{ name }}</h1>
        <p>
            {{ description }}
        </p>
    </div>
</template>
