<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'vendor/deployer/recipes/recipe/slack.php';

// Project name
set('application', 'idn-experiment');

// Project repository
set('repository', 'git@github.com:djordanpapilaya/IDN-experiment.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('keep_releases', 3);

set('http_user', 'idnexperiment');

//lse21fE^hc8pJQrb

set('writable_mode', 'chmod');

// Shared files/dirs between deploys 
add('shared_files', [
	'.env',
]);
add('shared_dirs', [
	'storage',
]);

// Writable dirs by web server 
add('writable_dirs', [
	'bootstrap/cache',
	'storage',
	'storage/app',
	'storage/app/public',
	'storage/framework',
	'storage/framework/cache',
	'storage/framework/sessions',
	'storage/framework/views',
	'storage/logs',
]);


// Hosts
host('idn-experiment.nl')
	->forwardAgent()
	->user('mrdjordan')
	->stage('production')
	->set('branch', 'master')
	->set('bin/php', 'php')
	->set('bin/composer', 'composer')
	->set('deploy_path', '/var/www/vhosts/mrdjordan.amsterdam/idn-experiment.nl');

    
// Tasks
desc('Deploy your project');
task('deploy', [
	'deploy:info',
	'deploy:prepare',
	'deploy:lock',
	'deploy:release',
	'deploy:update_code',
	'deploy:shared',
	'deploy:vendors',
	'deploy:writable',
	'artisan:storage:link',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:optimize',
	'deploy:symlink',
	'deploy:unlock',
	'cleanup',
	'frontend-build',
//    'symlink:admin',
]);

task('frontend-build', function(){
	run('cd {{release_path}}/resources && rm package-lock.json');
	run('cd {{release_path}}/resources && rm yarn.lock');
	run('cd {{release_path}}/resources && yarn');
	run('cd {{release_path}}/resources && yarn build');
	run('cd {{release_path}}/resources && rm -rf node_modules');
});

//task('build', function () {
//    run('cd {{release_path}} && build');
//});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

after('deploy', 'success');

set('slack_webhook', 'https://hooks.slack.com/services/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');
set('slack_text', '_{{user}}_ deploying `{{branch}}` to *{{target}}*');
after('success', 'slack:notify:success');
after('deploy:failed', 'slack:notify:failure');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

