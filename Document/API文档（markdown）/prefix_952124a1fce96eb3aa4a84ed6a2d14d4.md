
    
**简要描述：** 

- 查询订单接口

**请求URL：** 
- `http://192.168.2.201/order/selectorder/{orderid} `
  
**请求方式：**
- GET 

**参数：** 

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|orderid |是  |int |订单id   |


 **返回示例**

``` 
  {
    orderid: 1
	userid: 5
	ordprice: "538.00"
	ordstatus: "payed"
	orddate: "2020-04-07 11:47:45"
	sentstatus: "waiting"
	ordnote: null
  }
```

 **返回参数说明** 

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|orderid |int   |订单id|
|userid|int|用户编号|
|ordprice|decimal|支付金额|
|ordstatus|String|订单状态|
|orderdate|datetime   |下单时间|
|sentstatus|String|派送状态|
|ordernote|String   |备用字段|




