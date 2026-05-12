## STEP 1 — Launch AWS EC2 Instance
Launch:

Ubuntu 22.04 t2.micro student_key.pem

Open Security Group Ports:

Type	Port
SSH	22
HTTP	80
Custom TCP	8080

## EC2 Setup (Complete Step-by-Step)

STEP 2 — Connect to EC2

ssh -i student.key.pem ubuntu@YOUR_PUBLIC_IP
🚀 STEP 3 — Update Server

sudo apt update -y && sudo apt upgrade -y
🚀 STEP 4 — Install Docker

curl -fsSL https://get.docker.com -o get-docker.sh

sudo sh get-docker.sh
Enable Docker:

sudo systemctl enable docker
sudo systemctl start docker
Give Docker permission:

sudo usermod -aG docker ubuntu
Reconnect SSH after this step

🚀 STEP 5 — Install Docker Compose

sudo apt install docker-compose-plugin -y
Check version:

docker compose version
🚀 STEP 6 — Verify Docker

docker --version

sudo usermod -aG docker ubuntu

exit

ssh -i student.key.pem ubuntu@YOUR_PUBLIC_IP

docker ps


newgrp docker

docker ps

git clone repositoryname

docker compose up --build -d






