<script setup>
import { defineProps, defineEmits, ref, watch, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormInputControl from "@/Components/Form/FormInputControl.vue";
import FormSelectControl from "../../../Components/Form/FormSelectControl.vue";
import FormTextareaControl from "../../../Components/Form/FormTextareaControl.vue";

const props = defineProps({
    show: {
        type: Boolean,
        require: true,
        default: false,
    },

    lookupData: {
        type: Object,
        require: true,
        default: {
            vendedores: [],
            clientes: [],
        },
    },

    orcamentoData: {
        type: Object,
        require: false,
        default: null,
    },
});

const emitEvent = defineEmits(["save", "update", "close", "alert"]);

const currAction = ref("save");
const disableSalvar = ref(false);
const idOrcamento = ref(null);

const showStatus = computed(() => props.show);

// Estrutura de dados especializada para
// o formulario editar Orcamento
const nullFormData = {
    data_orc: null,
    hora_orc: null,
    id_vendedor: null,
    id_cliente: null,
    descricao: null,
    valor: null,
};
const formData = useForm(nullFormData);

// Preenche estrutura de dados de formulario
// com os valores de Orcamento selecionado.
const loadFormData = (dados = {}) => {
    formData.id_vendedor = dados?.vendedor?.id || null;
    formData.id_cliente = dados?.cliente?.id || null;
    formData.descricao = dados?.descricao || null;
    formData.valor = dados?.valor || null;
};

const sendEvent = () => {
    if (currAction.value === "save") {
        emitEvent("save", formData);
        emitEvent("close");
        return;
    }

    if (currAction.value === "update") {
        // delete formData.data;
        // delete formData.hora;
        emitEvent("update", idOrcamento.value, formData);
        emitEvent("close");
        return;
    }

    console.error("sendEvent: falha! currAction com valor invalido", [
        currAction,
    ]);
    emitEvent("alert", "Falha de sistema!", "error");
    return;
};

watch(showStatus, (value) => {
    if (value == true) {
        if (
            props.orcamentoData !== null &&
            Object.keys(props.orcamentoData).length > 0
        ) {
            loadFormData(props.orcamentoData);
            idOrcamento.value = props.orcamentoData.id;
            currAction.value = "update";
        } else {
            loadFormData(nullFormData);
            const dateTimeNow = String(
                new Date().toLocaleString("pt-BR")
            ).split(",");
            const timeSlices = String(dateTimeNow[1]).split(":");
            formData.data_orc = String(dateTimeNow[0]);
            formData.hora_orc = String(timeSlices[0])
                .concat(":")
                .concat(timeSlices[1]);
            idOrcamento.value = null;
            currAction.value = "save";
        }
    }
});
</script>

<template>
    <!-- Editar Modal -->
    <Modal v-bind:show="props.show" v-on:close="emitEvent('close')">
        <div class="container mx-auto p-4">
            <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
                <h2 class="text-2xl font-bold text-blue-500 mb-6">
                    {{ currAction == "save" ? "Novo" : "Editar" }}
                    Orçamento
                </h2>
                <!-- <div>{{ orcamento_data }}</div> -->
                <form>
                    <FormInputControl
                        type="text"
                        tabindex="4"
                        id="inputValor"
                        name="data"
                        label="Data"
                        maxlength="10"
                        minlength="10"
                        placeholder="dd/mm/aaaa"
                        :has-error="false"
                        v-model="formData.data_orc"
                        v-if="currAction == 'save'"
                    />
                    <FormInputControl
                        type="text"
                        tabindex="4"
                        id="inputValor"
                        name="hora"
                        label="Hora"
                        maxlength="5"
                        minlength="5"
                        placeholder="hh:mm"
                        :has-error="false"
                        v-model="formData.hora_orc"
                        v-if="currAction == 'save'"
                    />
                    <FormSelectControl
                        autofocus="autofocus"
                        tabindex="1"
                        id="selectVendedor"
                        name="id_vendedor"
                        label="Vendedor"
                        :has-error="false"
                        :options="{
                            data: props.lookupData.vendedores,
                            idxProp: 'id',
                            valueProp: 'id',
                            labelProp: 'nome',
                        }"
                        v-model="formData.id_vendedor"
                    />
                    <FormSelectControl
                        tabindex="2"
                        id="selectCliente"
                        name="id_cliente"
                        label="Cliente"
                        :has-error="false"
                        :options="{
                            data: props.lookupData.clientes,
                            idxProp: 'id',
                            valueProp: 'id',
                            labelProp: 'nome',
                        }"
                        v-model="formData.id_cliente"
                    />

                    <FormTextareaControl
                        tabindex="3"
                        id="inputValor"
                        name="descricao"
                        label="Descrição do Orçamento"
                        placeholder=""
                        :has-error="false"
                        v-model="formData.descricao"
                    />

                    <FormInputControl
                        tabindex="4"
                        id="inputValor"
                        name="valor"
                        label="Valor Orçamento"
                        placeholder=""
                        :has-error="false"
                        v-model="formData.valor"
                    />
                </form>

                <div class="p-8 max-w-md mx-auto">
                    <button
                        v-bind:disabled="disableSalvar"
                        v-on:click="sendEvent"
                        tabindex="5"
                        type="button"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                    >
                        Salvar
                    </button>
                    <button
                        v-on:click="emitEvent('close')"
                        tabindex="6"
                        type="button"
                        class="ml-3 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </Modal>
</template>
