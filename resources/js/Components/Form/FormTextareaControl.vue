<script setup>
defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    tabindex: {
        type: String,
        required: false,
        default: "-1",
    },
    id: {
        type: String,
        required: true,
        default: "inputControlId",
    },
    type: {
        type: String,
        required: false,
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
    title: {
        type: String,
        required: false,
        default: "",
    },
    rows: {
        type: String,
        required: false,
        default: "7",
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
    autofocus: {
        type: String,
        required: false,
        default: "",
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
</script>

<template>
    <div class="mb-3">
        <label v-bind:for="id ?? name" class="block">
            <span class="font-medium text-gray-500 text-sm pl-3">{{
                label
            }}</span>

            <textarea
                class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                v-bind:class="{
                    '': true,
                    'border-red-500': hasError,
                    'border-indigo-500': hasValidation && !hasError,
                }"
                v-bind:autofocus="autofocus"
                v-bind:tabindex="tabindex"
                v-bind:id="id"
                v-bind:type="type"
                v-bind:name="name"
                v-bind:value="modelValue"
                v-bind:title="title"
                v-bind:rows="rows"
                v-bind:disabled="disabled"
                v-bind:readonly="readonly"
                v-bind:required="required"
                v-on:input.stop="
                    $emit('update:modelValue', $event.target.value)
                "
            />
        </label>

        <div class="font-medium text-sm text-red-600" v-show="hasError">
            {{ errorMessage }}
        </div>
    </div>
</template>

<style scoped></style>
