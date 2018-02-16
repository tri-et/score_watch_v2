<template>
  <div class="match">
    <div class="minutes" v-show="typematch=='inplay'">
      <span class="live"></span>
      <span>'86</span>
    </div>
    <div class="match_time" v-show="typematch=='pregame'">
      <span>14:20</span>
    </div>
    <div class="match_time_ft" v-show="typematch=='expired'">
      <span>FT</span>
      <span>14:20</span>
    </div>
    <div class="teamname">
      <span>Manchester united</span>
      <span>Liverpool</span>
    </div>
    <div class="score" v-show="typematch!='pregame'">
      <span>1</span>
      <span>1</span>
    </div>
    <div class="time" v-show="typematch=='pregame'">
      <span>live</span>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    typematch: {
      type: String
    }
  }
};
</script>
<style scoped>
.match {
  background-color: #fff;
  display: flex;
  padding: 7px 0px;
  line-height: 1.5;
  font-size: 14px;
}
.minutes {
  display: flex;
  align-items: center;
  width: 44px;
  justify-content: left;
}
.match_time {
  display: flex;
  align-items: center;
  width: 44px;
  justify-content: center;
  color: rgba(0, 0, 0, 0.34);
}
.match_time_ft {
  display: grid;
  width: 44px;
  text-align: center;
  color: rgba(0, 0, 0, 0.34);
}

.match_time_ft > span:first-child {
  font-weight: 700;
  color: #000;
}
.teamname {
  display: grid;
  flex: 1;
}
.score {
  display: grid;
  width: 30px;
}
.live {
  height: 10px;
  width: 6px;
  background-color: #8ce898;
  border-bottom-right-radius: 20px;
  border-top-right-radius: 20px;
  margin-right: 10px;
}

.time{
  color: #69AE72;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: 700;
}
</style>


