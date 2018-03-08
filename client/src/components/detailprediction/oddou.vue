<template>
  <div>
    <span>{{items.odd|setDash}}</span>
    <span class="arrow" :class="arrow"></span>
  </div>
</template>
<script>
export default {
  props: ["items"],
  data() {
    return {
      arrow: ""
    };
  },
  filters:{
    setDash(val){
      return val==''?'-':val
    }
  },
  watch: {
    items: function(newdata, oldvalue) {
      let self = this;
      if (oldvalue != undefined) {
        if (newdata.match_code == oldvalue.match_code) {
          if (parseFloat(newdata.odd) > parseFloat(oldvalue.odd)) {
            this.arrow = "up";
            setTimeout(() => {
              self.arrow = "";
            }, 3000);
          } else if (parseFloat(newdata.odd) < parseFloat(oldvalue.odd)) {
            this.arrow = "down";
            setTimeout(() => {
              self.arrow = "";
            }, 3000);
          } else {
            this.arrow = "";
          }
        }
      }
    },
    deep: true
  }
};
</script>
<style scoped>
.arrow {
  width: 0;
  height: 0;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  cursor: pointer;
  vertical-align: middle;
  display: inline-block;
  margin-left: 5px;
  opacity: 0;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}
.down {
  border-top: 7px solid #ff7754;
  opacity: 1;
}

.up {
  border-bottom: 7px solid #2ace5f;
  opacity: 1;
}
</style>


