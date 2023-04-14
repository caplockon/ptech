import {throwError} from "@/services/ptech/helpers";

export default function (http) {

    function createAlbum(data) {
        return http.post(`/api/gallery/albums`, data)
            .then(res => res.data.data, e => throwError(e))
    }

    function getAlbums() {
        return http.get(`/api/gallery/albums`)
            .then(res => res.data, e => throwError(e))
    }

    function updateAlbum(uuid, data) {
        return http.patch(`/api/gallery/albums/${uuid}`, data)
            .then(res => res, e => throwError(e))
    }

    function deleteAlbum(uuid) {
        return http.delete(`/api/gallery/albums/${uuid}`)
            .then(res => res, e => throwError(e))
    }

    return {createAlbum, getAlbums, updateAlbum, deleteAlbum};
}