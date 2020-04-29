<!--
Created: 2020-04-19 10:57:43
Last Modified:2020-04-20 09:26:01
Filename:index.html
Project:hotel-res-system
Author : YukiMuraRindon
Email : rinndonn@outlook.com
--------------------------------------------------------
Description: 用户相关组件，包括登录，注销，注册，进入后台等
-->
<template>
<!-- 用户相关 -->
  <div id="userAction"
    style="margin-right:40px;">
    <p style="margin-right:40px; text-align: center; display: inline;">
      欢迎您：{{ nick }}
      <el-button
        type="text"
        v-if="islogin == true"
        @click="logout"
      >注销</el-button>
      <el-button
        type="text"
        v-if="admin == true "
        @click="toAdmin()"
      >进入后台</el-button>
    </p>
    <img
      src="../../static/img/userlogo.png"
      alt="userlogo"
      style="width:50px;height:50px;"
      @click="popbutton"
    />
    <el-popover
      placement="top"
      width="160"
      v-model="pop"
    >
      <div style="text-align: right; margin: 0">
        <el-button
          size="mini"
          @click="loginForm = true"
        >登 录</el-button>
        <el-button
          type="primary"
          size="mini"
          @click="registForm = true"
        >注 册</el-button>
      </div>
    </el-popover>
    <!-- 登录表单 -->
    <el-dialog
      title="登录系统"
      :visible.sync="loginForm"
      style="text-align:left"
      :modal-append-to-body="false"
    >
      <el-form :model="LoginForm">
        <el-form-item
          label="用户名"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="LoginForm.username"
            autocomplete="off"
          ></el-input>
        </el-form-item>
        <el-form-item
          label="密码"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="LoginForm.password"
            autocomplete="off"
            show-password
          ></el-input>
        </el-form-item>
      </el-form>
      <div
        slot="footer"
        class="dialog-footer"
      >
        <el-button @click.stop="clickcancal()">取 消</el-button>
        <el-button
          type="primary"
          @click="clicklogin()"
        >登 录</el-button>
      </div>
    </el-dialog>
    <!-- 注册表单 -->
    <el-dialog
      title="注册会员"
      :visible.sync="registForm"
      style="text-align:left"
      :modal-append-to-body="false"
    >
      <el-form :model="RegistForm">
        <el-form-item
          label="用户名"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.username"
            autocomplete="off"
          ></el-input>
        </el-form-item>
        <el-form-item
          label="密码"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.password"
            autocomplete="off"
            show-password
          ></el-input>
        </el-form-item>
        <el-form-item
          label="确认密码"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.repassword"
            autocomplete="off"
            show-password
          ></el-input>
        </el-form-item>
        <el-form-item
          label="昵称"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.nickname"
            autocomplete="off"
          ></el-input>
        </el-form-item>
        <el-form-item
          label="地址"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.address"
            autocomplete="off"
          ></el-input>
        </el-form-item>
        <el-form-item
          label="电话号码"
          :label-width="formLabelWidth"
        >
          <el-input
            v-model="RegistForm.telephone"
            autocomplete="off"
          ></el-input>
        </el-form-item>
      </el-form>
      <div
        slot="footer"
        class="dialog-footer"
      >
        <el-button @click.stop="clickcancal()">取 消</el-button>
        <el-button
          type="primary"
          @click="clickregist()"
        >注 册</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'userAction',
  beforeCreate () {
    console.log(localStorage.islogin)
    if (localStorage.islogin === undefined || localStorage.islogin === null) {
      localStorage.islogin = 'no'
    } else if (localStorage.islogin === 'yes') this.islogin = true
    if (localStorage.nickname === undefined) {
      localStorage.nickname = 'Guest'
    } else if (localStorage.nickname === 'rindon') {
      this.admin = true
      // console.log(this.admin)
      // 建议改成后端请求验证
    } else if (localStorage.token === undefined) {
      localStorage.token = null
    } else if (localStorage.nickname === undefined) {
      localStorage.nickname = 'Guest'
    }
  },
  created () {
    if (localStorage.token === null || localStorage.islogin === 'no' || localStorage.nickname === 'Guest') {
      this.admin = false
    } else {
      axios({
        method: 'post',
        url: 'http://192.168.2.201/login/check',
        data: {
          token: localStorage.token
        }
      }) // 执行get请求
        .then(function (response) {
          if (response.data.status === '2') {
            this.admin = true
            // console.log(this.admin)
          }
        })
        .catch(error => {
          // this.admin = false;
          console.log(error)
        })// 错误处理
    }
  },
  data () {
    return {
      nick: localStorage.nickname,
      pop: false,
      loginForm: false,
      registForm: false,
      LoginForm: {
        username: '',
        password: ''
      },
      RegistForm: {
        username: '',
        password: '',
        repassword: '',
        nickname: '',
        address: '',
        telephone: ''
      },
      info: null,
      token: null,
      formLabelWidth: '120px',
      circleUrl:
        'https:// cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png'
    }
  },
  methods: {
    toAdmin: function () {
      window.location.href = 'admin/index.html'
    },
    popbutton: function () {
      if (localStorage.nickname === null || this.nick === 'Guest') {
        this.pop = true
      } else {
        this.pop = false
      }
      // console.log(this.admin)
    },
    clicklogin: function () {
      axios({
        method: 'post',
        url: 'http://192.168.2.201/login/login/',
        data: {
          username: this.LoginForm.username, // 取值
          password: this.LoginForm.password
        }
      }) // 执行get请求
        .then(response => {
          this.info = response
          this.token = this.info.data.token
          //  console.log(this.info)
          // console.log(this.info.data)
          // console.log(this.info.data.token)
          if (this.info.data.error_code === '1') {
            this.$alert(response.message, this.info.data.message, {
              confirmButtonText: '确定'
            })
            this.LoginForm.password = ''
          } else if (this.info.data.status === 1) {
            // 如果登录成功且是普通用户
            // console.log("欢迎用户"+this.info.data[0].username)
            this.nick = this.info.data.nickname
            this.$alert(response.message, '登录成功！', {
              confirmButtonText: '确定'
            })
            localStorage.islogin = 'yes'
            localStorage.nickname = this.nick
            localStorage.token = this.token
            this.pop = false
            this.loginForm = false
          } else if (this.info.data.status === 2) {
            // 如果是管理员
            // console.log("欢迎管理员"+this.info.data[0].nickname)
            this.admin = true
            this.nick = this.info.data.nickname
            this.$alert(response.message, '登录成功！', {
              confirmButtonText: '确定'
            })
            localStorage.islogin = 'yes'
            localStorage.nickname = this.nick
            localStorage.token = this.token
            this.pop = false
            this.loginForm = false
          }

          // this.get("all"); // 插入完毕刷新页面
          // console.log (response);
        }) // 处理数据（赋给info
        .catch(error => {
          console.log(error)// 这里应该有错误处理
        }) // 错误处理
    },
    clickregist: function () {
      // 点击了注册之后
      // 先检查：密码和确认密码，电话号码全为数字
      if (this.RegistForm.password !== this.RegistForm.repassword) {
        this.$alert('两次密码输入不一致！', '请检查输入内容！', {
          confirmButtonText: '确定'
        })
      } else if (isNaN(this.RegistForm.telephone)) {
        this.$alert('电话号码只能为数字！', '请检查输入内容！', {
          confirmButtonText: '确定'
        })
      } else {
        axios({
          method: 'post',
          url: 'http://192.168.2.201/login/regist',
          data: {
            username: this.RegistForm.username,
            password: this.RegistForm.password,
            nickname: this.RegistForm.nickname,
            address: this.RegistForm.address,
            telephone: this.RegistForm.telephone
          }
        }) // 执行get请求
          .then(function (response) {
            // 执行完了应该标记登录状态
            console.log(response)
            localStorage.islogin = 'yes'
            localStorage.nickname = response.data.nickname
            localStorage.token = response.data.token
          })
          .catch(error => {
            this.$alert('注册失败，请联系管理员', '注册失败！', {
              confirmButtonText: '确定'
            })
            console.log(error)
          }) // 错误处理
        location.reload()
        this.$alert('注册成功，欢迎您', '注册成功！', {
          confirmButtonText: '确定'
        })
        this.pop = false
        this.registForm = false
      }
    },
    clickcancal: function () {
      this.pop = false
      this.registForm = false
      this.loginForm = false
    },
    isAdmin: function () {
      if (localStorage.token === null || localStorage.islogin === 'no' || localStorage.nickname === 'Guest') {
        this.admin = false
      } else {
        axios({
          method: 'post',
          url: 'http://192.168.2.201/login/check',
          data: {
            token: localStorage.token
          }
        }) // 执行get请求
          .then(function (response) {
            localStorage.islogin = 'yes'
            if (response.data.status === '2') {
              this.admin = true
              // console.log(this.admin)
            }
          })
          .catch(error => {
            console.log(error)
          })// 错误处理
      }
    },
    logout: function () {
      if (localStorage.token === null) {
        localStorage.removeItem('nickname')
        localStorage.removeItem('token')
        location.reload()
      } else {
        axios({
          method: 'post',
          url: 'http://192.168.2.201/login/logout',
          data: {
            token: localStorage.token
          }
        }) // 执行get请求
          .then(function (response) {
            localStorage.removeItem('nickname')
            localStorage.removeItem('token')
            localStorage.islogin = 'no'
            localStorage.nickname = 'Guest'
            location.reload()
          })
          .catch(error => {
            console.log(error)
          }) // 错误处理
      }
    }
  },
  watch: {}
}
</script>

<style>
#userAction {
      float: right;
      margin-top: 10px;
    }
</style>
