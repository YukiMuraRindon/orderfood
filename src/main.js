/*
 * Created: 2020-04-19 10:57:43
 * Last Modified:2020-04-20 09:26:06
 * Filename:main.js
 * Project:hotel-res-system
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description:1
 */

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import topList from './components/topList'
import user from './components/user'
import bodyList from './components/bodyList'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#topList',
  components: { topList },
  template: '<topList/>'
})
new Vue({
  el: '#user',
  components: { user },
  template: '<user/>'
})
new Vue({
  el: '#bodyList',
  components: { bodyList },
  template: '<bodyList/>'
})
