## About 管理后台
使用php-laravel + vue
- php 7.1.3
- laravel 5.8
- vue-cli2


测试：
# 活动-v1

> Module：campaign

接口列表
=================
* [凭证-详情](#凭证-详情)
* [凭证-核销](#凭证-核销)

## 接口说明

### 凭证-详情

> GET：/v1/campaign/voucher/info

**Request**
>
| 字段 | 类型 |  是否必须 | 说明 |
| --- | --- | --- | --- |
| id | integer | Y | 凭证id |
| type | integer | Y | 凭证类型，1：优惠券类型，2：表单类型 |

**Response**
>
| 字段 | 类型 | 说明 |
| --- | --- | --- |
| id | integer | 凭证id |
| pzNumber | integer | 凭证号 |
| expiryDate | string | 有效期 |
| campaignDate | string | 活动时间 |
| address | string | 商家地址 |
| type | integer | 凭证所属的卡券类型，1：优惠券类型，2：表单类型 |
| wxUid | integer | 微信用户id |
| userName | string | 小程序用户昵称 |
| name | string | 名称 |
| description | string | 描述 |
| mobile | integer | 电话 |
| createTime | string | 领取时间 |
| checkTime | string | 核销时间 |
| status | integer | 核销状态，0：未使用（核销）、1：已使用（核销）、9：无效 |

### 凭证-核销

> GET：/v1/campaign/voucher/check

**Request**
>
| 字段 | 类型 |  是否必须 | 说明 |
| --- | --- | --- | --- |
| id | integer | Y | 凭证id |
| type | integer | Y | 凭证类型，1：优惠券类型，2：表单类型 |
| mpUid | integer | Y | 销售wx user id |

**Response**
> None


