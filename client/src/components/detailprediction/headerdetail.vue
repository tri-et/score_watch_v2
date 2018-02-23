<template>
  <div class="headerdetail">
    <headleague :leaguename="dataSelectedPrediction.league"></headleague>
    <headerscore :items="dataSelectedPrediction"></headerscore>
    <headerteamname :teamaway="dataSelectedPrediction.team_away" :teamhome="dataSelectedPrediction.team_home"></headerteamname>
  </div>

</template>
<script>
import headleague from "./headleague";
import headerscore from "./headerscore";
import headerteamname from "./headerteamname";
import { mapGetters } from "vuex";
export default {
   computed: {
    ...mapGetters(["dataSelectedPrediction"])
  },
  components: {
    headleague,
    headerscore,
    headerteamname
  }
};
</script>
<style scoped>
.headerdetail {
  width: 100%;
  height: 240px;
}
</style>


