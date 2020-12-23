pipeline {
  agent any
    environment {
    GIT_COMMIT_SHORT = "a${env.GIT_COMMIT.take(7)}"
    DB_DATABASE_AUX = "a${env.GIT_COMMIT.take(7)}"
  }
  stages {
    stage("Build") {
      steps {
        sh 'cp ../.env .'
        sh 'php --version'
        sh 'composer install'
        sh 'composer --version'
        sh 'php artisan key:generate'
        sh 'php artisan cache:clear'
      }
    }
    stage("Frontend tests") {
      steps {
        nvm(nvmInstallURL: 'https://raw.githubusercontent.com/creationix/nvm/v0.33.2/install.sh', 
          nvmIoJsOrgMirror: 'https://iojs.org/dist',
          nvmNodeJsOrgMirror: 'https://nodejs.org/dist', 
          version: '12.13.0') {
            sh 'node -v'
            sh 'npm install'
            sh 'npm test'
            sh 'npm run dev'
        }
      }
    }
    stage('Test backend') {
      steps {
        sh '/usr/bin/php artisan mysql:createdb $GIT_COMMIT_SHORT'
        sh '/usr/bin/php artisan clear-compiled'
        sh '/usr/bin/php artisan optimize'
        sh '/usr/bin/php artisan route:clear'
        sh '/usr/bin/php artisan view:clear'
        sh '/usr/bin/php artisan cache:clear'
        sh 'echo ""DB_DATABASE=${DB_DATABASE_AUX}>> .env'
        sh '/usr/bin/php artisan config:cache'
        sh '/usr/bin/php artisan config:clear'
        sh '/usr/bin/php artisan migrate:fresh'
        sh '/usr/bin/php artisan passport:install'
        sh '/usr/bin/php vendor/bin/phpunit tests/Feature/'
        sh '/usr/bin/php vendor/bin/phpunit tests/Unit/'
      }
      post {
        always {
          sh '/usr/bin/php artisan mysql:deletedb $GIT_COMMIT_SHORT'
        }
      }
    }
  }
}