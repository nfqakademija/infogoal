# InfoGoal

## Setup
1. Download and install [virtualbox](<https://www.virtualbox.org/wiki/Downloads) (4.3+)
2. Download and install [vagrant](https://www.vagrantup.com/downloads.html) (1.6.5+)
3. Restart your computer if neccesary.
4. Lunch terminal (cmd), go to this project directory and run `vagrant up`
5. ...wait...
6. Add `192.168.33.51 infogoal.dev` to the end of hosts file (C:\Windows\System32\drivers\etc\hosts). Do not duplicate it if such host is already defined.
7. Visit http://infogoal.dev

##### SSH
Also you can connect to virtual machine (via [putty](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html)).
```
Host: infogoal.dev
Username: vagrant
Password: vagrant
```

##### Vagrant
You can run all these commands ONLY at this project directory.
* `vagrant up` - starts VM.
* `vagrant halt` - stops VM.
* `vagrant reload` - restarts VM

