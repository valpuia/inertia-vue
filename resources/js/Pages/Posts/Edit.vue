<script setup>

import { useForm } from 'laravel-precognition-vue-inertia';
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputField from '@/Components/InputField.vue'
import Button from '@/Components/Button.vue'

const props = defineProps({
    post: Object,
})

const form = useForm('put', route('posts.update', props.post),{
    title: props.post.title,
    content: props.post.content,
})

const submit = () => form.submit();

</script>

<template>
    <Head title="Edit post" />

    <div class="container mx-auto py-8 px-2 sm:px-6 lg:px-8">
        <div class="mx-auto w-1/2 border dark:border-gray-500 p-4 rounded-xl shadow">
            <div class="text-center text-3xl py-5">
                Edit Post
            </div>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="title">{{ $t('Title') }}</InputLabel>
                    <InputField type="text" v-model="form.title" id="title" required @change="form.validate('title')"/>
                    <InputError class="mt-1" :message="form.errors.title" />
                </div>

                <div class="mt-6">
                    <InputLabel for="content">{{ $t('content') }}</InputLabel>
                    <textarea rows="5" v-model="form.content" id="content" required class="w-full p-2 dark:bg-gray-900 rounded border dark:border-gray-800 focus:outline-none"></textarea>
                    <InputError class="mt-1" :message="form.errors.content" />
                </div>

                <div class="mt-6">
                    <Button type="submit" :disabled="form.processing">Update</Button>
                </div>
            </form>
        </div>
    </div>
</template>