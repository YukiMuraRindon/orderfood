import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const store = new Vuex.Store({
  state: {
    cartData: []
  },
  mutations: {
    //这里应该有对数组的操作
    addcom(row) {
      cartData.push(row);
      console.log(this.cartData);
    }
  }
});

export default new Vuex.Store({
  modules: {
    store
  }
});
