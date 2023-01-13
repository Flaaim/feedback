# Тестовое задание:форма обратной связи на laravel
## Описание задания
-регистрация\авторизация: стандартный модуль auth (но пользователи должны быть с двумя ролями: менеджер и клиент.
Клиенты регистрируются самостоятельно, а аккаунт менеджера должен быть создан заранее, логин и пароль выслать вместе с готовым заданием)
-после логина, клиент видит форму обратной связи, а менеджер список заявок. (все страницы и функционал доступны только авторизованным пользователям и только в соответствии с их привилегиями)
-менеджер может просматривать список заявок и отмечать те, на которые ответил.
-список заявок:
*ID, тема, сообщение, имя клиента, почта клиента, ссылка на прикрепленный файл, время создания
клиент может оставлять заявку, но не чаще раза в сутки.
-на странице создания заявки: тема и сообщение, файловый инпут кнопка "отправить".
-в момент обработки формы и создания заявки отправлять менеджеру email со всеми данными
-отправку почты реализовать асинхронно (используя очереди), сделать хотя бы частичное покрытие тестами.

## Развертывание приложения.
### Homestead
1. Скачиваем репозиторий с GitHub. `https://github.com/Flaaim/feedback`
Переходим в папку проекта `cd feedback`
2. Обновляем зависимости: в директории проекта выполняем `composer update`
3. Копируем `.env` файл 
```
cp .env.example .env
```
4. Генерируем ключ `php artisan key:generate`
5. Устанавливаем подключение с базой данных
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=feedback
DB_USERNAME=homestead
DB_PASSWORD=secret
```
6. Запускаем миграции (при необходимости).
7. Устанавливаем phpmyadmin.
```
curl -sS https://raw.githubusercontent.com/grrnikos/pma/master/pma.sh | bash
//hosts на основной машине.
127.0.0.1 phpmyadmin.test 
```
8. На хост машине в директории feedback выполняем команду `npm install && npm run dev`
9. Настраиваем Mailhog:
```
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### Docker

1. Скачиваем репозиторий с GitHub. https://github.com/Flaaim/feedback
2. Строим приложение: в директории проекта выполняем команду `docker compose build`, `docker compose up`
3. Обновляем зависимости `docker exec feedback-php-1 composer update`
4. Копируем `.env` файл 
```
cp .env.example .env
```
5. Генерируем ключ `docker exec feedback-php-1 php artisan key:generate`
6. Устанавливаем подключение с базой данных. 
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=feedback
DB_USERNAME=app
DB_PASSWORD=secret
```
7. Запускаем миграции `docker exec feedback-php-1 php artisan migrate`
8. Выполняем команду: `npm update && npm run dev`
9. Настраиваем Mailhog:
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```