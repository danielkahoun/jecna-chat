<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import ChatMessage from "@/Components/ChatMessage.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Pusher from "pusher-js";
import Echo from "laravel-echo";
import { onMounted } from "vue";

const props = defineProps<{
    chatroom: App.Models.ChatRoom;
    messages: App.Models.Message[];
    users: App.Models.User[];
}>();

const form = useForm({
    message: "",
});

onMounted(() => {
    window.Pusher = Pusher;
    window.Echo.channel("chatrooms." + props.chatroom.id).listen(
        ".message-sent",
        (e: any) => {
            console.log(e);
            props.messages.push(e.message);
        }
    );
});
</script>

<template>
    <Head :title="props.chatroom.name" />

    <AuthLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-6 p-6">
                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ chatroom.name }}
                            </h1>
                            <p>{{ chatroom.description }}</p>
                        </div>

                        <hr />

                        <div
                            class="flex flex-col max-h-[50vh] gap-6 overflow-y-auto"
                        >
                            <template
                                v-for="message in messages"
                                :key="message.id"
                            >
                                <ChatMessage
                                    :content="message.message"
                                    :author="
                                        users.find(
                                            (user) => user.id == message.user_id
                                        )?.username || 'Neznámý uživatel'
                                    "
                                    :active="
                                        message.user_id ==
                                        $page.props.auth.user.id
                                    "
                                    :createdAt="
                                        new Date(
                                            message.created_at
                                        ).toLocaleString('cs-CZ')
                                    "
                                />
                            </template>
                        </div>

                        <hr />

                        <form
                            class="flex w-full"
                            @submit.prevent="
                                form.post(route('messages.store', chatroom.id))
                            "
                        >
                            <TextInput
                                id="message"
                                type="text"
                                class="block w-full"
                                v-model="form.message"
                                placeholder="Zpráva"
                                required
                                autofocus
                                autocomplete="off"
                            />
                            <PrimaryButton class="ml-2">Odeslat</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
