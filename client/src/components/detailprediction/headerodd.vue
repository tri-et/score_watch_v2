<template>
   <div class="odd">
     <div class="content-odd">
       <div><span>ODDS</span></div>
       <div><span>HANDICAP</span></div>
       <div><span>HOME</span></div>
       <div><span>AWAY</span></div>
     </div>
   </div>
</template>
<script>
export default {
  
}
</script>
<style scoped>
.odd{
  background-color: #FF7C7C;
  height: 84px;
  display:flex;
  align-items: flex-end;
}
.content-odd{
  /* background-color: rgb(22, 66, 66); */
  height: 55px;
  width: 100%;
  color:#fff;
  font-size: 12px;
  display: flex;
  align-items: center;
}
.content-odd div {
  width: 25%;
  text-align: center;
}
.content-odd div:first-child{
  text-align: left;
  padding-left: 20px;
}
</style>


