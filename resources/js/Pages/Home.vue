<script setup>

import { PencilSquareIcon, TrashIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce.js'
import { router } from '@inertiajs/vue3';
 
dayjs.extend(relativeTime);

const props = defineProps({
    posts: Object,
    filters: Object,
})

let search = ref(props.filters?.s);

watch(
    search,
    debounce(
        (e) => router.get(route('home'), { s: e }, {
            preserveState: true,
            replace: true,
        })
    )
);

</script>

<template>
    <Head title="Welcome to Vuezz" />
    <div class="container mx-auto py-8 px-2 sm:px-6 lg:px-8">
        {{ $t('welcome') }} {{ $page.props.auth.user?.name }}

        <div class="md:mx-auto md:w-1/2">
            <div class="my-2 flex sm:flex-row flex-col justify-end">
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <MagnifyingGlassIcon class="size-4" />
                    </span>
                    <input :placeholder="$t('Search...')" v-model="search" type="search"
                        class="appearance-none w-full rounded border bg-gray-50 border-gray-200 dark:border-gray-800 dark:bg-gray-900 block pl-8 pr-6 py-2 focus:outline-none" />
                </div>
            </div>

            <ul class="divide-y divide-gray-100">
                <template v-if="posts.data.length > 0">
                <li v-for="post in posts.data" :key="post.id" class="flex justify-between py-2">
                    <Link :href="route('posts.show', post.slug)" class="min-w-0 gap-x-4">
                        <p class="text-sm font-semibold leading-6">{{ post.title }}</p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-400">{{ post.slug }}</p>
                    </Link>
                    <div>
                        <div class="flex items-center justify-end" v-if="$page.props?.auth?.user">
                            <Link :href="route('posts.edit', post)">
                                <PencilSquareIcon class="size-5 text-blue-500" />
                            </Link>
    
                            <button>
                                <TrashIcon class="size-5 text-red-500" />
                            </button>
                        </div>

                        <div class="text-xs mt-1">Posted <b>{{ dayjs(post.created_at).fromNow() }}</b> by <em>{{ post.user.name }}</em></div>
                    </div>
                </li>
                </template>
                <li v-else>No post found</li>
            </ul>

            <Pagination v-if="posts.data.length" :links="posts.links" class="mt-6 flex justify-end" />
        </div>
    </div>
</template>