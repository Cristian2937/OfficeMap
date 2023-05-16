<template>
  <router-link :to="to" class="link" :class="{active: isActive}">
    <i class="icon" :class="icon"/>
    <span v-if="!collapsed">
      <slot/>
    </span>
  </router-link>

</template>

<script>
import {computed} from "vue";
import {useRoute, useRouter} from "vue-router";
import {collapsed} from "@/components/NavbarComponent/state";

const props = defineProps({
  to:{type:String, required: true},
  icon: {type: String, required:true}
})
export default {
  name: "SidebarLink",
  props: {
    to:{type:String, required: true},
    icon: {type: String, required:true}
  },
  setup(props){
    const route = useRoute();
    const isActive = (()=> route.path === props.to)
    return {isActive, collapsed}
  }
}
</script>

<style scoped>

</style>