<script setup>

const model = defineModel({
    type: String,
    required: true,
});

</script>

<template>
    <input v-model="model" class="w-full p-2 dark:bg-gray-900 rounded border dark:border-gray-800 focus:outline-none" ref="input">
</template>