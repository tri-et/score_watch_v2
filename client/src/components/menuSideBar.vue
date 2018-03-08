<template>
  <div class="sidebar" :class="{'sidebar-visible':isopenMenuSideBar}">
    <div class="sidebar-content">
      <div @click="closeSideBar()">close</div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["isopenMenuSideBar"])
  },
  methods:{
    closeSideBar(){
      this.$store.commit('setisopenMenuSideBar',false)
    }
  }
};
</script>
<style scoped>
@media (min-width: 843px) {
  .sidebar {
    transform: translateX(-200%);
  }
}
.sidebar {
  background-color: rgba(0, 0, 0, 0.5);
  position: absolute;
  z-index: 2;
  width: 100%;
  height: 100%;
  transform: translateX(-200%);
  transition: transform 0.8s linear;
}

.sidebar-visible {
  transform: translateX(0) !important;
}

.sidebar-content {
  max-width: 360px;
  min-width: 320px;
  width: 100%;
  height: 100%;
  background-color: #ffffff;
}
</style>


