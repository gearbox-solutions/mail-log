<script setup lang="ts">
import TopNav from "@/Components/TopNav.vue";
import SideMenu from "@/Components/SideMenu.vue";
</script>

<template>
    <div class="flex min-h-dvh flex-col">
        <TopNav class="flex-none" />
        <div class="flex grow">
            <SideMenu class="flex-none" />
            <div class="min-w-0 grow">
                <slot />
            </div>
        </div>
    </div>
</template>
