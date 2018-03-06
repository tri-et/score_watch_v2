<template>
  <div class="prediction">
    <div class="container-predictions">
      <div class="calendar">
        <calendar></calendar>
      </div>
      <div class="cls"></div>
      <div class="inplay-pregame-container">
        <div class="inplay-prediction">
          <div class="headerInplay">in-play</div>
          <div class="nomatch" v-show="leagueInplay.length==0">No matches to show</div>
          <template v-for="(item,index) in leagueInplay">
            <league :key="index+'inplay'" :leaguename="item.league"></league>
            <matchprediction v-for="(items,index) in inplayprediction" :key="index+items.idmatch" :items="items" v-if="item.league==items.league" typeprediction="inplay">
            </matchprediction>
          </template>
          <div class="headerExpired">Expired in-play</div>
          <div class="nomatch" v-show="leagueExpInplay.length==0">No matches to show</div>
          <template v-for="(item,index) in leagueExpInplay">
            <league :key="index+'expinplay'" :leaguename="item.league"></league>
            <matchprediction v-for="(items,index) in inplayExpired" :key="index+items.idmatch" :items="items" v-if="item.league==items.league" typeprediction="expired">
            </matchprediction>
          </template>
        </div>
        <div class="pregame-prediction">
          <div class="headerPregame">pre-game</div>
          <div class="nomatch" v-show="leaguePregame.length==0">No matches to show</div>
          <template v-for="(item,index) in leaguePregame">
            <league :key="index+'pregame'" :leaguename="item.league"></league>
            <matchprediction v-for="(items,index) in pregame" :key="index+items.idmatch" :items="items" v-if="item.league==items.league" typeprediction="pregame">
            </matchprediction>
          </template>
          <div class="headerExpired">Expired Pre-Game</div>
          <div class="nomatch" v-show="leagueExpPregame.length==0">No matches to show</div>
          <template v-for="(item,index) in leagueExpPregame">
            <league :key="index+'exppregame'" :leaguename="item.league"></league>
            <matchprediction v-for="(items,index) in expiredPregame" :key="index+items.idmatch" :items="items" v-if="item.league==items.league" typeprediction="expired">
            </matchprediction>
          </template>
        </div>
      </div>
      <div class="cls"></div>
    </div>
    <div class="container-detail" :class="{'container-detail-visible':isOpenDetailPrediction}">
      <div class="detail">
        <containerdetail></containerdetail>
      </div>
    </div>
  </div>
</template>
<script>
import league from "@/components/league";
import matchprediction from "@/components/matchPrediction/matchPrediction";
import containerdetail from "@/components/detailprediction/containerdetail";
import calendar from "@/components/matchPrediction/calendar";
import GetData from "../modules/get_data";
import { mapGetters} from "vuex";
let getdata = new GetData();

export default {
  name:'predictions',
  data() {
    return {
      inplayprediction: [],
      inplayExpired: [],
      pregame: [],
      expiredPregame: [],
      leagueExpInplay: [],
      leagueExpPregame: [],
      leagueInplay: [],
      leaguePregame: [],
      getData:getdata
    };
  },
  components: {
    league,
    matchprediction,
    containerdetail,
    calendar
  },
  computed: {
    ...mapGetters(["isOpenDetailPrediction"])
  },
  mounted() {
    var today=new Date()
    var dateselect=today.getFullYear() + '-' + (parseInt(today.getMonth()) + 1) + '-' + (today.getDate())
    getdata.getDataPreInplay(this,dateselect);
  }
};
</script>

<style scoped>
@media (min-width: 320px) {
  .container-detail {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
  }

  .container-predictions {
    width: 100%;
  }
  .prediction {
    z-index: 2;
  }
  .inplay-pregame-container {
    display: grid !important;
    justify-items: center;
    left: 0;
    right: 0;
  }
}
@media (min-width: 480px) {
  .detail {
    max-width: 456px;
  }
}

@media (min-width: 672px) {
  .container-detail {
    position: inherit;
    width: calc(100% - 352px);
    max-width: 512px;
    min-width: 320px;
  }
  .container-predictions {
    max-width: 352px;
  }
  .detail {
    max-width: 512px;
    min-width: 320px;
  }
  .prediction {
    z-index: 0;
  }
}
@media (min-width: 865px) {
  .container-predictions {
    max-width: calc(100% - 512px);
  }
}
@media (min-width: 1248px) {
  .inplay-prediction {
    max-width: 340px !important;
  }
  .pregame-prediction {
    max-width: 340px !important;
  }
  .inplay-pregame-container {
    display: flex !important;
    justify-content: center;
    left: 10px;
    right: 10px;
  }
  .inplay-prediction {
    margin-right: 10px;
  }
}
@media (min-width: 1568px) {
  .inplay-prediction {
    max-width: 360px !important;
  }
  .pregame-prediction {
    max-width: 360px !important;
  }
  .inplay-pregame-container {
    display: flex !important;
    justify-content: center;
    left: 10px;
    right: 10px;
  }
  .inplay-prediction {
    margin-right: 10px;
  }
}
.prediction {
  background-color: #333;
  flex: 1;
}
.container-predictions {
  float: left;
  background-color: #444;
  height: 100%;
  position: relative;
}
.container-detail {
  background-color: rgba(0, 0, 0, 0.5);
  height: 100%;
  float: right;
  transform: translateX(0);
  transition: transform 0.5s linear;
}
.container-detail-visible{
  transform: translateX(100%);
}


.detail {
  background-color: white;
  float: right;
  width: 100%;
  height: 100%;
}

.inplay-prediction {
  width: 100%;
  max-width: 360px;
}
.pregame-prediction {
  width: 100%;
  max-width: 360px;
  min-width: 320px;
}
.calendar {
  height: 64px;
  background-color: #333;
}
.inplay-pregame-container {
  overflow-x: hidden;
  position: absolute;
  top: 64px;
  bottom: 0;
  -webkit-overflow-scrolling: touch;
}
.headerInplay {
  width: 100%;
  min-width: 320px;
  max-width: 360px;
  height: 48px;
  background-color: #ff7c7c;
  color: #fff;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  text-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.5);
  margin-top: 15px;
}

.headerPregame {
  width: 100%;
  min-width: 320px;
  max-width: 360px;
  height: 48px;
  background-color: #5bb6e7;
  color: #fff;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  text-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.5);
  margin-top: 15px;
}
.headerExpired {
  width: 100%;
  min-width: 320px;
  max-width: 360px;
  height: 48px;
  background-color: #767676;
  color: #fff;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  text-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.5);
  margin-top: 15px;
}
.nomatch{
background-color: #F0F0F0;
height: 100px;
color:#B7B7B7;
display: flex;
align-items: center;
justify-content: center;
}
.cls {
  clear: both;
}
</style>


