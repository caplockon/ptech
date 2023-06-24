import {error, throwError} from "@/services/ptech/helpers";

export default function (http) {
    const project = {};

    project.fetch = function () {
        return http.get('/api/kanban/projects')
            .then(res => res.data.data, e => throwError(e))
    };

    project.get = function (uuid) {
        return http.get(`/api/kanban/projects/${uuid}`)
            .then(res => res.data.data, e => throwError(e))
    };

    project.board = function (code) {
        return http.get(`/api/kanban/board/${code}`)
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

    project.updateStatuses = function (uuid, statuses) {
        return http.put(`/api/kanban/projects/${uuid}/statuses`, {statuses: statuses})
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    project.updatePriorities = function (uuid, priorities) {
        return http.put(`/api/kanban/projects/${uuid}/priorities`, {priorities: priorities})
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    const status = {};

    status.create = (data) => {
        return http.post(`/api/kanban/statuses`, data)
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    status.update = (uuid, data) => {
        return http.patch(`/api/kanban/statuses/${uuid}`, data)
            .then(res => res.data, (e) => {throw error(e).getValidationErrors()})
    };

    status.delete = (uuid) => {
        return http.delete(`/api/kanban/statuses/${uuid}`)
            .then(res => res.data, (e) => {throw error(e).getErrorMessage()})
    };

    const priority = {};

    priority.create = (data) => {
        return http.post(`/api/kanban/priorities`, data)
            .then(res => res.data.data, (e) => {throw error(e).getValidationErrors()})
    };

    priority.update = (uuid, data) => {
        return http.patch(`/api/kanban/priorities/${uuid}`, data)
            .then(res => res.data, (e) => {throw error(e).getValidationErrors()})
    };

    priority.delete = (uuid) => {
        return http.delete(`/api/kanban/priorities/${uuid}`)
            .then(res => res.data, (e) => {throw error(e).getErrorMessage()})
    };

    return {
        project, status, priority
    };
}