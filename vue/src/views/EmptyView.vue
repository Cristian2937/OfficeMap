<template>
  <div>
<!--    <form @submit.prevent="submitInput()">
      <input  type="text" name="nome" v-model="nome">
      <br>
      <input type="text" name="cognome" v-model="cognome">
      <br>
      <input type="number" name="eta" v-model="eta">

      <input type="submit">

    </form>
    <button class="btn-warning" @click="aumenta()">Count</button>
    {{increment}}-->

<!--
    <table>

      <th v-for="element in elements" @click="mostra(element.name)">
        {{element.name}}
      </th>

    </table>

    <table>
      <CustomTableHeader

      />
    </table>-->

  </div>
</template>


<script setup>

import {ref} from "vue";
import CustomTable from "@/components/CustomTable/CustomTable.vue";
import CustomTableHeader from "@/components/CustomTable/children/CustomTableHeader.vue";

const nome = ref();
const cognome = ref();
const eta = ref();

function submitInput(){
  console.log(nome.value + ' '+ cognome.value+ ' '+ eta.value);
}

const increment = ref(0);
function aumenta(){
  increment.value++;
};

function mostra(element){
  console.log(element);
}


const props = defineProps({
  element:{type: Array, default:[]}
})


const elements = [
  {
    name: "nome 1"
  },
  {
    name: "nome 2"
  },
  {
    name: "nome 3"
  }
];



</script>



<style scoped>

</style>
