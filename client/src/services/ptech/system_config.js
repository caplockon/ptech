import {throwError} from "@/services/ptech/helpers";

/**
 * Interact with Flight objects
 * @param http
 * */
export default function (http) {

    function fetch(configs) {
        return http.post(`/api/system-config`, {configs: configs})
            .then(res => res.data, e => throwError(e))
    }

    function update(configs) {
        return http.post(`/api/system-config/update`, {configs: configs})
            .then(res => res, e => throwError(e))
    }

    return {fetch, update};
};