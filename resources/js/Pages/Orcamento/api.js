import { router } from "@inertiajs/vue3";

export const apiSalvar = (formData = {}, cbResult = {}) => {
    const url = `/orcamento/salvar`;
    router.post(url, formData, cbResult);
};

export const apiAtualizar = (id = 0, formData = {}, cbResult = {}) => {
    const url = `/orcamento/${id}/atualizar`;
    router.put(url, formData, cbResult);
};

export const apiRemover = (id = 0, cbResult = {}) => {
    const url = `/orcamento/${id}/remover`;
    router.delete(url, cbResult);
};
