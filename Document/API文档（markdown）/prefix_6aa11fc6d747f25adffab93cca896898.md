

| 订单详情表|orderdetail |
|:---  |
| 字段 | 类型 | 约束 | 说明 |
| detailed | int | Not null,primary | 自增 |
| ordered | int  | Not null | 连接到order表 |
| comid | int | Not null | 连接到商品表 |
| comkind | varchar | Not null | 连接到商品表 |
| comnum | int | Not null |  |
| orderdate | datetime | Not null | 根据时间戳自动更新 |
| ordernote | varchar |  | 备用字段 |



