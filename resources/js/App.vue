<script setup lang="ts">
import TopNav from "@/Components/TopNav.vue";
import SideMenu from "@/Components/SideMenu.vue";
import { RouterView } from "vue-router";
</script>

<template>
    <div class="flex min-h-dvh flex-col">
        <TopNav class="flex-none" />
        <div class="flex grow items-stretch">
            <SideMenu class="flex-none" />
            <div class="grow">
                <Suspense>
                    <RouterView />
                </Suspense>
            </div>
        </div>
    </div>
</template>
