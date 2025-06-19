# Laravel E-commerce Platform

A full-featured e-commerce platform built with Laravel.

## 📞 Contact
- **GitHub**: [Addy2323](https://github.com/Addy2323)
- **Phone**: 0768828247

## 🚀 Prerequisites

Before you begin, ensure you have the following installed on your system:
- PHP >= 8.0
- Composer
- Node.js >= 14.x and npm
- MySQL >= 5.7 or MariaDB >= 10.3
- Web Server (Apache/Nginx)

## 🛠 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Addy2323/ecommerce-laravel.git
   cd ecommerce-laravel
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   - Create a new MySQL database
   - Update `.env` file with your database credentials:
     ```
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

6. **Run Migrations and Seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Compile Assets**
   ```bash
   npm run dev
   # or for production
   # npm run prod
   ```

9. **Start the Development Server**
   ```bash
   php artisan serve
   ```

10. **Access the Application**
    Open your browser and visit: `http://localhost:8000`

## 🔐 Default Admin Credentials
- **Email**: admin@example.com
- **Password**: password

## 🌟 Features
- User authentication and authorization
- Product management
- Shopping cart functionality
- Order processing
- Payment gateway integration
- Admin dashboard
- Responsive design

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Support
For support, email [myambaado@gmail.com] or call 0768828247.
