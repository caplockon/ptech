import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";
import {useMenuStore} from "@/stores/menu";
import IconCog8Tooth from "@/components/icons/IconCog8Tooth.vue";
import {shallowRef} from "vue";

function setup()
{
    useMenuStore().addTopLevelMenuItem({
        key: 'settings',
        label: 'Settings',
        icon: shallowRef(IconCog8Tooth)
    });

    useMenuStore().addChildLevelMenuItem('settings', {
        label: 'Site Owner',
        route: {name: 'settings.site_owner'},
    });
}

export default {
    name: 'site_info',
    router: routes,
    locale: {en, vi},
    setup: setup
}
