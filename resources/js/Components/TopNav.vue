<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import SearchInput from "@/Components/SearchInput.vue";

const form = useForm({
    search: undefined,
});
</script>

<template>
    <div class="bg-surface-300 dark:bg-surface-900 flex items-center justify-start py-2 pr-2 pl-4">
        <div class="w-60 text-lg font-bold">Mail Log</div>
        <div class="min-w-24 grow pl-2"></div>
    </div>
</template>
