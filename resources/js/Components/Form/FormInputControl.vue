<script setup>
import { toRef, computed } from "vue";
defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    tabindex: {
        type: Number,
        required: true,
        default: -1,
    },
    id: {
        type: String,
        required: true,
        default: "inputControlId",
    },
    type: {
        type: String,
        required: true,
        default: "text",
    },
    name: {
        type: String,
        required: true,
        default: "inputControlName",
    },
    modelValue: {
        required: false,
        default: "",
    },
    placeholder: {
        type: String,
        required: false,
        default: "",
    },
    title: {
        type: String,
        required: false,
        default: "",
    },
    label: {
        type: String,
        required: true,
        default: "",
    },
    disabled: {
        type: Boolean,
        required: false,
        default: false,
    },
    readonly: {
        type: Boolean,
        required: false,
        default: false,
    },
    required: {
        type: Boolean,
        required: false,
        default: false,
    },
    hasValidation: {
        type: Boolean,
        required: false,
        default: false,
    },
    hasError: {
        type: Boolean,
        required: false,
        default: false,
    },
    errorMessage: {
        type: String,
        required: false,
        default: "",
    },
});

defineEmits(["update:modelValue"]);

const textFeedbackId = computed(() => `${props.id}-FeedbackText`);
</script>

<template>
    <div
        class="mb-3"
        v-bind:class="$attrs.rootCssClass"
        v-bind:style="$attrs.rootCssStyle"
    >
        <label v-bind:for="id" class="block">
            <span
                class="font-medium text-gray-500 text-sm pl-3"
                v-bind:class="$attrs.labelCssClass"
                >{{ label }}</span
            >

            <input
                rounded-md
                class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                v-bind:class="{
                    '': true,
                    'border-red-500': hasError,
                    'border-indigo-500': hasValidation && !hasError,
                }"
                v-bind:tabindex="tabindex"
                v-bind:id="id"
                v-bind:type="type"
                v-bind:name="name"
                v-bind:value="modelValue"
                v-bind:placeholder="placeholder"
                v-bind:title="title"
                v-bind:disabled="disabled"
                v-bind:readonly="readonly"
                v-bind:required="required"
                v-bind:aria-describedby="textFeedbackId"
                v-on:input.stop="
                    $emit('update:modelValue', $event.target.value)
                "
            />
        </label>

        <div
            v-bind:id="textFeedbackId"
            class="font-medium text-sm text-red-600"
            v-show="hasError"
        >
            {{ errorMessage }}
        </div>
    </div>
</template>

<style scoped></style>
