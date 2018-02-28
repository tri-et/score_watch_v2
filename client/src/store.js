import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
  state: {
    calendarPre: 14,
    activePrediction: null,
    dataSelectedPrediction: {
      sys: {
        hdp: ''
      },
      sbo: {
        hdp: ''
      },
      ibc: {
        hdp: ''
      }
    },
    isOpenDetailPrediction: false,
    typePrediction: {
      colorheader:'#767676',
      colorprediction:'#f0f0f0'
    }
  },
  getters: {
    calendarPre(state) {
      return state.calendarPre
    },
    activePrediction(state) {
      return state.activePrediction
    },
    dataSelectedPrediction(state) {
      return state.dataSelectedPrediction
    },
    isOpenDetailPrediction(state) {
      return state.isOpenDetailPrediction
    },
    typePrediction(state) {
      return state.typePrediction
    }
  },
  mutations: {
    setcalendarPre(state, val) {
      state.calendarPre = val
    },
    setactivePrediction(state, val) {
      state.activePrediction = val
    },
    setdataSelectedPrediction(state, val) {
      state.dataSelectedPrediction = val
    },
    setisOpenDetailPrediction(state, val) {
      state.isOpenDetailPrediction = val
    },
    settypePrediction(state, val) {
      state.typePrediction = val
    }
  },
  actions: {}
})
