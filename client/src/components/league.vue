<template>
  <div class="league">
    <div>
      <div class="icon_league"></div>
    </div>
    <span>{{leaguename}}</span>
  </div>
</template>
<script>
export default {
  props:{
    leaguename:{
      type:String
    }
  }
};
</script>
<style scoped>
.league {
  height: 48px;
  align-items: center;
  display: flex;
  color: rgba(0,0,0,0.54);
  font-size: 12px;
  text-transform: uppercase;
  box-shadow: 0 2px 3px 0 rgba(0,0,0,0.34);
  background-color: #F0F0F0;
}
.league > div:first-child {
  display: flex;
  align-items: center;
  margin-right: 8px;
}
.icon_league {
  height: 24px;
  width: 8px;
  border-radius: 4px;
  background-color: #5700af;
  box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.34);
  margin: 0 8px;
}
</style>



