<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in"/>
    <v-card class="mx-auto" max-width="400">
      <v-card-title>
        <h2 class="text-h5">Log in</h2>
      </v-card-title>
      <v-card-text>
        <v-form @submit.prevent="submit">
          <v-text-field v-model="form.email" :error-messages="form.errors.email" label="Email" name="email" required/>
          <v-text-field v-model="form.password" :error-messages="form.errors.password" label="Password" name="password" required
                        type="password"/>
          <v-checkbox v-model="form.remember" label="Remember me"/>
          <v-row>
            <v-col>
              <v-btn variant="text" color="secondary" href="/register">Register</v-btn>
            </v-col>
            <v-col class="text-right">
              <v-btn :loading="form.processing" :disabled="form.processing" color="primary" type="submit">Log in</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </GuestLayout>
</template>
