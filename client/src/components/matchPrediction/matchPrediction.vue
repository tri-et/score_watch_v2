<template>
  <div class="containerpreidction">
    <div class="matchprediction">
      <match :typematch="typeprediction"></match>
      <prediction :live="typeprediction"></prediction>
    </div>
  </div>

</template>
<script>
import match from "@/components/matchPrediction/match";
import prediction from "@/components/matchPrediction/prediction";
export default {
  props:{
    typeprediction:{
      type:String
    }
  },
  components: {
    match,
    prediction
  }
};
</script>
<style scoped>
.matchprediction {
  /* border: solid 1px #ff7c7c; */
  margin: 0 8px;
  background-color: #f0f0f0;
}
.containerpreidction {
  background-color: #f0f0f0;
}
</style>


