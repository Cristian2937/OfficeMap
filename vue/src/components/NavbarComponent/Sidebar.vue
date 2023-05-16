<template>
  <div class="sidebar" :style="{width: sidebarWidth}">
    <div>
      <span v-if="collapsed">
        <div>L</div>
        <div>M</div>
      </span>
      <span v-else>Link Managment Spa</span>
    </div>
    <span class="collapse-icon" :class="{'rotate-180': collapsed}" @click="toggleSidebar">
      <font-awesome-icon icon="fa-solid fa-angles-left" />
    </span>

  </div>

</template>

<script>
import {collapsed, toggleSidebar, sidebarWidth} from './state';

export default {
  name: "Sidebar",
  props:{},
  setup(){
    return {collapsed, toggleSidebar, sidebarWidth}
  },

}
</script>

<style >
:root{
  --sidebar-bg-color: #4e73df;
  --sidebar-item-hover: #fff;
  --sidebar-item-active: #fff;
}

</style>
<style scoped>
.sidebar {
  color: #fff;
  background-color: #4e73df;

  float: left;
  position: fixed;
  z-index: 1;
  top:0;
  left:0;
  bottom:0;
  padding: 0.5em;

  transition: 0.3s ease;
  display: flex;
  flex-direction: column;
}
.collapse-icon {
  position: absolute;
  /*bottom: 0;*/
  padding: 0.75em;
  color: #ffffff;
  transition: 0.2s linear;
}
.rotate-180{
  transform: rotate(180deg);
  transition: 0.2s linear;
}
</style>