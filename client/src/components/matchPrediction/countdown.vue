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
      var milliseconds =
        parseInt(this.items.match_minute) > 70 ? 3 * 60000 : 10 * 60000;
      var countdownStore = localStorage.getItem(this.items.match_code);
      this.countdown = milliseconds;
      if (
        countdownStore == null ||
        JSON.parse(countdownStore).expired == "expired"
      ) {
        var objectCountdown = {
          oldDate: new Date().getTime(),
          timer: milliseconds,
          expired: "expired"
        };
        if (countdownStore == null) {
          localStorage.setItem(
            this.items.match_code,
            JSON.stringify(objectCountdown)
          );
          self.countdown = milliseconds;
        } else {
          var jsonStore = JSON.parse(countdownStore);
          var now = new Date().getTime() - jsonStore.oldDate;
          self.countdown = self.countdown - now;
        }
        var x = setInterval(function() {
          var distance = self.countdown - 1000;
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          self.time = minutes + "m " + seconds + "s";
          self.countdown = distance;
          if (distance < 0) {
            clearInterval(x);
            self.time = "expired";
            var milliseconds = 3 * 60000;
            var objectCountdown = {
              oldDate: new Date().getTime(),
              timer: milliseconds,
              expired: "expiredinplay"
            };
            localStorage.setItem(
              self.items.match_code,
              JSON.stringify(objectCountdown)
            );
            self.remainExpired();
          }
        }, 1000);
      } else {
        this.remainExpired();
      }
    },

    remainExpired() {
      var self = this;
      var countdownStore = localStorage.getItem(this.items.match_code);
      var jsonStore = JSON.parse(countdownStore);
      var now = new Date().getTime() - jsonStore.oldDate;
      self.countdown = jsonStore.timer;
      self.countdown = self.countdown - now;
      var x = setInterval(function() {
        var distance = self.countdown - 1000;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        self.time = "expired " + minutes + "m " + seconds + "s";
        self.countdown = distance;
        if (distance < 0) {
          clearInterval(x);
          self.time = "expired";
          // var match=self.$root.$data.inplayExpired.find(x=>x['match_code']==self.items.match_code)
          // if(match==undefined){
          //   self.$root.$data.inplayExpired.push(self.items)
          // }
        }
      }, 1000);
    }
  },
  created() {
    this.convertToMil();
  }
};
</script>

