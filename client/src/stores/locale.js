import {defineStore} from "pinia";
import {ref} from "vue";

const initialLocale = localStorage.getItem('locale') || 'en';

export const useLocaleStore = defineStore('locale', () => {
    const locale = ref(initialLocale);

    function setLocale(value) {
        localStorage.setItem('locale', locale.value = value)
    }

    function getLocale() {
        return locale.value;
    }

    return {setLocale, getLocale};
});