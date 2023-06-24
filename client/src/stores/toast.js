import {defineStore} from "pinia";
import {ref} from "vue";
import { v4 as uuidv4 } from 'uuid'

export const useToast = defineStore('toast', () => {
    /**
     * The list of toast items
     */
    const toastItems = ref([]);

    /**
     * Maximum of shown items
     */
    const maxShownItems = 5;

    /**
     * Time-to-life of a toast item
     */
    const ttl = 8000;

    function push(item) {

        item = Object.assign({
            time:       new Date((new Date()).getTime() + ttl),
            closable:   false,
            uuid:       uuidv4()
        }, item);

        refresh();
        toastItems.value.push(item);
    }

    function pushWitStatus(item, status) {
        item = typeof item === "string" ? {message: item} : item;
        item.icon = item.hasOwnProperty('icon') ? item.icon : true;
        item.status = status;
        item.closable = item.hasOwnProperty('closable') ? item.icon : true;

        push(item);
    }

    function pushSuccess(item) {
        pushWitStatus(item, 'success')
    }

    function pushError(item) {
        pushWitStatus(item, 'danger')
    }

    function pushWarning(item) {
        pushWitStatus(item, 'warning')
    }

    function pushInfo(item) {
        pushWitStatus(item, 'info')
    }

    function isExpired(item) {

        const expiredAt = item.time.getTime();
        const now = (new Date()).getTime();

        return now >= expiredAt;
    }

    function getShownItems() {
        return toastItems.value.sort((i1, i2) => i2.time.getTime() - i1.time.getTime());
    }

    function refresh() {
        toastItems.value = toastItems.value.filter((i) => !isExpired(i))
    }

    function remove(uuid) {
        toastItems.value = toastItems.value.filter((i) => i.uuid !== uuid);
    }

    function pushComponent(component) {
        push({
            component: component
        });
    }

    setInterval(refresh, 300)

    return {getShownItems, push, remove, pushWarning, pushSuccess, pushError, pushInfo}
});
