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


After login to project in EC2 in ssh  make these changes

FINAL FIX STEPS (FOLLOW EXACTLY)

🔴 STEP 1 — Generate correct password hash (IMPORTANT)

Run:

docker exec -it php-app php -r "echo password_hash('admin123', PASSWORD_DEFAULT);"

✔ Copy the output (it must start with $2y$10$...)

❌ Do NOT copy anything else

🔴 STEP 2 — Delete old admin user

docker exec -it mysql mysql -uroot -proot studentdb -e "DELETE FROM users WHERE email='admin@gmail.com';"

🔴 STEP 3 — Open MySQL container

docker exec -it mysql mysql -uroot -proot studentdb

🔴 STEP 4 — Insert NEW admin (VERY IMPORTANT)

## Inside MySQL:

INSERT INTO users(email,password,role)
VALUES(
'admin@gmail.com',
'PASTE_HASH_HERE',
'admin'
);

✔ Paste ONLY clean hash from Step 1

❌ No spaces

❌ No extra text

❌ No commands

# 🔴 STEP 5 — Verify data

Exit MySQL and run:

docker exec -it mysql mysql -uroot -proot studentdb -e "SELECT email,password FROM users;"

✔ You should see only clean hash

# 🔴 STEP 6 — LOGIN TEST  in browser check 

**publicip:8080**

Use:

Email: admin@gmail.com

Password: admin123

change the login password in 



docker compose up --build -d 

docker compose down  

or 

docker compose down -v



