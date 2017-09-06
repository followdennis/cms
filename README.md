# cms

1、安装依赖库
-----------------------------------  
 composer install
composer update  # 解决composer install报错问题
    
### 2、.env配置
 大家可以使用 .env.example 配置自己的，如：
cp .env.example .env

### 3、目录权限
设置 storage 目录和 bootstrap/cache 目录写权限

sudo chmod -R a+w storage
sudo chmod -R a+w bootstrap/cache
