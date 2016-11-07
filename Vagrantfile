# -*- mode: ruby -*-
# vi: set ft=ruby :
#
Vagrant.configure(2) do |config|
  config.ssh.forward_agent = true
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.ignore_private_ip = false
  config.hostmanager.include_offline = true
  config.vm.boot_timeout = 9000

  if !Vagrant.has_plugin?('vagrant-hostmanager')
    puts 'Required plugin vagrant-hostmanager is not installed! Install with "vagrant plugin install vagrant-hostmanager"'
    #exit
  end

  config.vm.define 'learningmachine' do |node|
		node.vm.box = "ubuntu/trusty64"
    node.vm.network :private_network, ip: "192.168.56.101"
    node.vm.network :forwarded_port, guest: 80, host: 8080
    node.vm.network :forwarded_port, guest: 2057, host: 2057
    node.vm.network :forwarded_port, guest: 5432, host: 5432

    node.vm.provider :virtualbox do |v|
      v.customize ["modifyvm", :id, "--memory", 3072]
      v.customize ["modifyvm", :id, "--cpus", 8]
    end

    node.vm.synced_folder "./", "/var/www", id: "vagrant-root",nfs:true
    node.vm.hostname = 'learning.dev'
    node.hostmanager.aliases = %w(learning.prod)

    config.vm.provision :shell do |sh|
      sh.path = "vagrant/provision.sh"
    end
  end
end
