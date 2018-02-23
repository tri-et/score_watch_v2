<template>
  <div class="headerscore">
    <div class="homescore">{{items.score_home}}</div>
    <div class="match-time">
      <div class="hour">2H</div>
      <div class="minute">86'</div>
    </div>
    <div class="awayscore">{{items.score_away}}</div>
  </div>
</template>
<script>
export default {
  props:{
    items:{
      type:Object
    }
  }
};
</script>
<style scoped>
.headerscore {
  background-color: #fff;
  height: 64px;
  display: flex;
  align-items: center;
}
.homescore {
  height: 100%;
  align-items: center;
  display: flex;
  flex: 1;
  font-size: 28px;
  color: rgba(0, 0, 0, 0.87);
  padding-left:24px;
}
.match-time {
  height: 100%;
  width: 64px;
  display: grid;
}
.hour{
  background-color: #FF7C7C;
  border-top-left-radius: 130px;
  border-top-right-radius: 130px;
  font-size: 16px;
  font-weight: bold;
  color:#fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
.minute{
  background-color: #FF8989;
  border-bottom-left-radius: 130px;
  border-bottom-right-radius: 130px;
  font-size: 12px;
  font-weight: bold;
  color:#fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
.awayscore {
  flex: 1;
  height: 100%;
  align-items: center;
  justify-content: flex-end;
  display: flex;
  font-size: 28px;
  color: rgba(0, 0, 0, 0.87);
  padding-right:24px;
}
</style>


