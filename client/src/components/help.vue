<template>
  <div class="help" :class="{'is-visible':isopenHelp}">
    <div class="help-content" onclick="event.cancelBubble=true;">
      <div class="help-content--header">
        <span>Help & Info</span>
        <span>A quick overview of how to make the most of Score.Watch</span>
        <span class="btnclosemenu" @click="closeHelp()">&times;</span>
      </div>
      <div class="help-content--content">
        <ul>
          <li>
            <div><img src="../assets/images/help-1.png" alt="">
            </div>
            <div>
              <span>Keep an eye on Predictions</span>
              <span>Using our deep information network, our algorithms calculate and deduce the most likely outcome of the match. Each prediction is valid for a set amount of time, so be sure to keep an eye out for its validity!</span>
            </div>
          </li>
          <li>
            <div><img src="../assets/images/help-2.png" alt="">
            </div>
            <div>
              <span>Pre-Game & In-Play Predictionss</span>
              <span>For matches that are live, the In-Play Predictions are updated constantly, taking into account changes to the match as it plays out. All In-Play matches are colored orange. Matches that are yet to be played, or are ‘Pre-game’, are colored green.</span>
            </div>
          </li>
          <li>
            <div><img src="../assets/images/help-3.png" alt="">
            </div>
            <div>
              <span>Handicaps, Odds & OUs</span>
              <span>In a Match’s details screen, Odds for the match outcome, and if available, the Over-Under [a fixed amount of goals - OU] are shown. Handicaps under the Odds represent the amount by which the home team’s score is adjusted at the end of the match</span>
            </div>
          </li>
          <li>
            <div><img src="../assets/images/help-4.png" alt="">
            </div>
            <div>
              <span>Expired Predictions</span>
              <span>Once a match has been completed, the last made predictions are shown along with the actual outcome of the match. Matches that have recently just been completed will stay in their respective sections for a short duration before being moved to the Expired sections.</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import help1 from "../assets/images/help-1.png"
export default {
  methods:{
    closeHelp(){
      this.$store.commit('setisopenHelp',false)
    }
  },
  computed: {
    ...mapGetters(["isopenHelp"])
  }
};
</script>
<style scoped>
.help {
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  position: absolute;
  z-index: 2;
  display: none
}
.is-visible{
  display: block !important;
}
.help-content {
  background-color: #ffffff;
  border-radius: 4px;
  max-width: 700px;
  min-width: 300px;
  position: absolute;
  top: 0;
  left: 10px;
  right: 10px;
  bottom: 0;
  margin: auto;
  min-height: 200px;
  max-height: 547px;
}
.help-content--header {
  border-bottom: 1.5px solid rgba(0, 0, 0, 0.2);
  display: grid;
  text-align: center;
  line-height: 2.1;
}
.help-content--header span:first-child {
  font-size: 24px;
  font-weight: bold;
  color: #666;
}

.help-content--header span:nth-child(2) {
  padding-bottom: 10px;
  font-size: 12px;
  color: #a6a6a6;
}
.btnclosemenu {
  position: absolute;
  right: 10px;
  top: 0;
  font-size: 35px;
  font-weight: 500;
  color: #36569b;
  cursor: pointer !important;
  line-height: 1;
}

.help-content--content {
  overflow-x: hidden;
  bottom: 0px;
  border-radius: 4px;
  margin-right: 2px;
  top: 86px;
  position: absolute;
}
.help-content--content ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.help-content--content li {
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
  display: table;
  padding: 15px;
}

.help-content--content li div:first-child {
  display: table-cell;
  vertical-align: middle;
  padding-right: 15px;
}

.help-content--content li div:first-child img {
  width: 80px;
}
.help-content--content li div:nth-child(2) {
  display: inline-grid;
}
.help-content--content li div:nth-child(2) span:first-child {
  color: #6a6a6a;
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}
.help-content--content li div:nth-child(2) span:nth-child(2) {
  line-height: 1.4;
  font-size: 12px;
  color: #a4a4a4;
}
.help-content--content li:last-child {
    border-bottom: none;
}
</style>


