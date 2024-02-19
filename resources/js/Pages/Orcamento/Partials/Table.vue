<script setup>
import { ref, reactive } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormInputControl from "@/Components/Form/FormInputControl.vue";
import FormSelectControl from "../../../Components/Form/FormSelectControl.vue";
import FormTextareaControl from "../../../Components/Form/FormTextareaControl.vue";

defineProps({ table_data: Object, modal_editar_data: Object });
const editar_show = ref(false);
const orcamento_data = ref({});
const update_url = ref("#");
const disable_salvar = ref(false);

const formEditar = useForm({
    id_vendedor: null,
    id_cliente: null,
    descricao: null,
    valor: null,
});

const loadFormData = () => {
    formEditar.id_vendedor = orcamento_data.value.vendedor.id;
    formEditar.id_cliente = orcamento_data.value.cliente.id;
    formEditar.descricao = orcamento_data.value.descricao;
    formEditar.valor = orcamento_data.value.valor;
};

const editar = function (orcamento) {
    if (
        !orcamento ||
        Object.keys(orcamento).findIndex((key) => key == "id") < 0
    ) {
        return;
    }
    orcamento_data.value = orcamento;
    update_url.value = `/orcamento/${orcamento.id}/atualizar`;
    loadFormData();
    editar_show.value = true;
};

const updateData = () => {
    disable_salvar.value = true;
    router.put(update_url.value, formEditar, {
        onSuccess: (page) => {
            console.log(page);
            alert("Atualização realizada com sucesso.");
        },
        onError: (err) => {
            console.error(err);
            alert("Falha ao tentar atualizar dados.");
        },
        onFinish: () => {
            disable_salvar.value = false;
            editar_show.value = false;
        },
    });
};
</script>

<template>
    <!-- Table container -->
    <div class="p-1.5 w-full inline-block align-middle">
        <div class="overflow-hidden border rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <!-- <th
                        scope="col"
                        class="flex items-center px-6 py-3 text-xs font-bold text-center text-gray-500 uppercase"
                    >
                        ID
                    </th> -->

                        <th
                            scope="col"
                            class="px-2 py-3 text-xs font-bold text-center text-gray-500 uppercase"
                        >
                            <span class="inline-flex items-center"> Data </span>
                        </th>

                        <th
                            scope="col"
                            class="px-2 py-3 text-xs font-bold text-center text-gray-500 uppercase"
                        >
                            Hora
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                        >
                            <span class="inline-flex items-center">
                                Vendedor
                            </span>
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                        >
                            <span class="inline-flex items-center">
                                Cliente
                            </span>
                        </th>

                        <th
                            scope="col"
                            class="px-4 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                        >
                            Descrição
                        </th>

                        <th
                            scope="col"
                            class="px-2 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                        >
                            Valor
                        </th>

                        <th
                            scope="col"
                            class="px-4 py-3 text-xs font-bold text-center text-gray-500 uppercase"
                        >
                            Ações
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    <tr v-for="orcamento in table_data">
                        <!--
                    <td
                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"
                    >
                        {{ orcamento.id }}
                    </td>
                -->

                        <td
                            class="px-2 py-4 text-center text-sm text-gray-800 whitespace-nowrap"
                        >
                            {{ orcamento.data }}
                        </td>

                        <td
                            class="px-2 py-4 text-center text-sm text-gray-800 whitespace-nowrap"
                        >
                            {{ orcamento.hora }}
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-left text-gray-800 whitespace-nowrap"
                        >
                            {{ orcamento.vendedor?.nome }}
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-left text-gray-800 whitespace-nowrap"
                        >
                            {{ orcamento.cliente?.nome }}
                        </td>

                        <td
                            class="px-6 py-4 text-left text-sm text-ellipsis text-gray-800"
                        >
                            {{ orcamento.descricao }}
                        </td>

                        <td
                            class="px-2 py-4 text-left text-sm text-ellipsis text-gray-800"
                        >
                            {{ String(orcamento.valor).replace(".", ",") }}
                        </td>

                        <td
                            class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap"
                        >
                            <a
                                class="text-green-500 hover:text-green-700"
                                href="#"
                                @click="editar(orcamento)"
                            >
                                Editar
                            </a>
                            <a
                                class="text-red-500 hover:text-red-700 ml-3"
                                href="#"
                            >
                                Remover
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Editar Modal -->
        <Modal :show="editar_show" @close="editar_show = false">
            <div class="container mx-auto p-4">
                <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-blue-500 mb-6">
                        Editar Orçamento
                    </h2>
                    <!-- <div>{{ orcamento_data }}</div> -->
                    <form method="POST" :action="update_url">
                        <FormSelectControl
                            autofocus="autofocus"
                            tabindex="1"
                            id="selectVendedor"
                            name="id_vendedor"
                            label="Vendedor"
                            :has-error="false"
                            :options="{
                                data: modal_editar_data.vendedores ?? [],
                                idxProp: 'id',
                                valueProp: 'id',
                                labelProp: 'nome',
                            }"
                            v-model="formEditar.id_vendedor"
                        />
                        <FormSelectControl
                            tabindex="2"
                            id="selectCliente"
                            name="id_cliente"
                            label="Cliente"
                            :has-error="false"
                            :options="{
                                data: modal_editar_data.clientes ?? [],
                                idxProp: 'id',
                                valueProp: 'id',
                                labelProp: 'nome',
                            }"
                            v-model="formEditar.id_cliente"
                        />

                        <FormTextareaControl
                            tabindex="3"
                            id="inputValor"
                            name="descricao"
                            label="Descrição do Orçamento"
                            placeholder=""
                            :has-error="false"
                            v-model="formEditar.descricao"
                        />

                        <FormInputControl
                            tabindex="4"
                            id="inputValor"
                            name="valor"
                            label="Valor Orçamento"
                            placeholder=""
                            :has-error="false"
                            v-model="formEditar.valor"
                        />
                    </form>

                    <div class="p-8 max-w-md mx-auto">
                        <button
                            v-bind:disabled="disable_salvar"
                            v-on:click="updateData"
                            tabindex="5"
                            type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        >
                            Salvar
                        </button>
                        <button
                            v-on:click="editar_show = false"
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
    </div>
    <!-- End Table container -->
</template>
