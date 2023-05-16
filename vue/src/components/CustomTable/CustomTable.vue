<template>
<table class="table">
  <CustomTableHeader
      :elements = 'elements'
      @customTableEvent = '(element) => show(element.name)'
  />
</table>
</template>

<script setup>
import CustomTableHeader from "@/components/CustomTable/children/CustomTableHeader.vue";


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

function show(element){
  console.log(element);
}
</script>

<style scoped>

</style>