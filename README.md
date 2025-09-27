
# 📌 Laravel Vue CRUD

A simple full-stack CRUD application built with **Laravel 11** for the backend and **Vue 3 Composition API** for the frontend, featuring user management with authentication.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat&logo=laravel)](https://laravel.com)
[![Vue](https://img.shields.io/badge/Vue-3.x-green?style=flat&logo=vue.js)](https://vuejs.org)
[![Inertia](https://img.shields.io/badge/Inertia.js-1.x-purple?style=flat&logo=inertiajs)](https://inertiajs.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-blue?style=flat&logo=mysql)](https://mysql.com)

---

## ✨ Features

- 🔐 **User Authentication** - Login/Register with Laravel Breeze
- 👥 **User Management** - Complete CRUD operations for users
- 🎨 **Modern UI** - Clean and responsive design with Tailwind CSS
- ⚡ **Real-time Updates** - SPA experience with Inertia.js
- 🔔 **Toast Notifications** - SweetAlert2 integration for user feedback
- 📱 **Mobile Responsive** - Works seamlessly on all devices
- 🛡️ **Form Validation** - Client-side and server-side validation
- 📄 **Pagination** - Efficient data loading with Laravel pagination

---

## 🛠️ Tech Stack

| Category | Technology |
|----------|------------|
| **Backend** | Laravel 11, PHP 8.2+ |
| **Frontend** | Vue 3 (Composition API), Inertia.js |
| **Styling** | Tailwind CSS |
| **Database** | MySQL 8.0+ |
| **Authentication** | Laravel Breeze |
| **Notifications** | SweetAlert2 |
| **Build Tool** | Vite |

---

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/laravel-vue-crud.git
cd laravel-vue-crud
```

### 2️⃣ Create a Database
- Open phpMyAdmin (or any MySQL client)
- Create a new database (e.g., `laravel_vue_crud`)

### 3️⃣ Configure Environment
Copy the example environment file and update the database configuration:
```bash
cp .env.example .env
```

Open the `.env` file and update the following values:
```env
DB_DATABASE=laravel_vue_crud
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4️⃣ Install PHP Dependencies
```bash
composer install
```

### 5️⃣ Generate Application Key
```bash
php artisan key:generate
```

### 6️⃣ Install JavaScript Dependencies
```bash
npm install
```

### 7️⃣ Run Database Migrations
```bash
php artisan migrate
```

### 8️⃣ Seed the Database (Optional)
```bash
php artisan db:seed
```

### 9️⃣ Start Laravel Server
```bash
php artisan serve
```

### 🔟 Run Vite Dev Server
Open a new terminal and run:
```bash
npm run dev
```

### ✅ Access the Application
Visit **http://localhost:8000** and enjoy your fully functional CRUD app! 🎉

---

## 📁 Project Structure

```
laravel-vue-crud/
├── app/
│   ├── Http/Controllers/     # API Controllers
│   ├── Models/              # Eloquent Models
│   └── Services/            # Business Logic Services
├── resources/
│   ├── js/
│   │   ├── Components/      # Vue Components
│   │   ├── Layouts/         # Layout Components
│   │   ├── Pages/           # Page Components
│   │   └── Utils/           # Utility Functions
│   └── views/               # Blade Templates
├── routes/
│   ├── web.php             # Web Routes
│   └── api.php             # API Routes
└── database/
    ├── migrations/         # Database Migrations
    └── seeders/           # Database Seeders
```

---

## 🚀 Features Overview

### User Management
- **Create User**: Add new users with name, email, role, and password
- **View Users**: Paginated list of all users with search and filtering
- **Update User**: Edit user information with form validation
- **Delete User**: Soft delete users with confirmation dialog

### Authentication
- **Login/Register**: Secure authentication with Laravel Breeze
- **Password Reset**: Email-based password recovery
- **Session Management**: Automatic session handling

### User Experience
- **Toast Notifications**: Success/Error messages with SweetAlert2
- **Form Validation**: Real-time validation feedback
- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Loading States**: Visual feedback during API requests

---

## 🔧 Available Scripts

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start Laravel development server |
| `npm run dev` | Start Vite development server |
| `npm run build` | Build assets for production |
| `php artisan migrate` | Run database migrations |
| `php artisan db:seed` | Seed database with sample data |
| `php artisan test` | Run PHPUnit tests |

---

## 📝 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/users` | List all users (paginated) |
| `GET` | `/users/create` | Show create user form |
| `POST` | `/users` | Store a new user |
| `GET` | `/users/{user}/edit` | Show edit user form |
| `PUT` | `/users/{user}` | Update user |
| `DELETE` | `/users/{user}` | Delete user |

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

**Your Name**
- GitHub: [@your-username](https://github.com/your-username)
- LinkedIn: [Your LinkedIn](https://linkedin.com/in/your-profile)
- Email: your.email@example.com

---

## ⭐ Show Your Support

Give a ⭐️ if this project helped you!

---

## 📸 Screenshots

### Dashboard
![Dashboard](screenshots/dashboard.png)

### User Management
![User List](screenshots/user-list.png)

### Create/Edit User
![User Form](screenshots/user-form.png)

> **Note**: Add actual screenshots to the `screenshots/` directory in your repository.

---

<div align="center">
  <sub>Built with ❤️ using Laravel & Vue.js</sub>
</div>
