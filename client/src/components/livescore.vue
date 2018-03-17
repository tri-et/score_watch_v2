<template>
  <div class="livescore">
    <div class="container">
      <div class="calender">
        <calenderlivescore></calenderlivescore>
      </div>
      <div class="container-content">
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>

        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <span>dsds</span><br>
        <div class="footer">test</div>
      </div>

    </div>
    <div class="detaillivescore">right</div>
  </div>
</template>
<script>
import calenderlivescore from "@/components/livescore/calenderlivescore";
export default {
  components: {
    calenderlivescore
  }
};
</script>

<style scoped>
@media (min-width: 320px) {
  .container {
    width: 100%;
  }
  .detaillivescore {
    position: absolute;
    top: 0;
    z-index: 2;
    width: 100%;
    right: 0;
  }
}

@media (min-width: 672px) {
  .detaillivescore {
    position: inherit;
    width: calc(100% - 352px);
    max-width: 512px;
    min-width: 320px;
  }
  .container {
    max-width: 352px;
  }
}

@media (min-width: 865px) {
  .container {
    max-width: calc(100% - 512px);
  }
}

.livescore {
  background-color: #333;
  height: 100%;
}
.container {
  float: left;
  height: 100%;
  position: relative;
  /* display: flex; */
}
.detaillivescore {
  float: right;
  background-color: rgba(0, 0, 0, 0.5);
  height: 100%;
}
.calendar {
  height: 64px;
  background-color: #333;
}
.pending {
  color: #fff;
}
.container-content {
  background-color: pink;
  max-height: calc(100% - 128px);
  min-height: calc(100% - 128px);
  overflow-x: hidden;
  position: relative;
}
.footer {
  height: 64px;
  width: 100%;
  background-color: olivedrab;
  /* position: inherit;
  bottom: 0; */
}
.cls {
  clear: both;
}
</style>


