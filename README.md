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