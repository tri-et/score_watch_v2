<template>
  <div class="headerleague">
    <div>
      <div class="icon_league"></div>
      <!-- <span>ERL</span> -->
    </div>
    <div>
      <span>{{leaguename}}</span>
    </div>
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
.headerleague {
  height: 64px;
  background-color: #fff;
  display: flex;
  align-items: center;
  color:#5700af;
  font-size: 16px;
  padding-right: 24px;
}
.headerleague > div:first-child{
  display: flex;
  align-items: center;
  margin-left: 24px;
  flex: 1;
}
.icon_league {
  height: 24px;
  width: 8px;
  border-radius: 4px;
  background-color: #5700af;
  box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.34);
  margin: 0 8px 0 0;
}
</style>


