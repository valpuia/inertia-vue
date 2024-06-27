<script setup lang="ts">

defineProps({
    message: String
});

</script>

<template>
    <p v-show="message" class="text-xs text-red-600">
        {{ message }}
    </p>
</template>