<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="h-full w-64">
        <div class="flex flex-col">
            <div class="flex items-center justify-start gap-x-4 px-4 py-2">
                <Link
                    :href="route('mail.index')"
                    class="hover:bg-surface-100 dark:hover:bg-surface-800 block cursor-pointer items-center gap-x-4 rounded-sm px-4 py-2"
                >
                    <div class="">Inbox</div>
                </Link>
                <div></div>
            </div>
        </div>
    </div>
</template>
