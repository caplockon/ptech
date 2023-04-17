import * as yup from "yup";

export const createPictureSpecs = (function () {
    const specs = {}; // Define specs object to be validated

    specs.title = yup.string()
        .required("Gallery.ModalCreatePicture.ErrorEmptyTitle");

    specs.system_path = yup.string()
        .required("Gallery.ModalCreatePicture.ErrorEmptySystemPath");

    specs.description = yup.string()
        .required("Gallery.ModalCreatePicture.ErrorEmptyDescription");

    return specs;
})();

export const editPictureSpecs = (function () {
    return createPictureSpecs;
})();