<template>

  <thead class="thead">
  <th v-for="element in elements" @click="emit('customTableEvent',element)">
    {{element.name}}
  </th>

  </thead>

</template>

<script setup>
const props = defineProps({
  elements:{type:Array, default:[]}
});

const emit = defineEmits(['customTableEvent']);

</script>

<style scoped>

</style>