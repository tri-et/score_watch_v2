<template>
  <div class="tabbar">
    <div class="back" @click="back()">
      <i class="material-icons">keyboard_backspace</i><span>Back</span>
    </div>
  </div>
</template>
<script>
export default {
  methods:{
    back(){
      this.$store.commit('setisOpenDetailPrediction',true)
    }
  }
};
</script>
<style scoped>
.tabbar {
  height: 50px;
  box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.2);
  position: relative;
  color: #444;
}
.back{
  width: 70px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  
}
@media (min-width: 672px){
  .tabbar{
    display: none;
  }
}
</style>


