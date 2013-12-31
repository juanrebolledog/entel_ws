import os
from fabric.api import *
from fabric.contrib.console import confirm

DEPLOY_DIR = os.path.join(os.path.dirname(os.path.dirname(__file__)), 'deploy')
PROJECT_DIR = os.path.join(os.path.dirname(__file__))
PROJECT_NAME = os.path.split(os.path.dirname(__file__))[1]

host_config = {
    'dev.juanrebolledog.me': '/var/www/dev/entel/',
    'hidra.advante.cl': 'html/entel/'
}

def set_host():
    if not env.host:
        env.host = 'hidra.advante.cl'

def archive(branch):
    with lcd(PROJECT_DIR):
        local('git archive {0} -o {1}'.format(branch, os.path.join(DEPLOY_DIR, PROJECT_NAME + '-' + branch + '.tar')))

def extract(branch):
    with lcd(DEPLOY_DIR):
        local('rm -rf {0}-{1}'.format(PROJECT_NAME, branch))
        local('mkdir {0}-{1}'.format(PROJECT_NAME, branch))
        local('tar xf {0}-{1}.tar -C {2}'.format(PROJECT_NAME, branch, os.path.join(DEPLOY_DIR, PROJECT_NAME + '-' + branch)))

def sync(branch):
    with lcd(DEPLOY_DIR):
        local('rsync -avu {0}-{1}/ {2}:{3}'.format(PROJECT_NAME, branch, env.host, host_config[env.host]))

def test():
    with lcd(PROJECT_DIR):
        with settings(warn_only=True):
            result = local('phpunit', capture=True)
            if result.failed and not confirm("Tests failed. Continue anyway?"):
                abort("Aborting at user request.")

def secure_dir_perms():
    with cd(host_config[env.host]):
        run('chmod -R 777 app/public/img/*')
        run('chmod -R 777 app/storage/*')

def deploy(branch):
    test()
    set_host()
    archive(branch)
    extract(branch)
    sync(branch)
    #secure_dir_perms()

