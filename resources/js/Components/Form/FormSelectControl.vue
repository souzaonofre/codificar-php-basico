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
        default: "selectControlId",
    },
    name: {
        type: String,
        required: true,
        default: "selectControlName",
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
    modelValue: {
        required: false,
        default: null,
    },
    options: {
        type: Object,
        required: true,
        default: {
            data: [],
            labelProp: "name",
            valueProp: "id",
            idxProp: "id",
        },
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

</script>

<template>
    <div class="mb-3">
        <label class="block" v-bind:for="id ?? name">
            <span class="font-medium text-gray-500 text-sm pl-3">{{
                label
            }}</span>
            <select
                v-bind:autofocus="autofocus"
                v-bind:id="id"
                v-bind:name="name"
                v-bind:tabindex="tabindex"
                v-bind:title="title"
                v-bind:disabled="disabled"
                v-bind:readonly="readonly"
                v-bind:required="required"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                v-bind:class="{
                    '': true,
                    'border-red-500': hasError,
                    'border-indigo-500': hasValidation && !hasError,
                }"
                v-bind:value="modelValue"
                v-on:input.stop="
                    $emit('update:modelValue', $event.target.value)
                "
            >
                <template
                    v-for="opt in options.data"
                    :key="opt[options.idxProp]"
                >
                    <option
                        v-bind:value="opt[options.valueProp]"
                        v-bind:selected="opt[options.valueProp] == modelValue"
                    >
                        {{ opt[options.labelProp] }}
                    </option>
                </template>
            </select>
        </label>

        <div class="font-medium text-sm text-red-600" v-show="hasError">
            {{ errorMessage }}
        </div>
    </div>
</template>
