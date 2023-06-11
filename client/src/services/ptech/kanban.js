import {throwError} from "@/services/ptech/helpers";

export default function (http) {
    const project = {};

    project.fetch = function () {
        return http.get('/api/kanban/projects')
            .then(res => res.data.data, e => throwError(e))
    };

    return {
        project
    };
}