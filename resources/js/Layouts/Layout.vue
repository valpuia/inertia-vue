<script setup>

import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import LocaleSwitch from '@/Components/LocaleSwitch.vue';

</script>

<template>
    <div class="flex flex-col h-screen">
        <section class="bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-200 p-4">
            <div class="container mx-auto flex justify-between items-center px-2 sm:px-6 lg:px-8">
                <Link :href="route('home')" class="font-bold text-2xl">Vuezz</Link>

                <div class="flex items-center gap-4">
                    <LocaleSwitch />

                    <ThemeToggle />

                    <Link :href="route('login')" v-if="!$page.props?.auth?.user">Login</Link>
                    <Menu as="div" class="relative ml-3" v-else>
                        <div>
                            <MenuButton class="relative flex rounded-full text-sm focus:outline-none">
                                <span class="absolute -inset-1.5" />
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full" :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user?.name}`" :alt="$page.props.auth.user?.name" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                        <MenuItems class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-gray-50 dark:bg-gray-800 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem class="hover:bg-gray-200 dark:hover:bg-gray-700 w-full text-left">
                                <Link :href="route('posts.create')" class="block px-4 py-2 text-sm">New Post</Link>
                            </MenuItem>
                            <MenuItem class="hover:bg-gray-200 dark:hover:bg-gray-700 w-full text-left">
                                <Link :href="route('logout')" method="post" as="button" type="button" class="block px-4 py-2 text-sm">Logout</Link>
                            </MenuItem>
                        </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </section>

        <main class="flex-grow bg-gray-100 dark:bg-gray-950 text-gray-950 dark:text-gray-200 pb-5">
            <slot />
        </main>
    </div>
</template>