import * as yup from "yup"
import {validateWithI18n} from "@/utils/validation";

const specs = {}; // Define specs object to be validated

specs.name = yup.string()
    .required("Name of priority must not be empty");

export const validateForm = (value) => validateWithI18n(specs, value)
