<template>
  <div class="prediction" :style="bg">
    <div class="icongold"><img :src="setIcon(items,live)" alt="" width="24" height="24" :key="1233"></div>
    <div class="teamname" :style="{'min-width':marquee?'73px':''}">
      <span :class="{'marquee':marquee}">{{items.pick_hdp=="H"?items.team_home:items.team_away}}</span>&nbsp;
    </div>
    <resize-observer @notify="handleResize" />
    <div class="odds">
      <span v-show="live!='pregame'">&nbsp;{{'['+items.score_home+':'+items.score_away+']'}}</span>
      <span>{{items.sys_hdp}}</span>
      <span>@</span>
      <span>{{items.pick_hdp=="H"?items.sys_odds_home:items.sys_odds_away}}</span>
    </div>
    <div class="timer" v-show="live=='inplay'">
      <countdown :items="items"></countdown>
    </div>
    <div class="timer" v-show="live=='expiredinplay'">
      <span>{{'expired['+items.minutes+'\']'}}</span>
    </div>
    <div class="new" v-show="isnew">
      <span>new</span>
    </div>
  </div>
</template>
<script>
import pred_gold from "../../assets/images/pred_gold.svg";
import lose_icon from "../../assets/images/lose_icon@1x.svg";
import win_icon from "../../assets/images/win_icon@1x.svg";
import draw_icon from "../../assets/images/draw_icon@1x.svg";
import countdown from "./countdown";
export default {
  props: {
    live: {
      type: String
    },
    items: {
      type: Object
    }
  },
  data() {
    return {
      bg: {
        backgroundColor: "",
        color: ""
      },
      icon: pred_gold,
      marquee: false,
      isnew: false
    };
  },
  components: {
    countdown
  },
  methods: {
    setIcon(data, live) {
      var url = pred_gold;
      let score_home = parseInt(data.score_home);
      let score_away = parseInt(data.score_away);
      let hpd = Math.abs(parseFloat(data.sys_hdp));
      if (live == "expiredinplay" || live == "expiredpregame") {
        switch (data.pick_hdp) {
          case "H":
            if (hpd + score_home > score_away) {
              url = win_icon;
              this.bg.backgroundColor = "#69AE72";
              this.bg.color = "#fff";
            } else if (hpd + score_home < score_away) {
              url = lose_icon;
            } else {
              url = draw_icon;
            }
            break;
          default:
            if (hpd + score_away > score_home) {
              url = win_icon;
              this.bg.backgroundColor = "#69AE72";
              this.bg.color = "#fff";
            } else if (hpd + score_away < score_home) {
              url = lose_icon;
            } else {
              url = draw_icon;
            }
            break;
        }
      }
      return url;
    },

    handleResize() {
      var length = this.$el.querySelector(".teamname span").offsetWidth;
      if (length > 75) {
        this.marquee = true;
      } else {
        this.marquee = false;
      }
    },
    setStatusNew() {
      var timeprediction = new Date(this.items.time);
      var currentTime = new Date();
      let self = this;
      if (currentTime.getTime() - timeprediction.getTime() <= 5000) {
        this.isnew = true;
        setTimeout(() => {
          self.isnew = false;
        }, 30000);
      } else {
        this.isnew = false;
      }
    }
  },
  created() {
    switch (this.live) {
      case "inplay":
        // this.bg.backgroundColor = "#FEE1E1";
        var minutes = parseInt(this.items.minutes);
        var predictionTime = new Date(this.items.time).getTime();
        var currentTime = new Date().getTime();
        if (minutes < 70) {
          if (currentTime - predictionTime > 13 * 60000) {
            this.bg.backgroundColor = "#F0F0F0";
          } else {
            this.bg.backgroundColor = "#FEE1E1";
          }
        } else {
          if (currentTime - predictionTime > 6 * 60000) {
            this.bg.backgroundColor = "#F0F0F0";
          } else {
            this.bg.backgroundColor = "#FEE1E1";
          }
        }
        break;
      case "pregame":
        this.bg.backgroundColor = "#C8E6F7";
        break;
      default:
        this.bg.backgroundColor = "#f0f0f0";
        this.bg.color = "rgba(51,51,51,0.45)";
      // this.icon=lose_icon;
    }
    this.setStatusNew();
  }
  // watch: {
  //   items() {
  //     let self = this;
  //     setTimeout(() => {
  //       self.items.newprediction = false;
  //     }, 60000);
  //   }
  // }
};
</script>
<style scoped>
.prediction {
  height: 40px;
  display: flex;
  align-items: center;
  padding-right: 7px;
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
  position: relative;
  white-space: nowrap;
  overflow: hidden;
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
.marquee {
  position: absolute;
  /* min-width: 77px; */
  animation: leftmarquee 5s linear infinite;
}
@keyframes leftmarquee {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}
</style>


