<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Orçamentos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orçamentos vendedor: "{{ $page.props.auth.vendedor.alias }}"
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <div class="py-3 pl-2">
                                    <div class="relative max-w-xs">
                                        <label for="search" class="sr-only">
                                            Buscar
                                        </label>
                                        <input
                                            type="text"
                                            name="search"
                                            class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                            placeholder="buscar..."
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
                                </div>

                                <div
                                    class="p-1.5 w-full inline-block align-middle"
                                >
                                    <div
                                        class="overflow-hidden border rounded-lg"
                                    >
                                        <table
                                            class="min-w-full divide-y divide-gray-200"
                                        >
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
                                                        <span
                                                            class="inline-flex items-center"
                                                        >
                                                            Data
                                                        </span>
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
                                                        <span
                                                            class="inline-flex items-center"
                                                        >
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

                                            <tbody
                                                class="divide-y divide-gray-200"
                                            >
                                                <tr
                                                    v-for="orcamento in $page
                                                        .props.list"
                                                >
                                                    <!-- <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"
                                                    >
                                                        {{ orcamento.id }}
                                                    </td> -->

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
                                                        {{
                                                            orcamento.nome_cliente
                                                        }}
                                                    </td>

                                                    <td
                                                        class="px-6 py-4 text-left text-sm text-ellipsis text-gray-800"
                                                    >
                                                        {{
                                                            orcamento.descricao
                                                        }}
                                                    </td>

                                                    <td
                                                        class="px-2 py-4 text-left text-sm text-ellipsis text-gray-800"
                                                    >
                                                        {{
                                                            String(
                                                                orcamento.valor
                                                            ).replace(".", ",")
                                                        }}
                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap"
                                                    >
                                                        <a
                                                            class="text-green-500 hover:text-green-700"
                                                            href="#"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
