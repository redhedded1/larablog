@setup
require __DIR__.'/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
try {
$dotenv->load();
$dotenv->required(['DEPLOY_SERVER', 'DEPLOY_REPOSITORY', 'DEPLOY_PATH'])->notEmpty();
} catch ( Exception $e )  {
echo $e->getMessage();
}

$server = getenv('DEPLOY_SERVER');
$repo = getenv('DEPLOY_REPOSITORY');
$path = getenv('DEPLOY_PATH');
$env_path = getenv('ENV_PATH');
$laradock_dir = getenv('LARADOCK_DIR');
$site_path = getenv('SITE_PATH');

if ( substr($path, 0, 1) !== '/' ) throw new Exception('Careful - your deployment path does not begin with /');

$env = isset($env) ? $env : "local";
$branch = isset($branch) ? $branch : "master";
$path = rtrim($path, '/');
@endsetup

@servers(['web' => $server])

@task('deploy')
cd {{ $path }}
git pull origin master

cp -r * {{ $site_path }}
cp {{ $env_path }} {{ $site_path }}
composer update --no-interaction --quiet --no-dev
echo "Composer update completed"

{{--php artisan migrate --force --no-interaction--}}
{{--echo "Migrations ran"--}}

{{--php artisan view:clear --quiet--}}
{{--php artisan cache:clear --quiet--}}
{{--php artisan config:cache --quiet--}}
{{--echo 'Caches cleared'--}}

{{--php artisan optimize --quiet--}}

echo "Deployment complete"
@endtask