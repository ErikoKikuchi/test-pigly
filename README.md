# PiGLy  
  
## 環境構築  
　ubuntsu仕様にて構築  
  
## Dockerbuild  
- git clone git@github.com:ErikoKikuchi/test-pigly.git  
- cd test-pigly  
- git remote set-url origin 作成したリポジトリのurl  
- docker-compose up -d --build  
  
## Laravel環境構築  
- docker-compose exec php bash  
- composer install  
- composer create-project "laravel/laravel=8.*" . --prefer-dist  
- sudo chmod -R 777 src/*(windowsの場合)  
- 開発環境ではAsia/Tokyoに設定済  
- cp .env.example .env  
  -- DB_HOST=mysql,  
  -- DB_DATABASE=laravel_db,  
  -- DB_USERNAME=laravel_user,  
  -- DB_PASSWORD=laravel_pass  
- php artisan key:generate  
- php artisan migrate  
- php artisan db:seed  
  
## 開発環境  
- トップページ(管理画面)（http://localhost/weight_logs）  
- 新規会員登録画面(http://localhost/register/step1)  
  (次に進むボタン押下にて)初期体重登録画面→アカウント作成  
- ログイン画面(http://localhost/login)  
  (ログインにより)体重管理画面へ→画面内ボタン押下にてデータ追加画面へ  
  (ログイン後)体重管理画面→鉛筆ボタン押下にて詳細画面へ→更新・削除可能  
  (ログイン後)体重管理画面→上部ボタン押下にて目標体重設定画面へ  
  (ログイン後)体重管理画面→ログアウト可能  

## 使用技術（実行環境）  
- php:8.1-fpm（Dockerfile）  
- Laravel：8.75  
- MySQL:8.0.26  
- nginx:1.21.1  

## データベース設計  
- ![ER図](/src/pigly.png)  



