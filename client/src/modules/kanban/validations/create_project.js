import * as yup from "yup"
import {validateWithI18n} from "@/utils/validation";

const specs = {}; // Define specs object to be validated

specs.code = yup.string()
    .required("Kanban.CreateProject.ErrorEmptyCode");

specs.name = yup.string()
    .required("Kanban.CreateProject.ErrorEmptyName");

specs.description = yup.string()
    .required("Kanban.CreateProject.ErrorEmptyDescription");

export const validateForm = (value) => validateWithI18n(specs, value)
