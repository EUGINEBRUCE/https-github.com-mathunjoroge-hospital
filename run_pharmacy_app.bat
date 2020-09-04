cd C:\xampp\apache\bin
httpd.exe -k install
httpd.exe -k start
cd C:\xampp\mysql\bin\
mysqld.exe --install
net start mysql
move C:\pharmacy  C:\xampp\htdocs
start http://localhost/pharmacy/index.php?db_install=true