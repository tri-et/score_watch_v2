<template>
  <div class="prediction" :style="bg">
    <div class="icongold"><img :src="icon" alt="" width="24" height="24" :key="1233"></div>
    <div class="teamname">Man. Utd</div>
    <div class="odds">
      <span>&nbsp;[1:1]</span>
      <span>1.1</span>
      <span>@</span>
      <span>0.91</span>
    </div>
    <div class="timer">2m 32s</div>
    <div v-show="live=='inplay'" class="new">
      <span>new</span>
    </div>
  </div>
</template>
<script>
import pred_gold from '../../assets/images/pred_gold.svg'
import lose_icon from '../../assets/images/lose_icon@1x.svg'
export default {
  props: {
    live: {
      type: String
    }
  },
  data() {
    return {
      bg: {
        backgroundColor: "",
        color: ""
      },
      icon: pred_gold
    };
  },
  methods: {
    setIcon() {
      var url=this.icontest;
      return url;
    }
  },
  created() {
    switch (this.live) {
      case "inplay":
        this.bg.backgroundColor = "#FEE1E1";
        break;
      case "pregame":
        this.bg.backgroundColor = "#C8E6F7";
        break;
      default:
        this.bg.backgroundColor = "#f0f0f0";
        this.bg.color = "rgba(51,51,51,0.45)";
        this.icon=lose_icon;
    }
  }
};
</script>
<style scoped>
.prediction {
  height: 56px;
  display: flex;
  align-items: center;
  padding-right: 7px;
  position: absolute;
  left: 15px;
  right: 15px;
  top:212px;
  border-radius: 3px;
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.17);
}
div[class="prediction"]:not(:last-child) {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.icongold {
  width: 24px;
  height: 24px;
  padding: 0 10px;
}
.teamname {
  font-weight: 700;
  font-size: 14px;
}
.odds {
  font-size: 14px;
  flex: 1;
}
.odds span:nth-child(4) {
  font-weight: 700;
}

.new {
  height: 20px;
  width: 40px;
  border-radius: 12px;
  background-color: #ff7c7c;
  box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.34);
  font-size: 10px;
  text-transform: uppercase;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 3px;
}
.timer {
  font-size: 14px;
  font-weight: 700;
}
</style>


