<template>
  <div id="bodyList">
    <div id="leftlist">
      <el-row class="tac">
        <el-col>
          <el-menu :default-active="activeIndex">
            <el-menu-item
              index="1"
              v-on:click="selectall"
            >
              <i class="el-icon-food"></i>
              <span slot="title">全部菜系</span></el-menu-item>
            <el-menu-item
              index="2"
              v-on:click="selectlu"
            >
              <i class="el-icon-dish-1"></i>
              <span slot="title">鲁菜</span> </el-menu-item>
            <el-menu-item
              index="3"
              v-on:click="selectchuan"
            >
              <i class="el-icon-dish"></i>
              <span slot="title">川菜</span>
            </el-menu-item>
            <el-menu-item
              index="4"
              v-on:click="selectyue"
            >
              <i class="el-icon-dish-1"></i>
              <span slot="title">粤菜</span>
            </el-menu-item>
            <el-menu-item index="5">
              <i class="el-icon-dish"></i>
              <span slot="title">苏菜</span>
            </el-menu-item>
            <el-menu-item index="6">
              <i class="el-icon-dish-1"></i>
              <span slot="title">闽菜</span>
            </el-menu-item>
            <el-menu-item index="7">
              <i class="el-icon-dish"></i>
              <span slot="title">浙菜</span>
            </el-menu-item>
            <el-menu-item index="8">
              <i class="el-icon-dish-1"></i>
              <span slot="title">徽菜</span>
            </el-menu-item>
            <el-menu-item index="9">
              <i class="el-icon-dish"></i>
              <span slot="title">湘菜</span>
            </el-menu-item>
          </el-menu>
        </el-col>
      </el-row>
    </div>
    <!--展示卡片-->
    <div id="cards">
      <el-scrollbar
        :native="false"
        tag="section"
        style="height:100%"
      >
        <el-row>
          <el-col
            :span="8"
            v-for="commodity in info"
            class="commodity"
            :key="commodity.comid"
          >
            <el-card>
              <img
                :src="commodity.comimg"
                class="image"
              />
              <div style="padding: 14px;height: 200px">
                <el-scrollbar
                  :native="false"
                  tag="section"
                  style="height:100%"
                >
                  <p>菜名：{{ commodity.comname }}</p>
                  <p>菜种：{{ commodity.comkind }}</p>
                  <p>剩余库存：{{ commodity.comstock }}</p>
                  <p>{{ commodity.comdisc }}</p>
                  <div class="bottom clearfix">
                    <span>价格：{{ commodity.comprice }}&nbsp;&nbsp;&nbsp;</span>
                    <el-button
                      type="text"
                      class="button"
                      @click="addchart(info[commodity.comid-1])"
                    >加入购物车</el-button>
                  </div>
                </el-scrollbar>
              </div>
            </el-card>
          </el-col>
        </el-row>
      </el-scrollbar>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      activeIndex: '1',
      info: null,
      params: 'all'
    }
  },
  methods: {
    selectall: function () {
      this.activeIndex = '1'
      this.get('all')
    },
    selectlu: function () {
      this.activeIndex = '2'
      this.get('lu')
    },
    selectchuan: function () {
      this.activeIndex = '3'
      this.get('chuan')
    },
    selectyue: function () {
      this.activeIndex = '4'
      this.get('yue')
    },
    addchart: function (row) {
    // 先判断是否登录，再加表
    // 如果登录后再添加商品
    // 添加到localstorge
    // 步骤：1、查重，2、加数量，3、push  row.id可用
    // 先检查有没有对象
      if (localStorage.cart === 'null') {
        let cart1 = []
        let cart = {
          comid: row.comid,
          comname: row.comname,
          comkind: row.comkind,
          comprice: row.comprice
        }
        cart.number = 1
        cart.sumprice = cart.comprice
        cart1.push(cart)
        localStorage.setItem('cart', JSON.stringify(cart1))
        this.$alert('添加成功', {
          confirmButtonText: '确定'
        })
      } else {
        let k = 0
        let flag = 0
        let cart1 = localStorage.getItem('cart')
          ? JSON.parse(localStorage.getItem('cart'))
          : []
        for (let i = 0; i < cart1.length; i++) {
          let item = cart1[i]
          if (item.comid === row.comid) {
          // 如果有这个对象
            cart1[i].number++// 数量自增
            flag = 1
            break
          } else {
            k = k + 1
          }
        }
        if (flag === 0) {
        // 如果无重复则生成对象
          let cart = {
            comid: row.comid,
            comname: row.comname,
            comkind: row.comkind,
            comprice: row.comprice
          }
          cart.number = 1
          cart.sumprice = cart.comprice
          cart1.push(cart)
        }
        localStorage.setItem('cart', JSON.stringify(cart1))
        this.$alert('添加成功！', {
          confirmButtonText: '确定'
        })
      }
    },
    get: function (params) {
      axios({
        method: 'get',
        url: 'http://192.168.2.201/commodity/select/' + params
      })// 执行get请求
        .then(res => (this.info = res.data))// 处理数据（赋给info
        .catch(error => {
          console.log(error)
        })// 错误处理
    }
  },
  mounted () {
    axios({
      method: 'get',
      url: 'http://192.168.2.201/commodity/select/' + this.params
    })// 执行get请求
      .then(res => (this.info = res.data))// 处理数据（赋给info
      .catch(error => {
        console.log(error)
      })// 错误处理
  }
}
</script>

<style>
#bodyList {
  height: 710px;
}
.el-scrollbar__wrap {
  overflow-x: hidden;
}
.commodity {
  font-size: 10px;
}
#img {
  float: left;
  margin-left: 5px;
  width: 270px;
  height: 70px;
}
#leftlist {
  float: left;
  width: 265px;
}
#topitem {
  height: 64px;
}

.el-menu {
  border-bottom: 0px !important;
}
.el-menu-item.is-active {
  border-bottom-color: #ffffff !important;
  color: blue !important;
}
#cards {
  width: 800px;
  height: 704px !important;
  float: left;
}
.el-col {
  float: left;
  width: 263px !important;
}
.el-card {
  float: left;
  width: 260px !important;
  height: 400px;
}
.image {
  width: 100%;
  height: 150px;
  display: block;
}

#id {
  float: left;
  height: 60px;
}
</style>
