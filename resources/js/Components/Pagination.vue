<script setup>

defineProps({
    links: {
        Array,
        required: true
    }
})

</script>

<template>
    <div>
        <Component :is="link.url ? 'Link' : 'span'" v-for="link in links" :href="link.url" v-html="link.label" class="px-2"
            :class="{
                'text-gray-500 dark:text-gray-400': !link.url,
                'bg-gray-200 dark:bg-gray-800': link.active
            }" preserve-scroll />
    </div>
</template>