<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Filters from "./Partials/Filters.vue";
import Table from "./Partials/Table.vue";
import Paginator from "./Partials/Paginator.vue";

defineProps({ view_data: Object });
</script>

<template>
    <Head title="Orçamentos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Orçamentos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <Filters></Filters>
                                <Table
                                    :table_data="view_data.data"
                                    :modal_editar_data="
                                        view_data.modal_data ?? {}
                                    "
                                />
                                <Paginator
                                    :paginator_data="view_data"
                                ></Paginator>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
