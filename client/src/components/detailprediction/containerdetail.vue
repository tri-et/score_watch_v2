<template>
  <div class="containerdetail">
    <predictiondetail live="inplay"></predictiondetail>
    <headerdetail></headerdetail>
    <headerodd></headerodd>
  </div>
</template>
<script>
import headerdetail from "./headerdetail";
import headerodd from "./headerodd";
import predictiondetail from "./predictionDetail"
export default {
  components: {
    headerdetail,
    headerodd,
    predictiondetail
  }
};
</script>
<style scoped>
.containerdetail{
  position: relative;
}
</style>


