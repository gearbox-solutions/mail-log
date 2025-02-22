<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Card } from "primevue";
import AttachmentIcon from "@/Components/Icons/AttachmentIcon.vue";
import { PropType, ref, watch } from "vue";
import Mail from "@/Types/Mail";
import PaginatedData from "@/Types/PaginatedData";
import dayjs from "dayjs";
import Paginator from "primevue/paginator";
import { router } from "@inertiajs/vue3";
import SearchInput from "@/Components/SearchInput.vue";
import DatePicker from "primevue/datepicker";

defineProps({
    paginatedMail: {
        type: Object as PropType<PaginatedData<Mail>>,
        required: true,
    },
});

function changePage({ page }: { page: number }) {
    const goToPage = page + 1;
    router.get(route("mail.index"), { page: goToPage, search: search.value, dates: dates.value });
}

const search = ref(undefined);
const dates = ref<Array<Date | null>>(
    route().params.dates
        ? [
              route().params.dates[0] ? new Date(route().params.dates[0]) : null,
              route().params.dates[1] ? new Date(route().params.dates[1]) : null,
          ]
        : [],
);
watch([search, dates], () => {
    submitSearch();
});

function submitSearch() {
    const formattedDates = formatDates();
    router.get(
        route("mail.index"),
        {
            search: search.value,
            page: undefined,
            dates: formattedDates,
        },
        { preserveState: true, preserveScroll: true },
    );
}

function formatDates() {
    const unformattedDates = dates.value;
    if (!unformattedDates || unformattedDates.length === 0) {
        return undefined;
    }

    const filteredDates = unformattedDates.filter((date) => date !== null);
    if (filteredDates.length === 0) {
        return undefined;
    }

    const formattedDates = filteredDates.map((date) => dayjs(date).format("YYYY-MM-DD"));
    return formattedDates;
}
</script>

<template>
    <div class="p-2">
        <Card>
            <template #header>
                <div class="px-8 pt-6">
                    <form
                        @submit.prevent="submitSearch()"
                        class="flex justify-between"
                    >
                        <div>
                            <SearchInput
                                placeholder="Search"
                                fluid
                                v-model="search"
                            />
                        </div>
                        <div>
                            <DatePicker
                                v-model="dates"
                                selection-mode="range"
                                :manual-input="false"
                                show-button-bar
                                date-format="m/d/y"
                            />
                        </div>
                    </form>
                </div>
            </template>
            <template #content>
                <Paginator
                    :rows="paginatedMail.data.length"
                    :total-records="paginatedMail.total"
                    :first="paginatedMail.from"
                    @page="changePage"
                />
                <div
                    v-for="message in paginatedMail.data"
                    :key="message.id"
                >
                    <Link
                        :href="route('mail.show', { id: message.id })"
                        class="hover:bg-surface-100 dark:hover:bg-surface-800 block items-center gap-x-4 rounded-sm px-4 py-2"
                    >
                        <div class="flex items-center justify-between">
                            <div class="">{{ message.to_email }}</div>
                            <div class="text-muted-color text-sm">
                                {{ dayjs(message.sent_at).format("MMMM D, YYYY h:mm A") }}
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm">{{ message.subject }}</div>
                            <div class="text-muted-color">
                                <div
                                    v-if="message.attachments.length > 0"
                                    class="flex items-center gap-x-1"
                                >
                                    <span>{{ message.attachments.length }}</span>
                                    <AttachmentIcon class="size-3" />
                                </div>
                            </div>
                        </div>
                        <div class="flex max-w-full min-w-0">
                            <div
                                class="text-muted-color max-w-full min-w-0 grow basis-0 overflow-hidden text-sm text-ellipsis whitespace-nowrap"
                            >
                                {{ message.content_text }}
                            </div>
                        </div>
                    </Link>
                </div>
                <div v-if="paginatedMail.data.length === 0">
                    <div class="text-muted-color text-center">No mail found</div>
                </div>
            </template>
            <template #footer>
                <Paginator
                    :rows="paginatedMail.data.length"
                    :total-records="paginatedMail.total"
                    :first="paginatedMail.from"
                    @page="changePage"
                />
            </template>
        </Card>
    </div>
</template>
