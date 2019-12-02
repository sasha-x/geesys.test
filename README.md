Issue
=====

Задание PHP.

Сгенерировать печатную форму для документа «Поручение»

Есть приложение, в котором пользователи могут заказать перевозку груза. Когда пользователь готов начать перевозку, он создает документ «Поручение на перевозку».

Задача. На основании данных, которые уже есть в приложении (дата, номер, наименования юр. лиц, адреса и т.д.), нужно создать печатную версию документа «Поручение», чтобы пользователь мог скачать ее себе и распечатать на бумаге.

Исходные данные: прилагается файл с примером печатной формы поручения.

Что требуется сделать:

1. Придумать и описать формат входных данных, которые вам потребуются для заполнения поручения.

(Предполагается, что программист, знакомый с бизнес-областью приложения, увидит ваше описание и отдаст на вход вашему классу данные именно в таком формате.)

2. Написать класс, который получив на вход данные в описанном вами формате, отдает на выходе содержимое PDF-файла с печатной формой.

Для тестового задания не нужно выводить всю форму поручения, достаточно шапки и блока «Реквизиты сторон».


Installation
============

Install pdf converter library (Ubuntu 18 example):

Install wkhtmltopdf
-------------------

```sh
sudo apt install xfonts-75dpi
wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox_0.12.5-1.bionic_amd64.deb
sudo dpkg -i ./wkhtmltox_0.12.5-1.bionic_amd64.deb
whereis wkhtmltopdf   # /usr/local/bin/
```

Install wkhtmltox
-----------------

```sh
sudo apt install php7.2-dev
git clone https://github.com/krakjoe/wkhtmltox
cd wkhtmltox
phpize
./configure --with-wkhtmltox=/usr/local/bin/
make
sudo make install
cd ..
rm -rf wkhtmltox
```

Enable wkhtmltox module
-----------------------

```sh
echo "extension=wkhtmltox.so" |sudo tee /etc/php/7.2/mods-available/wkhtmltox.ini > /dev/null
sudo phpenmod wkhtmltox
php -m|grep wkhtmltox  #ensure module enabled
```

Composer install
----------------

`composer install`