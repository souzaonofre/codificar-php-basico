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
    maskOptions: {
        type: Object,
        required: true,
        default: {
            // Decimal precision -> "90"
            precision: 2,
            // Decimal separator -> ",90"
            separator: ',',
            // Number delimiter -> "12.345.678"
            delimiter: '.',
            // Money unit -> "R$ 12.345.678,90"
            unit: 'R$',
            // Money unit -> "12.345.678,90 R$"
            suffixUnit: 'R$',
            // Force type only number instead decimal,
            // masking decimals with ",00"
            // Zero cents -> "R$ 1.234.567.890,00"
            zeroCents: true
        },
    },
    modelValue: {
        required: false,
        default: "",
    },
    placeholder: {
        type: String,
        required: false,
        default: "R$ #.###,##",
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

            <input
                v-bind:autofocus="autofocus"
                v-bind:tabindex="tabindex"
                v-bind:id="id"
                v-bind:type="type"
                v-bind:name="name"
                v-bind:maxlength="maxlength"
                v-bind:minlength="minlength"
                v-bind:placeholder="placeholder"
                v-bind:title="title"
                v-bind:disabled="disabled"
                v-bind:readonly="readonly"
                v-bind:required="required"
                class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                v-bind:class="{
                    '': true,
                    'border-red-500': hasError,
                    'border-indigo-500': hasValidation && !hasError,
                }"
                v-bind:value="modelValue"
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
