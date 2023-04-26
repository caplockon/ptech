import {defineStore} from "pinia";
import {ref} from "vue";

export const useMenuStore = defineStore('menu', () => {

    const items = ref([]);

    function addTopLevelMenuItem(item) {
        item.children = item.hasOwnProperty('children') ? item.children : false;
        items.value.push(item)
    }

    function addChildLevelMenuItem(parentKey, item) {
        items.value.map(function (topLevelItem) {
            if (topLevelItem.key !== parentKey) {
                return;
            }

            if (!topLevelItem.hasOwnProperty('children') || !Array.isArray(topLevelItem.children)) {
                topLevelItem.children = [item];
            } else {
                topLevelItem.children.push(item);
            }
        });
    }

    return {items, addTopLevelMenuItem, addChildLevelMenuItem};
});