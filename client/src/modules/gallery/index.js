import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";
import {useMenuStore} from "@/stores/menu";

function setup() {
    useMenuStore().addTopLevelMenuItem({
        key: 'gallery',
        label: 'Gallery',
        route: {name: 'gallery.index'}
    })
}

export default {
    name: 'gallery',
    router: routes,
    locale: {en, vi},
    setup: setup
}
