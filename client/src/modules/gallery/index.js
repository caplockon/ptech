import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";
import {useMenuStore} from "@/stores/menu";
import {shallowRef} from "vue";
import IconPhoto from "@/components/icons/IconPhoto.vue";

function setup() {
    useMenuStore().addTopLevelMenuItem({
        key: 'gallery',
        label: 'Gallery',
        route: {name: 'gallery.index'},
        icon: shallowRef(IconPhoto)
    })
}

export default {
    name: 'gallery',
    router: routes,
    locale: {en, vi},
    setup: setup
}
