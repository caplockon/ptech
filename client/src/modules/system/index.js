import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";
import {useMenuStore} from "@/stores/menu";
import {shallowRef} from "vue";
import IconUserCircle from "@/components/icons/IconUserCircle.vue";

function setup() {
    useMenuStore().addTopLevelMenuItem({
        key: 'system_owner',
        label: 'Owner',
        icon: shallowRef(IconUserCircle),
        route: {name: 'system.owner'}
    });
}

export default {
    name: 'system',
    router: routes,
    locale: {en, vi},
    setup: setup
}
