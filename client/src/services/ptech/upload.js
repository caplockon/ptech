import {throwError} from "@/services/ptech/helpers";

/**
 * Interact with Flight objects
 * @param http
 * */
export default function (http) {

    function uploadImage(file) {
        const formData = new FormData;
        formData.append('file', file, file.name)
        return http.post(`/api/upload/image`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => res.data, e => throwError(e))
    }

    return {uploadImage};
};