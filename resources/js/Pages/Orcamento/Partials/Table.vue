<script setup>
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import FormInputControl from "@/Components/Form/FormInputControl.vue";

defineProps({ table_data: Object });
const editar_show = ref(false);
const orcamento_data = ref({});
const update_url = ref("#");

const editar = function (orcamento) {
    if (
        !orcamento ||
        Object.keys(orcamento).findIndex((key) => key == "id") < 0
    ) {
        return;
    }
    orcamento_data.value = orcamento;
    update_url.value = `/orcamento/${orcamento.id}/atualizar`;
    editar_show.value = true;
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
                    <h2 class="text-2xl font-bold mb-6">Editar Orçamento</h2>
                    <form method="POST" :action="update_url">
                        <FormInputControl
                            id="inputValor"
                            name="valor"
                            label="Valor Orçamento"
                            placeholder=""
                            :has-error="false"
                        />
                    </form>
                </div>
            </div>
        </Modal>
    </div>
    <!-- End Table container -->
</template>
