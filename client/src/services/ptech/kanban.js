import {error, throwError} from "@/services/ptech/helpers";

export default function (http) {
    const project = {};

    project.fetch = function () {
        return http.get('/api/kanban/projects')
            .then(res => res.data.data, e => throwError(e))
    };

    project.create = function (data) {
        return http.post('/api/kanban/projects', data)
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    project.update = function (uuid, data) {
        return http.patch(`/api/kanban/projects/${uuid}`, data)
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    project.detete = function (uuid) {
        return http.delete(`/api/kanban/projects/${uuid}`)
            .then(res => res.data.data, (e) => {throw error(e).getErrorMessage()})
    };

    return {
        project
    };
}