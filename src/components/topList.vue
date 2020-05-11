<!--
 * Created: 2020-04-19 10:57:43
 * Last Modified:2020-04-20 09:26:22
 * Filename:App.vue
 * Project:hotel-res-system
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 Description: 顶栏菜单组件

-->

<template>
  <div id="topList">
    <!-- 主菜单 -->
    <el-menu
      :default-active="activeIndex"
      class="el-menu"
      mode="horizontal"
      active-text-color="#ffffffs"
    >
      <el-menu-item index="1">菜品展示</el-menu-item>
      <el-menu-item
        index="2"
        @click="shoppingcart = true"
      >我的购物车</el-menu-item>
      <el-menu-item
        index="3"
        @click="orderlist"
      >订单管理</el-menu-item>
    </el-menu>
    <!--购物车抽屉-->
    <el-drawer
      title="已加入购物车的商品总览："
      :visible.sync="shoppingcart"
      direction="rtl"
      size="65%"
      :before-close="closedrawer"
      @open="open()"
      ref="drawer"
    >
      <el-table :data="cartData">
        <el-table-column
          property="comname"
          label="菜名"
          width="100"
        ></el-table-column>
        <el-table-column
          property="comkind"
          label="种类"
          width="100"
        ></el-table-column>
        <el-table-column
          property="comprice"
          label="单价"
          width="100"
        ></el-table-column>
        <el-table-column
          property="number"
          label="数量"
        ></el-table-column>
        <el-table-column
          property="sumprice"
          label="小计"
        ></el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button
              type="danger"
              @click="del(scope.row.comid)"
            >
              删除
              <i class="el-icon-delete2 el-icon--right"></i>
            </el-button>
          </template>
        </el-table-column>
      </el-table>
      <el-button
        type="primary"
        style="float: right;margin-right: 19px;margin-top: 25px;"
        @click="order(cartData)"
      >
        下单
      </el-button>
      <span style="float: right;margin-right: 19px;margin-top: 35px;">总价格：{{ allprice }}元</span>
    </el-drawer>
    <!--订单总览-->
    <!--遮罩是订单管理的问题-->
    <el-drawer
      title="订单总览："
      :visible.sync="orderdrawer"
      direction="rtl"
      size="65%"
      ref="drawer"
      :modal="false"
    >
      <el-table
        :data="orderData"
        style="min-width:800px;"
      >
        <el-table-column
          property="orderid"
          label="订单编号"
          width="50"
        ></el-table-column>
        <el-table-column
          property="ordprice"
          label="订单价格"
          width="100"
        ></el-table-column>
        <el-table-column
          property="ordstatus"
          label="订单状态"
          width="100"
        ></el-table-column>
        <el-table-column
          property="sentstatus"
          label="配送状态"
          width="80"
        ></el-table-column>
        <el-table-column
          property="orddate"
          label="下单时间"
        ></el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button
              type="primary"
              @click="orderdetail(scope.row.orderid)"
            >
              订单详情
            </el-button>
            <el-button
              type="primary"
              @click="orderfinish(scope.row)"
            >
              确认收货
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-drawer>
    <!-- Table -->
    <el-dialog
      title="订单详情"
      :visible.sync="orderVisible"
      style="min-width: 300px;"
    >
      <el-table :data="orderdetaildata">
        <el-table-column
          prop="comname"
          label="商品名称"
          width="150"
        ></el-table-column>
        <el-table-column
          prop="comkind"
          label="商品种类"
        ></el-table-column>
        <el-table-column
          prop="comnum"
          label="商品数量"
        ></el-table-column>
        <el-table-column
          prop="orderdate"
          label="下单时间"
          width="160"
        ></el-table-column>
      </el-table>
    </el-dialog>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'top-list',
  beforeCreate () {
    if (typeof localStorage.cart === 'undefined') {
      localStorage.cart = null
    }
  },
  data () {
    return {
      activeIndex: '1',
      shoppingcart: false,
      cartData: JSON.parse(localStorage.cart),
      orderdrawer: false,
      orderData: [],
      orderVisible: false,
      orderdetaildata: [],
      allprice: 0.0
    }
  },
  methods: {
    closedrawer: function () {
      this.activeIndex = '1'
      this.shoppingcart = false
      // console.log(this.activeIndex)
    },
    open () {
      this.cartData = JSON.parse(localStorage.cart)
      this.allprice = 0
      if (this.cartData) {
        for (let i = 0; i < this.cartData.length; i++) {
          this.allprice +=
            parseFloat(this.cartData[i].comprice) *
            parseInt(this.cartData[i].number)
        }
      }
    },
    orderlist: function () {
      if (localStorage.islogin === 'no') {
        this.$alert('请先登录！', {
          confirmButtonText: '确定'
        })
      } else {
        // 这里应该打开抽屉
        axios({
          method: 'get',
          url:
            'http://192.168.2.201/order/selectuserorder/' +
            localStorage.nickname
        }) // 执行get请求
          .then(res => (this.orderData = res.data)) // 处理数据（赋给info
          .catch(error => {
            // console.log(res.data)
            console.log(error)
          }) // 错误处理
        this.orderdrawer = true
        // 然后axios查后台展示在表格
      }
    },
    del (comid) {
      // 能获取到id
      // console.log(comid);
      let k = 0
      let cart1 = localStorage.getItem('cart')
        ? JSON.parse(localStorage.getItem('cart'))
        : []
      for (let i = 0; i < cart1.length; i++) {
        let item = cart1[i]
        // console.log(item.comid);
        if (item.comid === comid) {
          // 如果有这个对象
          // console.log(typeof(cart1[i]));
          // console.log(cart1);
          cart1.splice(i, 1)
          // console.log(cart1);
          // cart1[i].number++; // 数量自增
          // console.log(cart1[1].number);
          // console.log(typeof(cart1[i].number));
          break
        } else {
          k = k + 1
        }
      }
      localStorage.setItem('cart', JSON.stringify(cart1))
      this.$alert('删除成功！', {
        confirmButtonText: '确定'
      })
      this.cartData = JSON.parse(localStorage.cart)
      this.allprice = 0
      for (let i = 0; i < this.cartData.length; i++) {
        this.allprice +=
          parseFloat(this.cartData[i].comprice) *
          parseInt(this.cartData[i].number)
      }
    },
    order: function (cartData) {
      // console.log(cartData);
      if (localStorage.islogin === 'no') {
        this.$alert('请先登录！', {
          confirmButtonText: '确定'
        })
      } else if (this.cartData === null) {
        this.$alert('请先加购！', {
          confirmButtonText: '确定'
        })
      } else {
        // 如何下单？循环发送axios？

        // console.log(length);
        const that = this
        axios({
          method: 'post',
          url: 'http://192.168.2.201/order/setorder',
          data: {
            nickname: localStorage.nickname,
            ordprice: this.allprice,
            ordstatus: 'payed',
            sentstatus: 'waiting'
          }
        }) // 执行get请求
          .then(function (response) {
            // 返回orderid,发送detail
            // 暂略axios
            // console.log(response.data.orderid);
            // console.log(this.cartData.length);
            let cartData1 = that.cartData
            // console.log(cartData1[0].comid)
            for (let i = 0; i < Object.keys(cartData1).length; i++) {
              axios({
                method: 'post',
                url: 'http://192.168.2.201/order/setorderdetail',
                data: {
                  orderid: response.data.orderid,
                  comid: cartData1[i].comid,
                  comname: cartData1[i].comname,
                  comkind: cartData1[i].comkind,
                  comnum: cartData1[i].number
                }
              }) // 执行get请求
                .then(function (response) {
                  if (response.data.error_code === 0) {
                    console.log(response.data)
                  }
                }) // 处理数据（赋给info
                .catch(error => {
                  console.log(error)
                }) // 错误处理
            }
            that.$alert('下单成功！', {
              confirmButtonText: '确定'
            })
            that.cartData = null
            localStorage.cart = null
            that.allprice = 0
            that.orderdrawer = false
          })
          .catch(error => {
            console.log(error)
          }) // 错误处理
      }
    },
    orderdetail: function (orderid) {
      this.orderVisible = true
      axios({
        method: 'get',
        url: 'http://192.168.2.201/order/selectorderdetail/' + orderid
      }) // 执行get请求
        .then(res => (this.orderdetaildata = res.data)) // 处理数据（赋给info
        .catch(error => {
          // console.log(res.data);
          console.log(error)
        }) // 错误处理
    },
    orderfinish: function (row) {
      if (row.sentstatus === 'finish') {
        this.$alert('订单已完成！', {
          confirmButtonText: '确定'
        })
      } else if (row.sentstatus === 'sending') {
        axios({
          method: 'post',
          url: 'http://192.168.2.201/order/finishorder/',
          data: {
            orderid: row.orderid
          }
        }) // 执行get请求
          .then(res => (row.sentstatus = 'finish')) // 处理数据（赋给info
          .catch(error => {
            // console.log(res.data);
            console.log(error)
          }) // 错误处理
        this.$alert('订单收货成功！', {
          confirmButtonText: '确定'
        })
      } else if (row.sentstatus === 'waiting') {
        this.$alert('尚未发货，请稍等！', {
          confirmButtonText: '确定'
        })
      }
    }
  },
  watch: {},
  mounted () {
    this.$refs.drawer.open() // 方法
  }
}
</script>

<style>
#topList{
  float: left;
  width: 305px;
  height: 70px;
}
</style>
