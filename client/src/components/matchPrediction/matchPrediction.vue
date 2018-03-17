<template>
  <div class="containerpreidction">
    <div class="matchprediction" @click="selectedPrediction(items.idmatch)" 
    :class="{'activeExpi':items.idmatch==activePrediction && (boderActive=='expiredpregame' || boderActive=='expiredinplay'),
    'activePrediction':items.idmatch==activePrediction && boderActive=='inplay',
    'activePregame':items.idmatch==activePrediction && boderActive=='pregame'}">
      <match :typematch="typeprediction" :item="items"></match>
      <template v-for="(item,index) in items.detail">
        <prediction :live="typeprediction" :items="item" :key="index" v-show="typeprediction=='expiredinplay'||typeprediction=='inplay'"></prediction>
      </template>
      <prediction :live="typeprediction" :items="items" v-show="typeprediction=='expiredpregame'"></prediction>
      <template v-for="(item,index) in items.detailou">
        <overunder :teamscore="{'score_home':items.score_home,'score_away':items.score_away}" :live="typeprediction" :items="item" :key="index+item.match_code"></overunder>
      </template>
      <!-- show over/under for pregame,expired pregame block -->
      <overunderpregame :live="typeprediction" :items="items" v-show="typeprediction=='expiredpregame'||typeprediction=='pregame'"></overunderpregame>
    </div>
  </div>

</template>
<script>
import match from "@/components/matchPrediction/match";
import prediction from "@/components/matchPrediction/prediction";
import overunder from "@/components/matchPrediction/overunder";
import overunderpregame from "@/components/matchPrediction/overunderpregame";
import { mapGetters } from "vuex";
export default {
  props: {
    typeprediction: {
      type: String
    },
    items: {
      type: Object
    }
  },
  components: {
    match,
    prediction,
    overunder,
    overunderpregame
  },
  methods: {
    selectedPrediction(matchcode) {
      var self=this
      this.$store.commit('sethideDetail',false)
      this.$store.commit("setactivePrediction", matchcode);
      this.$store.commit("setboderActive", this.typeprediction);
      this.$store.commit("setdataSelectedPrediction", this.items);
      this.$store.commit("setisOpenDetailPrediction", false);
     this.$store.commit("setshrink", true);
      setTimeout(() => {
          self.$store.commit("setshrink", false);
        }, 1200);
      switch (this.typeprediction) {
        case "inplay":
          this.$store.commit("settypePrediction", {
            colorheader: "#ff7c7c",
            colorprediction: "#FEE1E1"
          });
          break;
        case "pregame":
          this.$store.commit("settypePrediction", {
            colorheader: "#5bb6e7",
            colorprediction: "#C8E6F7"
          });
          break;
        default:
          this.$store.commit("settypePrediction", {
            colorheader: "#767676",
            colorprediction: "#f0f0f0"
          });
      }
    }
  },
  computed: {
    ...mapGetters(["activePrediction","boderActive"])
  }
};
</script>
<style scoped>
.matchprediction {
  margin: 0 8px;
  background-color: #f0f0f0;
  cursor: pointer;
  box-shadow: 0 4px 8px -2px rgba(0, 0, 0, 0.17);
}
.containerpreidction {
  background-color: #f0f0f0;
  padding-bottom: 10px;
}
.activePrediction {
  border: solid 1px #ff7c7c;
}
.activePregame {
  border: solid 1px #5bb6e7;
}
.activeExpi {
  border: solid 1px #767676;
}
</style>


