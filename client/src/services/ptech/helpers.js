/**
 * Normalize error of PTech service
 * @param e
 */
export const error = function (e) {

    /**
     * Return response status code
     * @returns {number|number}
     */
    function getStatusCode() {
        return e.response.status || 0;
    }

    /**
     * Return error message of server
     * @returns {*}
     */
    function getErrorMessage() {
        return e.response.data.message || res.message;
    }

    /**
     * Return the validation errors
     * @param handle
     * @returns {{}}
     */
    function getValidationErrors(handle) {
        handle = handle || ((errors) => errors[0]); // default to get the first error only
        if (getStatusCode() !== 422 || !e.response.data.errors) {
            return {};
        }

        const errors = {};
        for (let prop in e.response.data.errors) {
            errors[prop] = handle(e.response.data.errors[prop]);
        }
        return errors;
    }

    return {
        getStatusCode, getErrorMessage, getValidationErrors
    }
}

export const throwError = function (e) {
    throw error(e);
}