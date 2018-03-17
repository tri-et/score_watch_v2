import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
  state: {
    calendarPre: 14,
    activePrediction: null,
    boderActive: 'inplay',
    dataSelectedPrediction: {},
    isOpenDetailPrediction: false,
    typePrediction: {
      colorheader: '#767676',
      colorprediction: '#f0f0f0'
    },
    isopenHelp: false,
    isopenMenuSideBar: false,
    shrink: false,
    hideDetail: true,
    menuActive:'predictions'
  },
  getters: {
    calendarPre(state) {
      return state.calendarPre
    },
    activePrediction(state) {
      return state.activePrediction
    },
    boderActive(state) {
      return state.boderActive
    },
    dataSelectedPrediction(state) {
      return state.dataSelectedPrediction
    },
    isOpenDetailPrediction(state) {
      return state.isOpenDetailPrediction
    },
    typePrediction(state) {
      return state.typePrediction
    },
    isopenHelp(state) {
      return state.isopenHelp
    },
    isopenMenuSideBar(state) {
      return state.isopenMenuSideBar
    },
    shrink(state) {
      return state.shrink
    },
    hideDetail(state) {
      return state.hideDetail
    },
    menuActive(state) {
      return state.menuActive
    }
  },
  mutations: {
    setcalendarPre(state, val) {
      state.calendarPre = val
    },
    setactivePrediction(state, val) {
      state.activePrediction = val
    },
    setboderActive(state, val) {
      state.boderActive = val
    },
    setdataSelectedPrediction(state, val) {
      state.dataSelectedPrediction = val
    },
    setisOpenDetailPrediction(state, val) {
      state.isOpenDetailPrediction = val
    },
    settypePrediction(state, val) {
      state.typePrediction = val
    },
    setisopenHelp(state, val) {
      state.isopenHelp = val
    },
    setisopenMenuSideBar(state, val) {
      state.isopenMenuSideBar = val
    },
    setshrink(state, val) {
      state.shrink = val
    },
    sethideDetail(state, val) {
      state.hideDetail = val
    },
    setmenuActive(state, val){
      state.menuActive = val
    }
  },
  actions: {}
})
