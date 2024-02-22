<script setup>
// Define as propriedades deste cpte.
const props = defineProps({ table_data: Object });

// Define emissao de eventos deste cpte.
const emitEvent = defineEmits(["editar", "remover"]);

// Emite evento evento editar orcamento.
const editar = function (orcamento) {
    if (
        !orcamento ||
        Object.keys(orcamento).findIndex((key) => key == "id") < 0
    ) {
        return;
    }
    emitEvent("editar", orcamento);
};

// Emite evento evento remover orcamento.
const remover = function (orcamento) {
    if (
        !orcamento ||
        Object.keys(orcamento).findIndex((key) => key == "id") < 0
    ) {
        return;
    }
    emitEvent("remover", orcamento.id);
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
                    <tr v-for="orcamento in props.table_data">
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
                                @click="remover(orcamento)"
                            >
                                Remover
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Table container -->
</template>
