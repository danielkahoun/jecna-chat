<script setup lang="ts">
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100 shadow">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex">
                            <Link :href="route('chats')">
                                <h1 class="font-semibold">Ječná Chat</h1>
                            </Link>
                        </div>

                        <div class="flex items-center gap-6">
                            {{ $page.props.auth.user.username }}
                            <Link :href="route('logout')" method="post">
                                <PrimaryButton>Odhlásit se</PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
