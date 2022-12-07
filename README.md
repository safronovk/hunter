# hunter

hunter - форма регистрации, форма авторизации, страница профиля.

## Установка окружения под Windows

### MariaDB:
- Скачиваем  [MariaDB](https://mariadb.org/download/).
- Устанавливаем. Во время установки создаем пароль по умолчанию для **root** - **0905194509051945**, отмечаем галочку **Enable access from remote machine for 'root' user**.
- Открываем программу **HeidiSQL** (устанавливается вместе с **mariaDB**)
- Вводим пароль от **root** - **0905194509051945**.
- Внутри программы нажимаем **Файл -> Загрузить SQL файл**, выбираем предоставленную базу данных **bd** из архива и нажимаем **Открыть**.
- Ищем синий значок на панели инструментов **Выполнить SQL...** и нажимаем его.
- База данных готова к работе.
---
### PHP:

- Скачиваем [PHP](https://windows.php.net/download/). Выбираем версию **7.2 Threadsafe для x64 версии OS**.
- В корневой директории диска **C:** создаем папку **usr**.
- В директории **C:\usr** создаем папку **php**.
- В созданную директорию **C:\usr\php** распаковываем содержимое скаченного архива.
- В директории **C:\usr\php** находим файл **php.ini-development**, копируем его в эту-же директорию, и переименовываем на **php.ini**.
- Открываем **php.ini** любым подходящим редактором, ищем и обновляем настройки на:
```php
1. max_execution_time = 600
2. memory_limit = 512M
3. post_max_size = 128M
4. upload_max_size = 128M
```
- В этом-же файле ищем и раскомментировываем следующие значения:
```php
1. extension=bz2
2. extension=curl
3. extension=fileinfo
4. extension=gd2
5. extension=gettext
6. extension=gmp
7. extension=intl
8. extension=mbstring
9. extension=exif
10. extension=mysqli
11. extension=openssl
12. extension=pdo_mysqli
13. extension=soap
14. extension=sockets
15. extension=sqlite3
16. extension=xsl
```
---
### Apache:
- Скачиваем последнюю версию [Apache](https://www.apachelounge.com/download/).
- В директории **C:\usr** создаем папку **apache**.
- В созданную директорию **C:\usr\apache** распаковываем содержимое скаченного архива.
- В рабочей директории(пример - **C:/Users/kir/** - рабочая директория, где **kir** - имя пользователя. ) создаем папку **htdocs**.
- Заходим в папку **htdocs** и целиком перетаскиваем сюда папку **hunter.com** из предоставленного архива (файл базы данных **bd** уже можно удалить).
- В директории **C:\usr\apache\conf** находим и настраиваем конфигурационный файл **httpd.conf** любым подходящим редактором:

1. Находим и переопределяем директорию по умолчанию **Define SRVROOT C:/usr/apache**.
2. Раскомментировываем строку **LoadModule rewrite_module modules/mod_rewrite.so**.
3. Расскомментировываем **ServerName localhost:80**
4. Обновляем пути к директории **DocumentRoot** на:
   **DocumentRoot "C:/Users/kir/htdocs"
   <Directory "C:/Users/kir/htdocs">**
5. Меняем значение директивы **AllowOverride None** на **AllowOverride All**.
6. Обновляем директиву **DirectoryIndex index.html** на **DirectoryIndex index.html index.php**.
7. Разрешаем подключение файла **httpd-vhosts.conf**:
   **# Virtual hosts
   Include conf/extra/httpd-vhosts.conf**

- В директории **C:\usr\apache\conf\extra\** находим файл **httpd-vhosts.conf**, открываем любым подходящим редакторами добавляем снизу:
```php
<VirtualHost \*:80>
ServerAdmin webmaster@dummy-host.example.com
DocumentRoot "c:/Users/kir/htdocs/hunter.com"
ServerName hunter.com
# ServerAlias www.dummy-host.example.com
ErrorLog "logs/hunter.com-error.log"
CustomLog "logs/hunter.com-access.log" common
</VirtualHost>**
```
### Устанавливаем Apache:

- Открываем консоль в режиме администратора и вводим **cd C:\usr\apache\bin**, вводим **httpd -k install**, вводим **httpd -k start**.
- В директории **C:\Windows\System32\drivers\etc** находим файл **hosts**, открываем файл любым подходящим редактором в режиме администратора и прописываем внизу **127.0.0.1 hunter.com**.
- Открываем директорию **C:\usr\apache\conf**, находим файл **httpd** открываем и прописываем в самом низу строки:
```php
# Update the PHP directory path as per your setup.
PHPIniDir "c:/usr/phpv"
AddHandler application/x-httpd-php .php
LoadModule php7_module "c:/usr/phpv/php7apache2_4.dll"
```
- Перезапускаем сервер: нажав в консоли **httpd -k stop**, далее **httpd -k start**.
## К запуску готово:
- [Меню](http://hunter.com/index.html)
- [Регистрация](http://hunter.com/registration.php)
- [Авторизация](http://hunter.com/auth.php)
- [Страница профиля](http://hunter.com/cabinet.php)