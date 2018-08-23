Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.synced_folder "F:/GitRepo", "/projectkit"
  config.vm.hostname = "docker-server"
  config.vm.network "private_network", ip: "172.20.20.21"
  config.vm.network "forwarded_port", guest: 80, host: 80

  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = 1500
    vb.cpus = 1
  end
  config.vm.provision "shell", inline: <<-SHELL
     sudo apt-get update
     sudo apt-get install -y whois git
     sudo useradd -m -p `mkpasswd password` -s /bin/bash dev
     sudo usermod -a -G sudo dev
     wget -qO- https://get.docker.com/ | sh
     sudo usermod -a -G docker dev
     COMPOSE_VERSION=1.14.0
     sudo wget https://github.com/docker/compose/releases/download/${COMPOSE_VERSION}/docker-compose-`uname -s`-`uname -m` -O /usr/local/bin/docker-compose
     sudo chmod +x /usr/local/bin/docker-compose
  SHELL
end