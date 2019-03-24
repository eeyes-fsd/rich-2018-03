# e瞳网寻宝思源游戏后端
## 项目说明
校内线上线下结合小游戏后端，主要功能包括抽卡、兑奖等。  
##部署  
<https://laravel.com/docs/5.7#installation>  
可能由于部分Composer包的限制，要求 `php >= 7.2`  
复制 `.env.example` 到 `.env` 并修改其中的数据库、Redis等配置信息  
### 部署脚本
```bash
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan storage:link
```
### 注意事项
重置数据库将删除全部数据  
```bash
php artisan migrate:refresh
php artisan cache:clear
```

执行如下生成密钥的命令将导致之前的加密数据全部失效 
```bash
php artisan key:generate
php artisan jwt:secret
```
## 开发者
* 前端：[Veeupup](https://github.com/Veeupup) [Finn](https://github.com/finntenzor)
* 后端：[f(x,z)=xzx](https://github.com/Xuzhixuan)
## LICENSE
MIT License  

Copyright (c) 2019 eeyes.net  

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:  

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.