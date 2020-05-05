
    
**简要描述：** 

- 用户注册接口

**请求URL：** 
- ` http://192.168.2.201/login/register `
  
**请求方式：**
- POST 

**参数：** 

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|username |是  |string | 用户名  |
|password |是  |string | 密码    |
|nickname |是  |string | 昵称    |
|address  |是  |string | 地址    |
|telephone|是  |string | 电话号码|


 **返回示例**

``` 
  {
    "error_code": 0,
    "nickname": "rindon",
	"token": "8f1eZ2gM0PoGFHh8V6ju4I02k8SYF8azlKsJSEkg03QRY2F0qJdSPVpAn7ZQzRkP"
  }
```

 **返回参数说明** 

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|error_code |int   | 错误代码，0为正常执行 |
|nickname |string | 昵称 |
|token | string | 用户口令 |
