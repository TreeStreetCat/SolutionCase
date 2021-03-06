
# SolutionCase
多种场景实战解决方案
## 一、短链接服务



## 二、简易抽奖功能

**需求：** 

共有 4 种奖品，每种礼品奖品的概率以及库存如下：

| 奖品名 | 概率  | 库存 |
| ------ | ----- | ---- |
| A      | 70%   | 不限 |
| B      | 13.5% | 不限 |
| C      | 10%   | 20   |
| D      | 6.5%  | 10   |

<br>

**设计方案：**

中奖的总概率为 100%，中奖区间是` (0, 100]` ，当奖品中奖概率是 20%，即中奖区间为 `(0, 20]`，我们可以随机得到一个在 `(0, 100 ]` 的数，得到的任何一个小于等于 20 的数，即该数值落在 `(0, 20]` 区间都为中奖。

- 第一次抽奖，中奖，算法结束。
- 第一次抽奖未中奖，那么假设我们设定第二个奖品中奖概率是 10%，也就是在 `(0, 80]` 区间中的 `(0, 10]` 区间， 我们可以计算得出 `1/8` 的中奖概率，但是由于先前已经抽奖过一次，我们需要将先前的未中奖的概率算入进来， `1 -  20% = 4/5` 的未中奖概率，此时 可以计算 `1/8 * 4/5 = 1/10` 的概率，也就是，**第一次抽奖未中奖，第二次中奖的概率为 `1/10` 即 10%**

<br>

**数据库设计：**

```shell
CREATE TABLE `sc_lottery_prizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prize_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '奖品名',
  `source` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '抽奖期数',
  `probability` int NOT NULL DEFAULT '0' COMMENT '中奖概率',
  `stock_count` int unsigned NOT NULL COMMENT '库存数量',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sc_lottery_prizes_source_index` (`source`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```



## 三、排行榜

zset实现学生成绩排行榜



