import * as yup from "yup"
import {validate} from "@/utils/validation";
import {eachProp} from "@/utils/filters";
import i18n from "@/i18n";

const specs = {};

specs.name = yup.string()
    .required("Flight.EditView.ErrorNoNameProvided");

specs.description = yup.string()
    .required("Flight.EditView.ErrorNoDescriptionProvided");

const schema = yup.object(specs)

export const validateForm = function (value) {
    return validate(schema, value).then(validated => validated, e => {
        throw eachProp(e, i18n.global.t);
    });
}
