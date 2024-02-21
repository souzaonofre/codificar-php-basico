<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Filters from "./Partials/Filters.vue";
import Table from "./Partials/Table.vue";
import Paginator from "./Partials/Paginator.vue";
import Alert from "../../Components/Alert.vue";
import { onMounted, reactive } from "vue";

defineProps({ view_data: Object });

const alertData = reactive({
    type: "",
    message: "",
    timeout: 0,
    show: false,
});

const showAlert = (message = "", type = "info", timeout = 0) => {
    if (
        String(message).length <= 0 ||
        Array.from(["success", "error", "info", "warning"]).findIndex(
            (it) => it == type
        ) < 0
    ) {
        return;
    }
    alertData.type = type;
    alertData.message = message;
    if (timeout > 0) {
        timeout = Number.parseInt(timeout, 10) * 1000;
        setTimeout(() => {
            alertData.show = false;
        }, timeout);
    }
    alertData.show = true;
};

const hideAlert = () => {
    alertData.show = false;
    alertData.type = "";
    alertData.message = "";
    alertData.timeout = 0;
};

// Definições de variaveis de ref. reativas
// para controle de estados internos.
const editar_show = ref(false);

// onMounted(() => {
//     showAlert("teste", "info", 10);
// });

// Envia dados ao backend para atualizar Orcamento
const updateData = (id = null, formData = null) => {
    if (Number.isNaN(parseInt(id)) || id <= 0) {
        console.error("updateData: param. id invalido", [typeof id]);
        return;
    }

    if (typeof formData !== "object" || Object.keys(formData).length == 0) {
        console.error("updateData: param. formData invalido", [typeof id]);
        return;
    }

    const url = `/orcamento/${id}/atulizar`;

    router.put(url, formData, {
        onSuccess: (page) => {
            console.log(page);
            showAlert("Atualização realizada com sucesso.", "success");
        },
        onError: (err) => {
            console.error(err);
            showAlert("Falha ao tentar atualizar dados.", "error");
        },
        onFinish: () => {
            disable_salvar.value = false;
            editar_show.value = false;
        },
    });
};

// Envia dados ao backend para remover Orcamento
const removeData = (id = null) => {
    if (Number.isNaN(parseInt(id)) || id <= 0) {
        console.error("removeData: param. id invalido", [typeof id]);
        return;
    }

    if (
        !confirm(
            "Confirma a remoção dos dados deste Orçamento?",
            "Remover Orçamento"
        )
    ) {
        return;
    }

    const url = `/orcamento/${id}/remover`;

    router.delete(url, {
        onSuccess: (page) => {
            console.log(page);
            showAlert("Remoção  de dados realizada com sucesso.", "success");
        },
        onError: (err) => {
            console.error(err);
            showAlert("Falha ao tentar remover dados.", "error");
        },
        onFinish: () => {},
    });
};
</script>

<template>
    <Head title="Orçamentos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Orçamentos
            </h2>
        </template>

        <div class="pt-3 pb-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Alert
                    v-bind:type="alertData.type"
                    v-bind:message="alertData.message"
                    v-bind:timeout="alertData.timeout"
                    v-bind:show="alertData.show"
                    v-on:close-alert="hideAlert"
                />
            </div>
        </div>

        <div class="pt-3 pb-12" v-bind:class="{ 'pt-0': alertData.show }">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <Filters />
                                <Table
                                    v-bind:table_data="view_data.data"
                                    v-bind:modal_editar_data="
                                        view_data.modal_data ?? {}
                                    "
                                    v-on:alert="showAlert"
                                />
                                <Paginator :paginator_data="view_data" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
