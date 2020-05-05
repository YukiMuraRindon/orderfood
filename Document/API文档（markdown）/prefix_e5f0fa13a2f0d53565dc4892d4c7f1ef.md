

 | 订单表|order |
|:--- |:---  |
| 字段 | 类型 | 约束 | 说明 |
| ordid | int(10) | Not null,primary | 设置了自增 |
| ordnum | int(10 | Not null |  |
| ordprice | decimal(10,2) | Not null |  |
| ordstatus | varchar(255) | Not null |  |
| orddate | datetime | Not null | 默认值current_timestamp |
| sentstatus | varchar(255) |  |  |
| ordnote | varchar(255) |  | 备用字段 |
 备注：ordprice是订单总价格。ordstatus分为已支付，已发货，已完成。sentstatus分为等待中，配送中，配送完成。 
