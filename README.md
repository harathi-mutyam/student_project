## STEP 1 — Launch AWS EC2 Instance
Launch:

Ubuntu 22.04 t2.micro student_key.pem

Open Security Group Ports:

Type	Port
SSH	22
HTTP	80
Custom TCP	8080

## EC2 Setup (Complete Step-by-Step)

**STEP 2 — Connect to EC2**
```bash
ssh -i Downloads/student.key.pem ubuntu@YOUR_PUBLIC_IP
```
🚀 **STEP 3 — Update Server**
```bash
sudo apt update -y && sudo apt upgrade -y
```
🚀 **STEP 4 — Install Docker**
```bash
curl -fsSL https://get.docker.com -o get-docker.sh

sudo sh get-docker.sh
```
**Enable Docker:**
```bash
sudo systemctl enable docker

sudo systemctl start docker
```
**Give Docker permission:**
```bash
sudo usermod -aG docker ubuntu
```
**Reconnect SSH after this step**

🚀 STEP 5 — Install Docker Compose
```bash
sudo apt install docker-compose-plugin -y
```
**Check version:**
```bash
docker compose version
```
🚀 **STEP 6 — Verify Docker**
```bash
docker --version

sudo usermod -aG docker ubuntu

exit

ssh -i student.key.pem ubuntu@YOUR_PUBLIC_IP

docker ps


newgrp docker

docker ps

git clone repositoryname

docker compose up --build -d
```





