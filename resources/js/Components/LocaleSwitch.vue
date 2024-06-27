<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { LanguageIcon } from '@heroicons/vue/24/outline';
import { loadLanguageAsync } from 'laravel-vue-i18n';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: String,
        default: 'py-1 bg-white dark:bg-gray-800',
    },
});

const page = usePage();
const open = ref(false);
const locale = computed(() => page.props.locale);
const languages = computed(() => page.props.languages);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';
    } else if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';
    } else {
        return 'origin-top';
    }
});

const switchTheme = (locale) => {
    router.post(route('locale', locale), {}, {
        onSuccess: () => loadLanguageAsync(locale),
    });
};
</script>

<template>
    <div class="relative">
        <div @click="open = !open">
            <span class="inline-flex rounded-md">
                <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 uppercase">
                    {{ locale.substr(0, 2) }}

                    <LanguageIcon class="ms-2 -me-0.5 h-4 w-4" />
                </button>
            </span>
        </div>

        <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div>

        <Transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <div v-show="open" class="absolute z-50 mt-2 rounded-md shadow-lg w-28" :class="alignmentClasses"
                style="display: none" @click="open = false">
                <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
                    <button v-for="(lang, key) in languages" :key="key" @click="switchTheme(key)"
                        class="flex hover:bg-gray-100 dark:hover:bg-gray-900 w-full text-left cursor-pointer py-2 px-3 focus:outline-none focus:ring rounded truncate whitespace-nowrap text-gray-500 active:text-gray-600 dark:text-white dark:hover:text-gray-400 dark:active:text-gray-600">
                        <span
                            class="flex items-center justify-center flex-shrink-0 w-7 h-7 p-2 text-xs font-semibold group-hover:bg-white group-hover:text-blue-600 group-hover:border group-hover:border-blue-500/10 group-focus:text-white bg-blue-500/10 text-blue-600 rounded-full mr-2">
                            {{ key.substr(0, 2) }}
                        </span> {{ lang }}
                    </button>
                </div>
            </div>
        </Transition>
    </div>
</template>
