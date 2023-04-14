import * as yup from "yup"
import {validate} from "@/utils/validation";
import {eachProp} from "@/utils/filters";
import {i18n} from "@/utils/modules";

const specs = {}; // Define specs object to be validated

specs.name = yup.string()
    .required("Flight.CreateView.ErrorEmptyFlightName");

specs.description = yup.string()
    .required("Flight.CreateView.ErrorEmptyFlightDescription");

const schema = yup.object(specs)

export const validateForm = function (value) {
    return validate(schema, value).then(validated => validated, e => {
        throw eachProp(e, (v) => i18n.global.t(v));
    });
}
