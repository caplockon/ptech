import routes from "./routes";
import vi from "./locale/vi";
import en from "./locale/en";

export default {
    name: 'flight',
    router: routes,
    locale: {en, vi}
}
