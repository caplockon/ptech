<script setup>
import {ref, unref} from "vue";
import InputText from "@/components/inputs/InputText.vue";
import InputTextarea from "@/components/inputs/InputTextarea.vue";
import InputButton from "@/components/inputs/InputButton.vue";
import {usePTechFlight} from "@/services/ptech";
import {validateForm} from "@/modules/flight/validations/create";
import {useRouter} from "vue-router";

const flight = ref({name: null, description: null}), errors = ref({name: null, description: null});

function createFlight() {
    validateForm(unref(flight)).then(validated => {
        usePTechFlight().post(validated).then(createdFlight => {
            useRouter().push({name: 'flight.edit', params: {uuid: createdFlight.uuid}})
        }).catch(e => {
            console.log(e)
            errors.value = e.getValidationErrors()
        });
    }).catch(e => {
        console.log(e)
        errors.value = e
    });

}
</script>

<template>
    <div class="block max-w-md rounded-lg bg-white p-6 dark:bg-neutral-700 m-auto">
        <form @submit.prevent="createFlight">

            <h3 class="text-3xl font-bold dark:text-white mb-4">Create new Flight</h3>

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

            <InputButton>Create</InputButton>
        </form>
    </div>
</template>