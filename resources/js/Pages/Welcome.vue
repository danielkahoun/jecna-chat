<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Welcome" />

    <GuestLayout>
        <div class="flex-col gap-5">
            <Link v-if="$page.props.auth.user" :href="route('chats')"
                ><PrimaryButton>Pokračovat do aplikace</PrimaryButton></Link
            >

            <div class="flex flex-col justify-center gap-4 text-center" v-else>
                <h1 class="text-2xl font-bold">Ječná Chat</h1>
                <p>Real-time chat aplikace</p>

                <div class="flex flex-row gap-4">
                    <Link :href="route('register')"
                        ><PrimaryButton>Registrovat se</PrimaryButton></Link
                    >
                    <Link :href="route('login')"
                        ><PrimaryButton>Přihlásit se</PrimaryButton></Link
                    >
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
