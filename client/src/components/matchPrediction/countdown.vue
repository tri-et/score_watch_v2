<template>
  <span>{{time}}</span>
</template>
<script>
export default {
  props: {
    items: {
      type: Object
    }
  },
  data() {
    return {
      time: "",
      countdown: 0
    };
  },
  methods: {
    convertToMil() {
      var self = this;
      var predictiontime = new Date(this.items.time);
      var currenttime = new Date();
      var milliseconds = currenttime.getTime() - predictiontime.getTime();
      if (parseInt(this.items.minutes) > 70) {
        if (milliseconds > 6 * 60000) {
          // check prediction expired ; 3m + 3m remain
          self.time = "expired[" + this.items.minutes + "']";
        } else if (milliseconds < 3 * 60000) {
          this.countdown = 3 * 60000 - milliseconds;
          this.runcountdown();
        } else if (milliseconds >= 3 * 60000 && milliseconds < 6 * 60000) {
          this.countdown = 6 * 60000 - milliseconds;
          this.remainExpired();
        }
      } else {
        if (milliseconds > 13 * 60000) {
          self.time = "expired[" + this.items.minutes + "']";
        } else if (milliseconds < 10 * 60000) {
          this.countdown = 10 * 60000 - milliseconds;
          this.runcountdown();
        } else if (milliseconds >= 10 * 60000 && milliseconds < 13 * 60000) {
          this.countdown = 13 * 60000 - milliseconds;
          this.remainExpired();
        }
      }
    },
    runcountdown() {
      var self = this;
      var x = setInterval(function() {
        var distance = self.countdown - 1000;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        self.time = minutes + "m " + seconds + "s";
        self.countdown = distance;
        if (distance < 0) {
          clearInterval(x);
          self.time = "expired";
          self.countdown = 3 * 60000;
          self.remainExpired();
        }
      }, 1000);
    },
    remainExpired() {
      var self = this;
      var x = setInterval(function() {
        var distance = self.countdown - 1000;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        self.time = "expired " + minutes + "m " + seconds + "s";
        self.countdown = distance;
        if (distance < 0) {
          clearInterval(x);
          self.time = "expired[" + self.items.minutes + "']";
          self.$parent.bg.backgroundColor='#F0F0F0'
          self.$parent.bg.live='expired'
          let rec=self.$parent.$parent.$parent.inplayprediction.find(x=>x['idmatch']==self.items.match_code)
          self.$parent.$parent.$parent.inplayExpired.push(rec)
        }
      }, 1000);
    }
  },
  created() {
    this.convertToMil();
  }
};
</script>

