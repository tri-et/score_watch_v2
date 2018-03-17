import $ from 'jquery';
// export for others scripts to use

import axios from 'axios'
class GetData {
  constructor() {
    this.olddate = "";
    this.timeoutfirstload = [];
  }

  checkLeague(leaguename, leagueArray) {
    for (var i = 0; i < leagueArray.length; i++) {
      if (leagueArray[i].league == leaguename) {
        return true
      }
    }
    return false
  }

  getDataInPlay(app, dateSelect) {
    let that = this
    this.olddate = dateSelect
    $.ajax({
      url: 'http://localhost:8000/score_watch_v2/index.php/api/get_running/' + this.olddate,
      jsonp: 'callback',
      dataType: 'jsonp',
      success: function (response) {

        let data = response
        //app.inplay = data.Running
        var leagueExpInplay = []
        var leagueInplay = []
        var inplayExpired = []
        var inplayprediction = []
        app.inplayprediction = []
        app.inplayExpired = []
        data.forEach(v => {
          if (v.match_period == 'FT') {
            inplayExpired.push(v)
          } else {
            var isExpired = []
            v.detail.forEach(items => {
              var minutes = parseInt(items.minutes)
              var predictionTime = (new Date(items.time)).getTime()
              var currentTime = (new Date()).getTime()
              if (minutes < 70) {
                if (currentTime - predictionTime > 13 * 60000) {
                  isExpired.push(true);
                } else {
                  isExpired.push(false);
                }
              } else {
                if (currentTime - predictionTime > 6 * 60000) {
                  isExpired.push(true);
                } else {
                  isExpired.push(false);
                }
              }
            })

            var expired = isExpired.every(function (item, index, array) {
              return item;
            })
            if (expired) {
              inplayExpired.push(v)
            } else {
              inplayprediction.push(v)
            }
          }
        })

        for (var i = 0; i < inplayExpired.length; i++) {
          if (!that.checkLeague(inplayExpired[i].league, leagueExpInplay)) {
            leagueExpInplay.push({
              league: inplayExpired[i].league
            })
          }
        }

        for (var i = 0; i < inplayprediction.length; i++) {
          if (!that.checkLeague(inplayprediction[i].league, leagueInplay)) {
            leagueInplay.push({
              league: inplayprediction[i].league
            })
          }
        }

        app.leagueExpInplay = leagueExpInplay;
        app.inplayExpired = inplayExpired;
        app.inplayprediction = inplayprediction;
        app.leagueInplay = leagueInplay;
        var match_code_active = app.$store.getters.activePrediction
        var dataDetail = app.inplayprediction.find(x => x.match_code == match_code_active)
        if (dataDetail != undefined) {
          app.$store.commit('setdataSelectedPrediction', app.inplayprediction.find(x => x.match_code == match_code_active))
        }
        that.timeoutfirstload.push(setTimeout(() => {
          that.getDataInPlay(app, that.olddate)
        }, 3000))

      },
    })
  }

  getDataPregame(app, dateSelect) {
    let that = this
    this.olddate = dateSelect
    $.ajax({
      url: 'http://localhost:8000/score_watch_v2/index.php/api/get_pregame/' + this.olddate,
      jsonp: 'callback',
      dataType: 'jsonp',
      success: function (response) {
        let data = response
        var leaguePregame = []
        var leagueExpPregame = []
        var pregamePrediction = []
        var pregameExpired = []
        app.pregame = []
        app.expiredPregame = []
        app.leagueExpPregame = []
        app.leaguePregame = []

        data.forEach(v => {
          if (v.match_period == 'FT') {
            pregameExpired.push(v)
          } else {
            var currentdate = (new Date()).getDate()
            var match_dt = (new Date(v.match_dt)).getDate()
            if (match_dt < currentdate) {
              pregameExpired.push(v)
            } else {
              pregamePrediction.push(v)
            }
          }
        })
        for (var i = 0; i < pregamePrediction.length; i++) {
          if (!that.checkLeague(pregamePrediction[i].league, leaguePregame)) {
            leaguePregame.push({
              league: pregamePrediction[i].league
            })
          }
        }

        for (var i = 0; i < pregameExpired.length; i++) {
          if (!that.checkLeague(pregameExpired[i].league, leagueExpPregame)) {
            leagueExpPregame.push({
              league: pregameExpired[i].league
            })
          }
        }


        app.leaguePregame = leaguePregame
        app.leagueExpPregame = leagueExpPregame
        app.pregame = pregamePrediction
        app.expiredPregame = pregameExpired

        that.timeoutfirstload.push(setTimeout(() => {
          that.getDataPregame(app, that.olddate)
        }, 600000))
      },
    })
  }

  getDataExpiredPregame(app) {
    let that = this
    $.ajax({
      url: 'http://localhost:8000/score_watch_v2/index.php/api/get_expired_pregame',
      jsonp: 'callback',
      dataType: 'jsonp',
      success: function (response) {
        let data = JSON.parse(response)
        app.expiredPregame = data.MatchesFinished
      },
    })
  }

  getMatchLiveScore() {
    return axios.get(
      'http://www.hasilskor.com/API/JSON.aspx?sport=soccer&s=26PDpiffaaBbGrBdfgnrK2pknndskc1f3IMeKLW6PqdprBMHMqSTQ7gcmlcx7jZMxmyeTTBXRqwDh5p044MJHrf',
    )
  }

  getDataPreInplay(app, dateSelect) {
    let that = this
    this.olddate = dateSelect
    let urlInplay = 'http://localhost:8000/score_watch_v2/index.php/api/get_running/' + this.olddate
    let urlPregame = 'http://localhost:8000/score_watch_v2/index.php/api/get_pregame/' + this.olddate
    this.stopAlltimeout();

    $.when(
      $.ajax({
        type: 'post',
        url: urlInplay,
        dataType: 'jsonp',
      }),
      $.ajax({
        url: urlPregame,
        dataType: 'jsonp',
      })
    ).done((inplay, pregame) => {
      var oldDateSelected = that.olddate
      var leagueExpInplay = []
      var leagueInplay = []
      var leaguePregame = []
      var leagueExpPregame = []
      var inplayExpired = []
      var inplayprediction = []
      var pregamePrediction = []
      var pregameExpired = []
      let inplayData = inplay[0]
      let pregameData = pregame[0]
      let data = []
      let type = ''
      app.inplayprediction = []
      app.inplayExpired = []
      app.pregame = []
      app.expiredPregame = []
      app.leagueExpInplay = []
      app.leagueExpPregame = []
      app.leagueInplay = []
      app.leaguePregame = []
      inplayData.forEach(v => {
        if (v.match_period == 'FT') {
          inplayExpired.push(v)
        } else {
          var isExpired = []
            v.detail.forEach(items => {
              var minutes = parseInt(items.minutes)
              var predictionTime = (new Date(items.time)).getTime()
              var currentTime = (new Date()).getTime()
              if (minutes < 70) {
                if (currentTime - predictionTime > 13 * 60000) {
                  isExpired.push(true);
                } else {
                  isExpired.push(false);
                }
              } else {
                if (currentTime - predictionTime > 6 * 60000) {
                  isExpired.push(true);
                } else {
                  isExpired.push(false);
                }
              }
            })

          var expired = isExpired.every(function (item, index, array) {
            return item;
          })
          if (expired) {
            inplayExpired.push(v)
          } else {
            inplayprediction.push(v)
          }
        }
      })

      pregameData.forEach(v => {
        if (v.match_period == 'FT') {
          pregameExpired.push(v)
        } else {
          var currentdate = (new Date()).getDate()
          var match_dt = (new Date(v.match_dt)).getDate()
          if (match_dt < currentdate) {
            pregameExpired.push(v)
          } else {
            pregamePrediction.push(v)
          }
        }
      })
      for (var i = 0; i < inplayExpired.length; i++) {
        if (!that.checkLeague(inplayExpired[i].league, leagueExpInplay)) {
          leagueExpInplay.push({
            league: inplayExpired[i].league
          })
        }
      }
      for (var i = 0; i < pregamePrediction.length; i++) {
        if (!that.checkLeague(pregamePrediction[i].league, leaguePregame)) {
          leaguePregame.push({
            league: pregamePrediction[i].league
          })
        }
      }

      for (var i = 0; i < inplayprediction.length; i++) {
        if (!that.checkLeague(inplayprediction[i].league, leagueInplay)) {
          leagueInplay.push({
            league: inplayprediction[i].league
          })
        }
      }

      for (var i = 0; i < pregameExpired.length; i++) {
        if (!that.checkLeague(pregameExpired[i].league, leagueExpPregame)) {
          leagueExpPregame.push({
            league: pregameExpired[i].league
          })
        }
      }

      app.leagueExpInplay = leagueExpInplay
      app.leaguePregame = leaguePregame
      app.leagueInplay = leagueInplay
      app.leagueExpPregame = leagueExpPregame
      app.inplayExpired = inplayExpired
      app.inplayprediction = inplayprediction
      app.pregame = pregamePrediction
      app.expiredPregame = pregameExpired

      if (app.inplayprediction.length > 0) {
        app.$store.commit('setactivePrediction', app.inplayprediction[0]['idmatch'])
        app.$store.commit('setdataSelectedPrediction', app.inplayprediction[0])

        //set type for prediction detail at first load
        app.$store.commit("settypePrediction", {
          colorheader: "#ff7c7c",
          colorprediction: "#FEE1E1"
        });
        app.$store.commit("setboderActive", 'inplay')
      } else if (app.pregame.length > 0) {
        app.$store.commit('setactivePrediction', app.pregame[0]['idmatch'])
        app.$store.commit('setdataSelectedPrediction', app.pregame[0])

        //set type for prediction detail at first load
        app.$store.commit("settypePrediction", {
          colorheader: "#5bb6e7",
          colorprediction: "#C8E6F7"
        });

        app.$store.commit("setboderActive", 'pregame')
      } else if (app.inplayExpired.length > 0) {
        app.$store.commit('setactivePrediction', app.inplayExpired[0]['idmatch'])
        app.$store.commit('setdataSelectedPrediction', app.inplayExpired[0])

        //set type for prediction detail at first load
        app.$store.commit("settypePrediction", {
          colorheader: "#767676",
          colorprediction: "#f0f0f0"
        });
        app.$store.commit("setboderActive", 'expiredinplay')
      }

      that.timeoutfirstload.push(setTimeout(() => {
        that.getDataInPlay(app, that.olddate)
      }, 3000))

      that.timeoutfirstload.push(setTimeout(() => {
        that.getDataPregame(app, that.olddate)
      }, 600000))
    })
  }

  getDataLiveScore(app) {
    let that = this
    $.when(
      this.getMatchLiveScore(),
      this.getStatsData(),
      this.getTimeLineData(),
    ).done(function (matchlivescore, stats, timeline) {
      var leaguename = []
      var leagueLeft = []
      var leagueRight = []
      var dataleftcoln = []
      var datarightcoln = []
      for (var i = 0; i < matchlivescore.data.r.length; i++) {
        if (!that.checkLeague(matchlivescore.data.r[i][5], leaguename)) {
          leaguename.push({
            league: matchlivescore.data.r[i][5],
            leagueShortName: matchlivescore.data.r[i][6],
            leagueColorCode: matchlivescore.data.r[i][7],
          })
        }
      }

      for (var i = 0; i < leaguename.length; i++) {
        let dataArr = matchlivescore.data.r.filter(
          x => x[5] == leaguename[i].league,
        )

        if (
          dataleftcoln.length < datarightcoln.length ||
          dataleftcoln.length == 0
        ) {
          leagueLeft.push(leaguename[i])
          for (var l = 0; l < dataArr.length; l++) {
            dataleftcoln.push(dataArr[l])
          }
        } else {
          leagueRight.push(leaguename[i])
          for (var l = 0; l < dataArr.length; l++) {
            datarightcoln.push(dataArr[l])
          }
        }
      }
      app.livescore = matchlivescore.data.r
      /*app.leagueLiveScoreLeft = leaguename.splice(
      	0,
      	Math.round(leaguename.length / 2),
      )
      app.leagueLiveScoreRight = leaguename*/
      app.leagueLiveScoreLeft = leagueLeft
      app.leagueLiveScoreRight = leagueRight
      app.livescoreStats = that.formatJson(stats.data)
      app.livescoreTimeLine = that.formatJson(timeline.data)

      let id = app.livescore[0][0]

      if (!app.$store.state.iconMenuShow) {
        if (!app.$store.state.isOpenLiveScoreDetail) {
          app.$store.state.dataLivescoreDetail = {
            match: app.livescore[0],
            stats: app.$root.livescoreStats.r.find(x => x[2] == id) == undefined ? [] : app.$root.livescoreStats.r.find(x => x[2] == id),
            timeline: app.$root.livescoreTimeLine.r.filter(x => x[2] == id),
          }
          app.$store.state.livescoreSelected = {
            match_code: id,
            isopening: false,
          }
        }
        app.$store.state.isOpenLiveScoreDetail = true
      }

      //update data for detail panel
      if (app.$store.state.dataLivescoreDetail.match[0] != undefined) {
        let id = app.$store.state.dataLivescoreDetail.match[0]
        app.$store.state.dataLivescoreDetail = {
          match: app.livescore.find(x => x[0] == id),
          stats: app.$root.livescoreStats.r.find(x => x[2] == id) == undefined ? [] : app.$root.livescoreStats.r.find(x => x[2] == id),
          timeline: app.$root.livescoreTimeLine.r.filter(x => x[2] == id),
        }
      }

      app.$store.state.timer = setTimeout(() => {
        that.getDataLiveScore(app)
      }, 5000)
    })
  }

  getDataLiveScoreByDate(date, app) {
    let that = this
    $('.loading').addClass('loading-is-visible')
    clearTimeout(app.$store.state.timer)
    $.ajax({
      url: 'http://www.hasilskor.com/API/JSON.aspx?date=' +
        date +
        '&sport=soccer&s=26PDpiffaaBbGrBdfgnrK2pknndskc1f3IMeKLW6PqdprBMHMqSTQ7gcmlcx7jZMxmyeTTBXRqwDh5p044MJHrf',
      success: function (res) {
        var leaguename = []
        for (var i = 0; i < res.r.length; i++) {
          if (!that.checkLeague(res.r[i][5], leaguename)) {
            leaguename.push({
              league: res.r[i][5],
              leagueShortName: res.r[i][6],
              leagueColorCode: res.r[i][7],
            })
          }
        }
        app.livescore = res.r
        app.leagueLiveScoreLeft = leaguename.splice(
          0,
          Math.round(leaguename.length / 2),
        )
        app.leagueLiveScoreRight = leaguename
        $('.loading').removeClass('loading-is-visible')
      },
      error: function (error) {
        app.league = []
        app.livescore = []
        app.leagueLiveScoreLeft = []
        app.leagueLiveScoreRight = []
        $('.loading').removeClass('loading-is-visible')
      },
    })
  }

  getTimeLineData() {
    return axios.get(
      'http://www.hasilskor.com/API/JSON.aspx?callback=callbackJSON&sport=soccerDA&s=26PDpiffaaBbGrBdfgnrK2pknndskc1f3IMeKLW6PqdprBMHMqSTQ7gcmlcx7jZMxmyeTTBXRqwDh5p044MJHrf&date=&lut=&isJSONP=true&_=1506409621930',
    )
  }

  getStatsData() {
    return axios.get(
      'http://www.hasilskor.com/API/JSON.aspx?callback=callbackJSON&sport=soccerDB&s=26PDpiffaaBbGrBdfgnrK2pknndskc1f3IMeKLW6PqdprBMHMqSTQ7gcmlcx7jZMxmyeTTBXRqwDh5p044MJHrf&date=&lut=&isJSONP=true&_=1506412139882',
    )
  }

  formatJson(data) {
    return JSON.parse(data.replace('callbackJSON(', '').replace(/\)$/g, ''))
  }

  stopAlltimeout() {
    for (var i = 0; i < this.timeoutfirstload.length; i++) {
      clearTimeout(this.timeoutfirstload[i])
    }
    this.timeoutfirstload = []
  }
}

export default GetData
