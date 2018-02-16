<template>
  <div class="headerdetail">
    <headleague></headleague>
    <headerscore></headerscore>
    <headerteamname></headerteamname>
  </div>
  
</template>
<script>
import headleague from "./headleague"
import headerscore from "./headerscore"
import headerteamname from "./headerteamname"
export default {
  components:{
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


