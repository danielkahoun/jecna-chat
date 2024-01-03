<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { useSlots } from "vue";

const slots = useSlots();
</script>

<template>
    <div
        class="flex flex-col items-center justify-center min-h-screen gap-5 bg-slate-100"
    >
        <div class="p-6 bg-white rounded shadow-md shadow-gray-200">
            <h1 class="mb-5 font-sans text-2xl font-bold" v-if="slots.title">
                <slot name="title" />
            </h1>
            <slot />
        </div>
    </div>
</template>
