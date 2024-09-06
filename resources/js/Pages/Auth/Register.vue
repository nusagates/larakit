<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {go} from "@/funcs.js";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

       <v-form @submit.prevent="submit">
            <v-card class="mx-auto" max-width="400">
                <v-card-title>
                    <h2 class="text-h5">Register</h2>
                </v-card-title>
                <v-card-text>
                   <v-text-field v-model="form.name" :error-messages="form.errors.name" label="Name" name="name" required />
                    <v-text-field v-model="form.email" :error-messages="form.errors.email" label="Email" name="email" required />
                    <v-text-field v-model="form.password" :error-messages="form.errors.password" label="Password" name="password" required type="password" />
                    <v-text-field v-model="form.password_confirmation" :error-messages="form.errors.password_confirmation" label="Confirm Password" name="password_confirmation" required type="password" />
                    <v-row>
                        <v-col>
                            <v-btn variant="text" color="secondary" @click="go('/login')">Login</v-btn>
                        </v-col>
                        <v-col class="text-right">
                            <v-btn :loading="form.processing" :disabled="form.processing" color="primary" type="submit">Register</v-btn>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-form>
    </GuestLayout>
</template>
