# 👉 Number Classification API - PHP Version

This is a simple **Number Classification API** built with PHP. It takes an integer as input, analyzes its mathematical properties, and provides a **fun fact** using the Numbers API.

---

## 🚀 Features
- ✅ Checks if a number is **prime** or **perfect**.
- ✅ Identifies if it's an **Armstrong number**.
- ✅ Determines whether it's **odd** or **even**.
- ✅ Calculates the **sum of its digits**.
- ✅ Fetches a **fun fact** about the number.
- ✅ Returns JSON responses.
- ✅ Deployed on **AWS EC2**.

---

## 💽 API Endpoint
| Method | Endpoint | Description |
|--------|----------|-------------|
| **GET** | `/app.php?number=371` | Returns the properties of the given number. |

---

## 📀 Example API Response  

### ✅ **Success Response (200 OK)**  
Request:  
```bash
GET http://your-ec2-public-ip/app.php?number=371
```
Response:
```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

### ❌ **Error Response (400 Bad Request)**  
Request:  
```bash
GET http://your-ec2-public-ip/app.php?number=abc
```
Response:
```json
{
    "number": "abc",
    "error": true
}
```

---

## 🛠 Installation Guide (Run Locally)  

### **1️⃣ Clone the Repository**
```bash
git clone <your-github-repo-url>
cd NCAPI-php
```

### **2️⃣ Start a Local Server**
If you have PHP installed, run:
```bash
php -S localhost:8000
```
Now, open **http://localhost:8000/app.php?number=371** in your browser.

---

## 🌍 Deployment Guide (AWS EC2)
### **1️⃣ Install Apache & PHP**
For **Ubuntu/Debian**:
```bash
sudo apt update
sudo apt install apache2 php libapache2-mod-php -y
```
For **Amazon Linux**:
```bash
sudo yum update -y
sudo yum install httpd php php-mbstring -y
```
Start and enable Apache:
```bash
sudo systemctl start apache2   # Ubuntu
sudo systemctl start httpd     # Amazon Linux
```

### **2️⃣ Clone and Move API File**
```bash
cd /var/www/html/
sudo git clone <your-github-repo-url> NCAPI-php
sudo mv /var/www/html/NCAPI-php/app.php /var/www/html/
```

### **3️⃣ Set Permissions**
```bash
sudo chmod 644 /var/www/html/app.php
sudo chown -R www-data:www-data /var/www/html/  # Ubuntu
sudo chown -R apache:apache /var/www/html/      # Amazon Linux
```

### **4️⃣ Restart Apache**
```bash
sudo systemctl restart apache2   # Ubuntu
sudo systemctl restart httpd     # Amazon Linux
```

### **5️⃣ Open API in Browser**
```
http://your-ec2-public-ip/app.php?number=371
```

---

