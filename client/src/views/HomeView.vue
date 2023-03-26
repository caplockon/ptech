<script setup>
import { ref } from "vue";
import axios from "axios";
let text = 'asdasd';

function keyupSearchInput(e) {
  if (e.key === "Enter") {
    e.preventDefault();
    axios
        .get('https://api.coindesk.com/v1/bpi/currentprice.json')
        .then(response => console.log(response))
        .catch(error => console.log(error))
    return false;
  }
}
</script>

<template>
  <main class="min-h-screen flex justify-center items-center w-full">
    <div class="w-1/2">
      <label for="searchText" class="sr-only">Email CSS</label>
      <input id="searchText" name="searchText" v-model="text"
             @keyup="keyupSearchInput"
             class="rounded-md border-0 shadow-sm ring-1 px-3.5 py-3 w-full text-lg
             focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm"
      >
    </div>
  </main>
</template>
