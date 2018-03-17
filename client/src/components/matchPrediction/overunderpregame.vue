<template>
  <div class="overunder" :style="bg">
    <div class="icongold"><img :src="setSrcIconUnder(items,live)" alt="" width="24" height="24" :key="1233"></div>
    <div class="teamname">{{items.pick_ou=="O"?'Over':'Under'}}&nbsp;</div>
    <div class="odds">
      <span>{{'['+items.score_home+':'+items.score_away+']'}}</span>
      <span>{{items.sys_ou}}</span>
      <span>@</span>
      <span>{{items.pick_ou=="O"?items.sys_odds_over:items.sys_odds_under}}</span>
    </div>
    <!-- <div class="timer" v-show="live=='inplay'">2m 32s</div> -->
    <!-- <div v-show="live=='inplay'" class="new">
      <span>new</span>
    </div> -->
  </div>
</template>
<script>
import pred_gold from "../../assets/images/pred_gold.svg";
import lose_icon from "../../assets/images/lose_icon@1x.svg";
import win_icon from "../../assets/images/win_icon@1x.svg";
import draw_icon from "../../assets/images/draw_icon@1x.svg";
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
      icon: lose_icon
    };
  },
  methods: {
    setSrcIconUnder(data,live) {
      let url = ''
      let ou = parseFloat(data.sys_ou)
      let finalsocre=parseInt(data.score_home)+parseInt(data.score_away)
      if (live == 'expiredinplay' || live =='expiredpregame') {
        switch (data.pick_ou) {
          case 'O':
            if (finalsocre>ou) {
              url = win_icon
              this.bg.backgroundColor = "#69AE72";
              this.bg.color='#ffffff';
            } else if (finalsocre<ou) {
              url = lose_icon
            } else {
              url = draw_icon
            }
            break
          default:
            if (ou>finalsocre) {
              url = win_icon
              this.bg.backgroundColor = "#69AE72";
              this.bg.color='#ffffff';
            } else if (ou<finalsocre) {
              url = lose_icon
            } else {
              url = draw_icon
            }
            break
        }
      } else {
        url = pred_gold
      }
      return url
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
      // this.icon=lose_icon;
    }
  }
};
</script>
<style scoped>
.overunder {
  height: 40px;
  display: flex;
  align-items: center;
  padding-right: 7px;
  /* margin-bottom: 10px; */
}
div[class="overunder"]:not(:last-child) {
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


