<script setup>
import { computed } from 'vue'

const props = defineProps({
    status: {
        type: Number,
        required: true,
    }
})

const title = computed(() => {
  return {
    503: '503: Service Unavailable',
    500: '500: Server Error',
    404: '404: Page Not Found',
    403: '403: Forbidden',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
  }[props.status]
})
</script>

<template>
    <Head :title="title" />
    <div class="container mx-auto py-8 px-2 sm:px-6 lg:px-8">
        <h1 class="font-bold text-4xl">{{ title }}</h1>
        <div class="py-2">{{ description }}</div>
    </div>
</template>