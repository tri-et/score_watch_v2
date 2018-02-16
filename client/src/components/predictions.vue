<template>
  <div class="prediction">
    <div class="container-predictions">
      <div class="calendar">calendar</div>
      <div class="cls"></div>
      <div class="inplay-pregame-container">
        <div class="inplay-prediction">
          <div class="headerInplay">in-play</div>
          <league leaguename="english premier league"></league>
          <matchprediction typeprediction="inplay"></matchprediction>
          <league></league>
          <matchprediction typeprediction="inplay"></matchprediction>
          <div class="headerExpired">Expired in-play</div>
          <league leaguename="international tournament"></league>
          <matchprediction typeprediction="expired"></matchprediction>
        </div>
        <div class="pregame-prediction">
          <div class="headerPregame">pre-game</div>
          <league leaguename="fa premier league"></league>
          <matchprediction typeprediction="pregame"></matchprediction>
          <div class="headerExpired">Expired in-play</div>
          <league leaguename="english premier league"></league>
          <matchprediction typeprediction="expired"></matchprediction>          
        </div>
      </div>
      <div class="cls"></div>
    </div>
    <div class="container-detail">
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

export default {
  components: {
    league,
    matchprediction,
    containerdetail
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
.cls {
  clear: both;
}
</style>


