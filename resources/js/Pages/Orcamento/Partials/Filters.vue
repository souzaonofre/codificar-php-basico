<script setup>
import { ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const date_range = ref();

const formData = reactive({
    buscar: null,
    data_inicio: null,
    data_fim: null,
});

function sendData() {
    router.get("#", formData, { preserveState: true });
}
</script>

<template>
    <!-- Filters containers -->
    <div class="py-3 pl-2">
        <form
            class="flex space-x-4"
            style="align-content: flex-start"
            action="GET"
            @submit.prevent="sendData"
        >
            <!-- Input Buscar texto em Vendedor e Cliente -->
            <div class="relative w-3/4 max-w-xs">
                <label for="buscar" class="sr-only"> Buscar </label>

                <input
                    type="text"
                    v-model="formData.buscar"
                    @input="sendData"
                    @blur="sendData"
                    class="block w-full pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                    placeholder="  buscar por cliente ou vendedor..."
                />
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>
            </div>

            <div class="relative max-w-xs mr-auto">
                <label for="date_range" class="sr-only">
                    Filtrar por Datas
                </label>

                <VueDatePicker
                    v-model="date_range"
                    range
                    locale="pt-BR"
                    format="dd/MM/yyyy"
                    placeholder="filtrar por datas..."
                ></VueDatePicker>

                <!-- <div
                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                >
                    <svg
                        class="w-5 h-5 text-gray-400 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M18.8 4H5.2a1 1 0 0 0-.7 1.7l5.3 6 .2.7v4.8c0 .2 0 .4.2.4l3 2.3c.3.2.8 0 .8-.4v-7.1c0-.3 0-.5.2-.7l5.3-6a1 1 0 0 0-.7-1.7Z"
                        />
                    </svg>
                </div> -->
            </div>
        </form>
    </div>
    <!-- End Filters containers -->
</template>
