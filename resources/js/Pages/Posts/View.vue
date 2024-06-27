<script setup>

import { XMarkIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    post: Object,
})

</script>

<template>
    <Head :title="post.title" />

    <div class="container mx-auto py-8 px-2 sm:px-6 lg:px-8">
        <div class="relative mx-auto w-1/2 border dark:border-gray-500 p-4 rounded-xl shadow">
            <Link :href="route('home')" class="absolute top-3 right-3">
                <XMarkIcon class="size-6" />
            </Link>

            <div class="text-3xl py-5">
                {{ post.title }}
            </div>
            
            <div>
                {{ post.content }}
            </div>
        </div>
    </div>
</template>