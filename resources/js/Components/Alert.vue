<script setup>
import { computed } from "vue";

const props = defineProps({
    type: {
        type: String,
        required: true,
        default: "error",
    },
    message: {
        type: String,
        required: true,
    },
    timeout: {
        type: Number,
        required: false,
        default: 1,
    },
});

const prefix = computed(() => {
    switch (props.type) {
        case "error":
            return "Erro: ";
        case "success":
            return "Sucesso: ";
        case "warning":
            return "Atenção: ";
        case "info":
            return "Info.: ";

        default:
            return "";
    }
});
</script>

<template>
    <div
        class="alert"
        v-bind:class="{
            success: props.type == 'success',
            warning: props.type == 'warning',
            info: props.type == 'info',
        }"
    >
        <span class="close-btn">&times;</span>
        <strong>{{ prefix }}</strong> {{ props.message }}
    </div>
</template>

<style scoped>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {
    background-color: #04aa6d;
}
.alert.info {
    background-color: #2196f3;
}
.alert.warning {
    background-color: #ff9800;
}

.close-btn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.close-btn:hover {
    color: black;
}
</style>
