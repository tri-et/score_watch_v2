<template>
  <div class="containerpreidction">
    <div class="matchprediction" @click="selectedPrediction(items.match_code)" :class="{'activePrediction':items.match_code==activePrediction}">
      <match :typematch="typeprediction" :item="items"></match>
      <prediction :live="typeprediction" :items="items"></prediction>
      <overunder :live="typeprediction" :items="items"></overunder>
    </div>
  </div>

</template>
<script>
import match from "@/components/matchPrediction/match";
import prediction from "@/components/matchPrediction/prediction";
import overunder from "@/components/matchPrediction/overunder";
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
    overunder
  },
  methods: {
    selectedPrediction(matchcode) {
      this.$store.commit("setactivePrediction", matchcode);
      this.$store.commit("setdataSelectedPrediction", this.items);
      this.$store.commit("setisOpenDetailPrediction", false);
      switch (this.typeprediction) {
        case "inplay":
          this.$store.commit("settypePrediction", "#ff7c7c");
          break;
        case "pregame":
        this.$store.commit("settypePrediction", "#5bb6e7");
          break;
        default:
          this.$store.commit("settypePrediction", "#767676");
      }
    }
  },
  computed: {
    ...mapGetters(["activePrediction"])
  }
};
</script>
<style scoped>
.matchprediction {
  margin: 0 8px;
  background-color: #f0f0f0;
  cursor: pointer;
}
.containerpreidction {
  background-color: #f0f0f0;
  padding-bottom: 10px;
}
.activePrediction {
  border: solid 1px #ff7c7c;
}
</style>


