set :stage, :staging
set :deploy_to, -> { "/home/dh_dpmwgu/westex.pandabrand.net" }
set :tmp_dir, "/home/dh_dpmwgu/capistrano_tmp"

# Simple Role Syntax
# ==================
#role :app, %w{deploy@example.com}
#role :web, %w{deploy@example.com}
#role :db,  %w{deploy@example.com}

# Extended Server Syntax
# ======================
server 'cottrell.dreamhost.com', user: 'dh_dpmwgu', roles: %w{web app db}
SSHKit.config.command_map[:composer] = '/usr/local/php56/bin/php /home/dh_dpmwgu/.php/composer'
# you can set custom ssh options
# it's possible to pass any option but you need to keep in mind that net/ssh understand limited list of options
# you can see them in [net/ssh documentation](http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start)
# set it globally
#  set :ssh_options, {
#    keys: %w(~/.ssh/id_rsa),
#    forward_agent: false,
#    auth_methods: %w(password)
#  }

fetch(:default_env).merge!(wp_env: :staging)
