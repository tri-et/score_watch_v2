<template>
  <div class="containerpreidction">
    <div class="matchprediction" @click="selectedPrediction(items.idmatch)" :class="{'activePrediction':items.idmatch==activePrediction}">
      <match :typematch="typeprediction" :item="items"></match>
      <template v-for="(item,index) in items.detail">
        <prediction :live="typeprediction" :items="item" :key="index" v-show="typeprediction=='expiredinplay'"></prediction>
      </template>
      <prediction :live="typeprediction" :items="items" v-show="typeprediction=='expiredpregame'"></prediction>
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
    ...mapGetters(["activePrediction"])
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
</style>


