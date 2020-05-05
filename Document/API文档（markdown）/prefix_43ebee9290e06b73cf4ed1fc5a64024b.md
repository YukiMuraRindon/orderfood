
    
**简要描述：** 

- 修改用户信息接口

**请求URL：** 
- `http://192.168.2.201/user/updateuser/`
  
**请求方式：**
- POST 

**参数：** 

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|userid|是|int|用户id
|username |是  |string |用户名   |
|password |是  |string | 密码    |
|nickname     |是  |string | 昵称    |
|tel|是|int|电话号码
|address|是|String|配送地址
|status|是|int|用户状态|

 **返回示例**

``` 
  {
    "error_code": 0
  }
```

 **返回参数说明** 

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|error_code |int   |正常执行|

 **备注** 

- 若非0则说明出现错误


