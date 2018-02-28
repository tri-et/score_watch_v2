<template>
  <div class="ou" :style="{'background-color':typePrediction.colorheader}">
    <div class="content-ou">
      <div>
        <span>OU</span>
      </div>
      <div>
        <span>TOTAL GOALS</span>
      </div>
      <div>
        <span>OVER</span>
      </div>
      <div>
        <span>UNDER</span>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["typePrediction"])
  }
};
</script>
<style scoped>
.ou {
  height: 55px;
  display: flex;
  align-items: flex-end;
}
.content-ou {
  /* background-color: rgb(22, 66, 66); */
  height: 55px;
  width: 100%;
  color: #fff;
  font-size: 12px;
  display: flex;
  align-items: center;
}
.content-ou div {
  width: 23.5%;
  text-align: center;
}
.content-ou div:first-child {
  text-align: left;
  padding-left: 20px;
  font-size: 16px;
  font-weight: 500;
}
</style>


