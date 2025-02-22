<script setup lang="ts">
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import debounce from "lodash/debounce";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";

import InputText from "primevue/inputtext";
import { ref, watch } from "vue";

const props = defineProps({
    modelValue: {
        type: [String, null],
        default: "",
    },

    placeholder: {
        type: String,
        default: "Search",
    },
    id: {
        type: String,
        default: null,
    },
    debounceMs: {
        type: Number,
        default: 300,
        required: false,
    },
    autofocus: {
        type: Boolean,
        default: false,
        required: false,
    },
});

// keep track of the value locally and emit it after a debounce
// We need to track locally so that text input doesn't jump around or not update from the debounce
const searchValue = ref(props.modelValue);

// manually define emits and modelValue so that we can debounce the input
const emit = defineEmits(["update:modelValue", "input"]);

function emitUpdate(newValue = "") {
    emit("update:modelValue", newValue);
}

const debouncedEmitUpdate = debounce(emitUpdate, props.debounceMs);

watch(searchValue, (newValue) => {
    debouncedEmitUpdate(newValue ?? "");
});

const inputText = ref<HTMLInputElement | null>(null);
</script>
<template>
    <IconField class="inline-block">
        <div class="relative">
            <InputIcon>
                <MagnifyingGlass class="w-4 fill-gray-400" />
            </InputIcon>
            <InputText
                ref="inputText"
                :autofocus="autofocus"
                class="w-full"
                :id="id"
                v-model="searchValue"
                type="search"
                :placeholder="placeholder"
            />
        </div>
    </IconField>
</template>
