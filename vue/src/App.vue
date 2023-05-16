<template>

  <Sidebar/>
  <div :style="{'margin-left': sidebarWidth}">
    <router-view/>
  </div>

<RouterView/>
</template>

<script >
import  Sidebar  from '@/components/NavbarComponent/Sidebar.vue'
import {SIDEBAR_WIDTH, sidebarWidth} from "@/components/NavbarComponent/state";
import {RouterView} from 'vue-router'

export default {
  components: Sidebar,
  setup(){
    return {sidebarWidth}
  }
}

</script>
<!--<script>
import Sidebar from "@/components/NavbarComponent/Sidebar.vue";
import {sidebarWidth} from "@/components/NavbarComponent/state";

export default {
  components: Sidebar,
  setup(){
    return {sidebarWidth}
  }
}
</script>-->

<style scoped>

</style>