# hotel-res-system

> A res system for hotel

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report

# run unit tests
npm run unit

# run e2e tests
npm run e2e

# run all tests
npm test
```
过程记录：
```
2020.4.29修复部分bug
2020.4.23做了一下echart
2020.4.20使用vue-cli重构并改善代码风格
2020.4.18下单已完成，购物车完成,给admin添加了后台入口，对普通用户隐藏了注销
2020.4.16完善了购物车和订单抽屉部分内容
2020.4.13 设计了购物车抽屉，正在研究使用 vuex 跨组件通信
2020.4.11 完成了登陆状态保存和 token 生成，token 验证还在写，明天研究 route
2020.4.9 研究了一下登录认证的保持和权限管理部分，有点眉目了
2020.4.8 订单页面新增了分类，查询，派送，查看详情功能
2020.4.7 重新修改了查询和删除逻辑，计划增加操作记录表，在用户登录部分完成后做，订单部分还没设计好，先修改了一下数据字典
2020.4.6 用户管理完成，今天弄解锁的 K30p
2020.4.5 后台商品增、删、查完成
2020.4.3 登录状态有点眉目了，最近计划学习 vuex,vue-route 然后完善注册和后台功能
2020.4.2 解决了 cors 跨域问题，还是得靠 nginx。完成了 vfor 展示全部 commodity，左侧列表有测试数据的三个菜单切换完成,登录框完成
2020.3.31 学了三天 laravel，基本弄懂了路由，查库成功。
2020.3.28 设计了数据字典，准备了 mysql 环境并建库。
2020.3.27 后台三个页面原型完成
该准备 echart 和测试数据了
2020.3.26 前端用户展示原型完成
2020.3.26 学习了前 11 课时，了解了 m,v,vm 和 m,v,c 的区别，学习了一些操作
2020.3.25 使用 vue-cli 立项（由于不熟悉 node 已删除）
姑且记录一下开发过程
```
开发计划：
```
v1.0:前端展示正常、购物车单独页面展示，写库读库，订单登录后可看
v2.0:购物车和订单改为左右卡片展示
v3.0:优化其他部分
```

待办：后端 api 文档，后端 api 返回值统一(done)，后端 api 命名统一,前端变量名统一，加注释，js 分离，错误提示，后台考虑走 vue-admin 重构,登录加验证码
v-if 好像有问题，前端后台按钮渲染不上，有空再看看
剩余问题：页面加载之前验证权限，api 权限验证，订单和购物车
咕咕list:减少库存只能一个个减少，每次axios请求都要带token，后端加验证
BUG发掘：注销不能实时展示
