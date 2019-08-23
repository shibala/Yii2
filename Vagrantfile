Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/bionic64"
  
  config.vm.define "GB_Yii2" do |t|
  
  config.vm.synced_folder "app/", "/data/mysite.local/app", create:true
  
  config.vm.network "forwarded_port", guest: 80, host: 80, host_ip:"127.0.0.1"
end

config.vm.provider "virtualbox" do |v|
    v.name = "GB_Yii2"
end

config.vm.network "private_network", ip: "192.168.2.10"
   config.vm.provider "virtualbox" do |vb|
    vb.memory = "2048"
end


config.vm.provision "shell", inline: <<-SHELL
apt update
apt -y upgrade
add-apt-repository ppa:nginx/stable
apt update
apt -y install nginx
systemctl enable nginx
add-apt-repository -y ppa:ondrej/php
apt update
apt -y upgrade
apt -y install php7.2 php7.2-cli php7.2-gd php7.2-curl php7.2-mysql php7.2-ldap php7.2-zip php7.2-fpm php7.2-mbstring php7.2-pgsql php7.2-xml php7.2-xsl php7.2-soap php7.2-readline php7.2-json php7.2-intl php7.2-imap
systemctl enable php7.2-fpm

#mkdir /data
#mkdir  /data/mysite.local
#mkdir  /data/mysite.local/app
mkdir  /data/mysite.local/log
usermod vagrant -g1000 -G33
cd /data/mysite.local
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
apt -y install unzip
composer create-project --prefer-dist yiisoft/yii2-app-basic app
chown -R vagrant:www-data /data
chmod 0777 -R /data
rm /etc/nginx/sites-available/default
cd /etc/nginx/sites-available/
wget  https://raw.githubusercontent.com/TalismanFR/for_lesson1/master/default
nginx -s reload

debconf-set-selections <<< 'mysql-server mysql-server/root_password password vagrant'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password vagrant'
apt-get update
apt-get install -y mysql-server
SHELL
end