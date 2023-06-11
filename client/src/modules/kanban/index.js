import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";
import {useMenuStore} from "@/stores/menu";
import {shallowRef} from "vue";
import IconSquaresPlus from "@/components/icons/IconSquaresPlus.vue";

function setup() {
    useMenuStore().addTopLevelMenuItem({
        key: 'kanban',
        label: 'Kanban',
        route: {name: 'kanban.index'},
        icon: shallowRef(IconSquaresPlus)
    })
}

export default {
    name: 'kanban',
    router: routes,
    locale: {en, vi},
    setup: setup
}
