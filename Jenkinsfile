pipeline {
    agent none
	stages {
	    stage('Remove php and nginx containers') {
		    agent any
	        steps {
			    sh 'docker-compose down'
			}
		}
		stage('Create php and nginx containers') {
		    agent any
			steps {
			    sh 'docker-compose up -d --force-recreate'
			}
		}
		stage('print docker ps') {
		    agent any
			steps {
			    sh 'docker ps'
		    }
		}
	}
}
