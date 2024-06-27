<script setup>

defineProps({
    active: Boolean,
});

</script>

<template>
    <Link
        class="rounded-md block md:flex px-3 py-2 text-sm font-medium"
        :class="active ? 'bg-gray-300 dark:bg-gray-800' : 'hover:bg-gray-300 dark:hover:bg-gray-800'"
    >
        <slot />
    </Link>
</template>
