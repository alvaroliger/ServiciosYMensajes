pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'python3 -m venv venv'
                sh '. venv/bin/activate'
                sh 'echo "Entorno virtual creado"'
            }
        }

        stage('Test') {
            steps {
                sh 'echo "No hay pruebas definidas"'
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo "Despliegue simulado"'
            }
        }
    }
}
