<script setup>

import NavLink from '@/Components/NavLink.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const currentRoute = ref(null);

router.on('navigate', () => {
    currentRoute.value = route().current();
});

</script>

<template>
    <nav :key="currentRoute" class="space-y-1 px-2 pb-3 pt-2 md:space-y-0 md:px-0 md:pb-0 md:pt-0 md:flex md:space-x-4">
        <NavLink :href="route('home')" :active="route().current('home')">{{ $t('Home') }}</NavLink>

        <NavLink :href="route('login')" :active="route().current('login')">{{ $t('Login') }}</NavLink>
    </nav>
</template>