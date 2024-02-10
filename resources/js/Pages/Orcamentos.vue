<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({ view_data: Object });
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
                                <!-- Filters containers -->
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
                                <!-- End Filters containers -->

                                <!-- Table container -->
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
                                                    v-for="orcamento in view_data.data"
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
                                <!-- End Table container -->

                                <!-- Pagination container -->
                                <div
                                    class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                                >
                                    <div
                                        class="flex flex-1 justify-between sm:hidden"
                                    >
                                        <a
                                            href="#"
                                            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                            >Previous</a
                                        >
                                        <a
                                            href="#"
                                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                            >Next</a
                                        >
                                    </div>

                                    <div
                                        class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                                    >
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Visualizando de
                                                <span class="font-medium"
                                                    >1</span
                                                >
                                                até
                                                <span class="font-medium"
                                                    >10</span
                                                >
                                                no total de:
                                                <span class="font-medium">{{
                                                    view_data.total
                                                }}</span>
                                                registro(s)
                                            </p>
                                        </div>
                                        <div>
                                            <nav
                                                class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                                aria-label="Pagination"
                                            >
                                                <template
                                                    v-for="(
                                                        link, idx
                                                    ) in view_data.links"
                                                >
                                                    <template v-if="idx === 0">
                                                        <Link
                                                            :href="link.url"
                                                            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                                            :disable="
                                                                link.url
                                                                    ? false
                                                                    : true
                                                            "
                                                        >
                                                            <span
                                                                class="sr-only"
                                                            >
                                                                Anterior
                                                            </span>
                                                            <svg
                                                                class="h-5 w-5"
                                                                viewBox="0 0 20 20"
                                                                fill="currentColor"
                                                                aria-hidden="true"
                                                            >
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                                                    clip-rule="evenodd"
                                                                />
                                                            </svg>
                                                        </Link>
                                                    </template>

                                                    <template
                                                        v-if="
                                                            idx ===
                                                            view_data.links
                                                                .length -
                                                                1
                                                        "
                                                    >
                                                        <Link
                                                            :href="link.url"
                                                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                                        >
                                                            <span
                                                                class="sr-only"
                                                            >
                                                                Próximo
                                                            </span>

                                                            <svg
                                                                class="h-5 w-5"
                                                                viewBox="0 0 20 20"
                                                                fill="currentColor"
                                                                aria-hidden="true"
                                                            >
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                                    clip-rule="evenodd"
                                                                />
                                                            </svg>
                                                        </Link>
                                                    </template>

                                                    <template
                                                        v-if="
                                                            link.url &&
                                                            Number.isInteger(
                                                                parseInt(
                                                                    link.label
                                                                )
                                                            )
                                                        "
                                                    >
                                                        <Link
                                                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                                                            :class="{
                                                                'text-indigo-700 bg-gray-200':
                                                                    link.active,
                                                            }"
                                                            :href="link.url"
                                                        >
                                                            {{ link.label }}
                                                        </Link>
                                                    </template>
                                                </template>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Pagination container -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
