支付宝免费接口 实现1
====================
免费使用支付宝即时到账，自动发货。

支付宝免费支付接口，在chrome浏览器上运行

演示:
给yansapjxe@sohu.com支付任意数额资金，在支付后20秒内可以在https://notify.duapp.com    上面看到刚刚支付的记录。

使用步骤:
JS装在chrome的tampermonkey插件下，PHP上传到服务器上，修改好相应代码（特别是交易所用于防攻击的KEY）。
chrome访问下面的地址即可开始同步订单数据：
https://consumeprod.alipay.com/record/standard.htm?_input_charset=utf-8&dateRange=oneMonth&tradeType=gathering&status=success&fundFlow=all&dateType=createDate

传参:
可以使用下面的链接方式传递订单等参数，在获取到支付数据后，根据title来进行相应的逻辑:
http://shenghuo.alipay.com/send/payment/fill.htm?_tosheet=true&title=ORDER_2013091740199&optEmail=yansapjxe@sohu.com&payAmount=1

赞助:
支付宝赞助yansapjxe@sohu.com