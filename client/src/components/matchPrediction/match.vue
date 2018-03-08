<template>
  <div class="match">
    <div class="minutes" v-show="typematch=='inplay'">
      <span class="live"></span>
      <span>{{item.match_minute+"\'"}}</span>
    </div>
    <div class="match_time" v-show="typematch=='pregame'">
      <span>{{item.match_dt|matchDate}}</span>
    </div>
    <div class="match_time_ft" v-show="typematch=='expired'||typematch=='expiredinplay'||typematch=='expiredpregame'">
      <span>FT</span>
      <span>{{item.match_dt|matchDate}}</span>
    </div>
    <div class="teamname">
      <span>{{item.team_home}}</span>
      <span>{{item.team_away}}</span>
    </div>
    <div class="score" v-show="typematch!='pregame'">
      <span>{{item.score_home}}</span>
      <span>{{item.score_away}}</span>
    </div>
    <div class="time" v-show="typematch=='pregame'">
      <span class="timelive" v-show="item.match_period!=''">live</span>
      <span class="timeremaining" v-show="item.match_period==''">{{item.match_dt|setremaining}}</span>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    typematch: {
      type: String
    },
    item: {
      type: Object
    }
  },
  filters: {
    setremaining(matchdate) {
      var matchDate = new Date(matchdate.replace(/-/g,'/'));
      var currentDate = new Date();
      var millisec = matchDate.getTime() - currentDate.getTime();
      var seconds = (millisec / 1000).toFixed(0);
      var minutes = Math.floor(seconds / 60);
      var hours = "";
      if (minutes > 59) {
        hours = Math.floor(minutes / 60);
        hours = hours >= 10 ? hours : "0" + hours;
        minutes = minutes - hours * 60;
        minutes = minutes >= 10 ? minutes : "0" + minutes;
      }

      seconds = Math.floor(seconds % 60);
      seconds = seconds >= 10 ? seconds : "0" + seconds;
      if (hours != "") {
        return "in " + hours + "h " + minutes + "m";
      }
      return "in " + minutes + "m";
    },
    matchDate(value) {
      var date = new Date(value.replace(/-/g,'/'));
      return (
        date.getHours() +
        ":" +
        (date.getMinutes() == 0 ? "00" : date.getMinutes())
      );
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

.time {
  /* color: #69ae72; */
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
  /* text-transform: uppercase; */
  font-size: 12px;
  /* font-weight: 700; */
}
.timeremaining {
  color: #000;
  opacity: 0.34;
}
.timelive {
  font-weight: bold;
  color: #69ae72;
  text-transform: uppercase;
}
</style>


