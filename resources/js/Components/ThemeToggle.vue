<script setup>

import { ref, watch, onMounted } from 'vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { SunIcon, MoonIcon, ComputerDesktopIcon } from '@heroicons/vue/20/solid'

const theme = ref(localStorage.getItem('theme'));

const setTheme = (selectedTheme) => {
    localStorage.setItem('theme', selectedTheme);
    theme.value = selectedTheme
}

const setThemeMode = () => {
    if (theme.value === 'system') {
        window.matchMedia('(prefers-color-scheme: dark)').matches ? toggleClass('dark') : toggleClass('light')
    } else {
        theme.value === 'dark' ? toggleClass('dark') : toggleClass('light')
    }
};

const toggleClass = (className) => {
    if (className === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

watch(theme, setThemeMode)

onMounted(() => {
    if (!theme.value) {
        setTheme('system')
    }

    setThemeMode();
})

</script>

<template>
    <Menu as="div" class="relative">
      <div class="flex items-center">
        <MenuButton>
            <SunIcon v-if="theme === 'light'" class="h-5 w-5" aria-hidden="true" />
            <MoonIcon v-if="theme === 'dark'" class="h-5 w-5" aria-hidden="true" />
            <ComputerDesktopIcon v-if="theme === 'system'" class="h-5 w-5" aria-hidden="true" />
        </MenuButton>
      </div>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="absolute right-0 mt-2 w-24 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none dark:bg-gray-800"
        >
            <div class="my-1">
                <MenuItem class="flex items-center py-1 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 w-full">
                    <button @click="setTheme('light')">
                        <SunIcon class="h-5 w-5 mr-2" aria-hidden="true" />
                        Light
                    </button>
                </MenuItem>

                <MenuItem class="flex items-center py-1 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 w-full">
                    <button @click="setTheme('dark')">
                        <MoonIcon class="h-5 w-5 mr-2" aria-hidden="true" />
                        Dark
                    </button>
                </MenuItem>

                <MenuItem class="flex items-center py-1 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 w-full">
                    <button @click="setTheme('system')">
                        <ComputerDesktopIcon class="h-5 w-5 mr-2" aria-hidden="true" />
                        System
                    </button>
                </MenuItem>
            </div>
        </MenuItems>
      </transition>
    </Menu>
</template>
