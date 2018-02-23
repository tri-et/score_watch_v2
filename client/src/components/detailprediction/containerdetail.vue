<template>
  <div class="containerdetail">
    <tabbar></tabbar>
    <predictiondetail live="inplay" :items="dataSelectedPrediction"></predictiondetail>
    <headerdetail></headerdetail>
    <div class="content-detail">
      <headerodd></headerodd>
      <div class="detail-odd">
        <div class="m8">
          <div>
            <span>M8</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.sys.hdp}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.sys.odds_home"></oddou>
          <oddou :items="dataSelectedPrediction.sys.odds_away"></oddou>
        </div>
        <div class="m8">
          <div>
            <span>SBO</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.sbo.hdp}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.sbo.odds_home"></oddou>
          <oddou :items="dataSelectedPrediction.sbo.odds_away"></oddou>
        </div>
        <div class="m8">
          <div>
            <span>IBC</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.ibc.hdp}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.ibc.odds_home"></oddou>
          <oddou :items="dataSelectedPrediction.ibc.odds_away"></oddou>
        </div>
      </div>
      <headerou></headerou>
      <div class="detail-odd">
        <div class="m8">
          <div>
            <span>M8</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.sys.ou}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.sys.odds_over"></oddou>
          <oddou :items="dataSelectedPrediction.sys.odds_under"></oddou>
        </div>
        <div class="m8">
          <div>
            <span>SBO</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.sbo.ou}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.sbo.odds_over"></oddou>
          <oddou :items="dataSelectedPrediction.sbo.odds_under"></oddou>
        </div>
        <div class="m8">
          <div>
            <span>IBC</span>
          </div>
          <div>
            <span>{{dataSelectedPrediction.ibc.ou}}</span>
          </div>
          <oddou :items="dataSelectedPrediction.ibc.odds_over"></oddou>
          <oddou :items="dataSelectedPrediction.ibc.odds_under"></oddou>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
import headerdetail from "./headerdetail";
import headerodd from "./headerodd";
import headerou from "./headerou";
import predictiondetail from "./predictionDetail";
import oddou from "./oddou";
import tabbar from "./tabbar"
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["dataSelectedPrediction"])
  },
  components: {
    headerdetail,
    headerodd,
    predictiondetail,
    headerou,
    oddou,
    tabbar
  }
};
</script>
<style scoped>
.containerdetail {
  position: relative;
}
.content-detail {
  background-color: azure;
  /* overflow: scroll;
  height: 300px; */
}
.detail-odd {
  background-color: #fff;
}
.m8 {
  height: 48px;
  display: flex;
  align-items: center;
  width: 100%;
}
.m8 div {
  width: 25%;
  text-align: center;
}

.m8 div:first-child {
  text-align: left;
  padding-left: 20px;
  font-weight: 700;
  font-size: 16px;
}

.m8 div:nth-child(2) {
  color: #000;
  opacity: 0.54;
}
</style>


