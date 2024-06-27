<script setup>

import { useForm } from 'laravel-precognition-vue-inertia';
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputField from '@/Components/InputField.vue'
import Button from '@/Components/Button.vue'

const form = useForm('post', route('authenticate'), {
    email: '',
    password: '',
});

const authenticate = () => form.submit();

</script>

<template>
    <Head title="Login" />
    
    <div class="container mx-auto py-8 px-2 sm:px-6 lg:px-8">
        <div class="mx-auto w-1/4 border dark:border-gray-500 p-4 rounded-xl shadow">
            <div class="text-center text-3xl py-5">
                Welcome
            </div>
            <form @submit.prevent="authenticate">
                <div>
                    <InputLabel for="email">{{ $t('Email') }}</InputLabel>
                    <InputField type="email" v-model="form.email" id="email" required />
                    <InputError class="mt-1" :message="form.errors.email" />
                </div>

                <div class="mt-6">
                    <InputLabel for="password">{{ $t('Password') }}</InputLabel>
                    <InputField type="password" v-model="form.password" id="password" required />
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>

                <div class="mt-6">
                    <Button type="submit" :disabled="form.processing">Login</Button>
                </div>
            </form>
        </div>
    </div>
</template>