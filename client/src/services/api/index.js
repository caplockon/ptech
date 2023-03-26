export const useApi = function () {
    axios.get('https://jsonapi.org/articles?include=author')
}