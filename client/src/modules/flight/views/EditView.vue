<script setup>
import {ref} from "vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {useRoute} from "vue-router";
import {usePTechFlight} from "@/services/ptech";
import {validateForm} from "@/modules/flight/validations/edit";

const flight = ref({}), errors = ref({name: null, description: null});
const route = useRoute();

usePTechFlight().get(route.params.uuid).then(flightData => {
    flight.value = flightData;
}).catch(e => console.log(e))

function saveFlight() {
    validateForm(flight.value).then(validated => {
        beforeSaving();
        usePTechFlight().patch(route.params.uuid, validated)
            .then(successSaving)
            .catch(errorSaving)
            .finally(afterSaving);
    }).catch(e => errors.value = e);
}

function successSaving() {

}

function errorSaving(e) {
    errors.value = e.getValidationErrors();
}

function beforeSaving() {

}

function afterSaving() {

}


</script>

<template>
    <div class="block max-w-md rounded-lg bg-white p-6 dark:bg-neutral-700 m-auto">
        <form @submit.prevent="saveFlight">

            <h3 class="text-3xl font-bold dark:text-white mb-4">Edit Flight</h3>

            <!-- Flight Name -->
            <InputText v-model="flight.name" id="name" name="name"
                       placeholder="Name of flight" text-label="Name"
                       :error="errors.name" @keyup="errors.name = null"
            />

            <!-- Flight Description -->
            <InputTextarea v-model="flight.description" id="description" name="description"
                           placeholder="Description" text-label="Name of Description"
                           :error="errors.description" @keyup="errors.name = null"
                           rows="8"
            />

            <InputButton>Submit Now</InputButton>
        </form>
    </div>
</template>