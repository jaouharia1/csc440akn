# capistrano in ruby
from fabric.api import *

env.hosts = ['54.69.183.12']
env.user  = 'ec2-user'
env.key_filename = 'csc440-jaouharia1(1).pem'

def local_uname():
    local('uname -a')

def remote_uname():
    run('uname -a')

def deploy():
    code_dir = '/var/www/html'
    deploy_dir = 'csc440'
    github_url = 'https://github.com/jaouharia1/csc440akn.git'

    # install all packages you need here
    run('sudo yum install -y git httpd')

    # create dirs, set ownerships, then pull the code from git
    with cd(code_dir):
        run('sudo chown -R ec2-user.ec2-user .')
        with settings(warn_only=True):
            if run('test -d ' + deploy_dir).failed:
                run('git clone ' + github_url + ' ' + deploy_dir)
        with cd(deploy_dir):
            run('git pull')
            run('rm -rf deliverables')
