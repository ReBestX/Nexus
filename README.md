# Nexus Social

> A modern, feature-rich social media platform built with PHP, Tailwind CSS, and MySQL — designed for seamless content creation, user interaction, and community engagement.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.3-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB_10.4-4479A1?style=flat-square&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![jQuery](https://img.shields.io/badge/jQuery-3.7.0-0769AD?style=flat-square&logo=jquery&logoColor=white)
![License](https://img.shields.io/badge/License-ISC-green?style=flat-square)

---

## 🎥 Project Preview

Check out the project preview video to get a visual overview of the platform:

[![Watch the Project Preview Video](https://img.shields.io/badge/YouTube-Watch_Demo-red?style=for-the-badge&logo=youtube)](https://youtu.be/sy2gPF2ULxY)

---

## 🌟 Features

### 🔐 Authentication & Security
- **Secure Login & Registration** — Robust authentication system with session management
- **Password Encryption** — Bcrypt hashing for secure password storage
- **Password Recovery** — Email-based password reset with token validation via PHPMailer
- **Role-Based Access Control** — Admin and user role separation

### 👤 User Experience
- **Personalized Profiles** — Custom user profiles with avatar uploads
- **Draft Posts** — Save posts as drafts before publishing
- **Post Interactions** — Like, comment, and engage with community content
- **Real-Time Search** — Find posts and users instantly

### 🎨 Design & Interface
- **Modern UI/UX** — Clean, intuitive interface with Tailwind CSS
- **Responsive Design** — Fully responsive across all device sizes
- **Smooth Animations** — ScrollReveal.js for engaging scroll-based effects
- **Interactive Alerts** — SweetAlert2 for beautiful notification modals
- **Skeleton Loaders** — Enhanced loading experience with skeleton screens

### ⚙️ Administration
- **Admin Dashboard (CMS)** — Complete control panel for platform management
- **User Management** — Create, edit, and manage user accounts
- **Post Management** — Full CRUD operations for all content
- **Comment Moderation** — Approve, edit, or remove user comments
- **Category Management** — Organize content with customizable categories

---

## 📱 Sections

| Section | Description |
|---------|-------------|
| 🏠 **Home** | Main feed with paginated posts and sidebar |
| 👤 **Profile** | User profile with posts and account settings |
| ✍️ **Create Post** | Rich content creation with image uploads |
| 📂 **Categories** | Browse posts by category |
| 🔍 **Search** | Find posts and users |
| 🔐 **Sign In/Up** | Authentication pages |
| 🛠️ **Admin CMS** | Full-featured content management system |
| ℹ️ **About** | Platform information |
| 💼 **Services** | Service offerings |
| 📁 **Projects** | Project showcase |
| 📞 **Support** | Contact and support |

---

## 🚀 Tech Stack

| Category | Technology |
|----------|------------|
| **Frontend** | HTML5, CSS3, JavaScript (ES6+) |
| **Styling** | Tailwind CSS 3.3, Custom CSS |
| **UI Components** | Material Tailwind HTML |
| **Animations** | ScrollReveal.js |
| **Alerts** | SweetAlert2 |
| **Icons** | Font Awesome, Nucleo Icons |
| **Fonts** | Google Fonts (Inter, Satoshi) |
| **AJAX** | jQuery 3.7.0 |
| **Backend** | PHP 8.2 |
| **Database** | MySQL (MariaDB 10.4) |
| **Email** | PHPMailer 6.8 |
| **Server** | Apache (XAMPP/LAMP/WAMP) |

---

## 📦 Getting Started

### Prerequisites

- **PHP** 8.0 or higher
- **MySQL** 5.7+ or MariaDB 10.4+
- **Apache** web server (or Nginx with PHP-FPM)
- **Node.js** 16+ (for Tailwind CSS compilation)
- **Composer** (PHP dependency manager)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ReBestX/Nexus.git
   cd Nexus
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Set up the database**
   - Create a MySQL database named `nexus`
   - Import the database schema:
     ```bash
     mysql -u root -p nexus < "Nexus database/nexus.sql"
     ```

5. **Configure database connection**
   - Edit `includes/db.php` with your database credentials:
     ```php
     $connection = mysqli_connect("localhost", "root", "", "nexus");
     ```
   - The default configuration uses `root` with an empty password (typical for XAMPP/WAMP local development)

6. **Configure email settings (optional)**
   - Update PHPMailer settings in `includes/ResetPassword.php` for password recovery emails

### Development Server

1. **Start your local server** (XAMPP, WAMP, or similar)

2. **Compile Tailwind CSS** (in watch mode)
   ```bash
   npm run dev
   ```

3. **Access the application**
   - Open `http://localhost/Nexus/dist/` in your browser

---

## 🎯 Available Scripts

| Command | Description |
|---------|-------------|
| `npm run dev` | Compile Tailwind CSS in watch mode |
| `composer install` | Install PHP dependencies |

---

## 📁 Project Structure

```
Nexus/
├── dist/                      # Main application (public-facing)
│   ├── index.php              # Home page
│   ├── sign-in.php            # Login page
│   ├── sign-up.php            # Registration page
│   ├── Profile.php            # User profile page
│   ├── post.php               # Individual post view
│   ├── create-post.php        # Post creation page
│   ├── category.php           # Category listing
│   ├── search.php             # Search functionality
│   ├── EditProfile.php        # Profile editing
│   ├── EditPassword.php       # Password change
│   ├── Forget_Password.php    # Password recovery
│   ├── SetNewPassword.php     # New password setup
│   ├── about.php              # About page
│   ├── Service.php            # Services page
│   ├── project.php            # Projects page
│   ├── Support.php            # Support page
│   ├── 404page.php            # Error page
│   └── output.css             # Compiled Tailwind CSS
│
├── includes/                  # PHP backend logic
│   ├── db.php                 # Database connection
│   ├── login.php              # Login handler
│   ├── Register.php           # Registration handler
│   ├── logout.php             # Logout handler
│   ├── ResetPassword.php      # Password reset email
│   ├── NewPassword.php        # Password update
│   ├── userPostAdd.php        # Post creation handler
│   ├── commentpost.php        # Comment handler
│   ├── updateProfile.php      # Profile update handler
│   └── ...                    # Other handlers
│
├── Nexus CMS/                 # Admin content management system
│   ├── dist/                  # CMS interface
│   │   ├── index.php          # Dashboard
│   │   ├── Posts.php          # Post management
│   │   ├── users.php          # User management
│   │   ├── comments.php       # Comment moderation
│   │   ├── Categories.php     # Category management
│   │   └── ...                # Other admin pages
│   ├── includes/              # CMS backend
│   └── Uploaded_images/       # User-uploaded content
│
├── Nexus database/            # Database files
│   ├── nexus.sql              # Database schema & sample data
│   └── nexus.json             # JSON export
│
├── src/                       # Source stylesheets
│   ├── input.css              # Tailwind source CSS
│   ├── NexusHome.css          # Home page styles
│   ├── profile.css            # Profile page styles
│   ├── post.css               # Post page styles
│   └── ...                    # Other CSS files
│
├── js/                        # JavaScript files
│   ├── index.js               # Main JavaScript
│   ├── login.js               # Login page scripts
│   ├── signup.js              # Registration scripts
│   ├── post.js                # Post interactions
│   └── jquery-3.7.0.min.js    # jQuery library
│
├── images/                    # Static assets
├── webfonts/                  # Font files
├── vendor/                    # Composer dependencies
├── node_modules/              # npm dependencies
├── tailwind.config.js         # Tailwind configuration
├── package.json               # Node.js configuration
├── composer.json              # PHP dependencies
└── README.md                  # This file
```

---

## 🎨 Customization

### Theme & Colors

Modify the Tailwind configuration in `tailwind.config.js`:

```javascript
module.exports = {
  content: ["./dist/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

To add custom colors, extend the theme:

```javascript
theme: {
  extend: {
    colors: {
      primary: '#your-color-here',
    },
  },
},
```

### Content Editing

- **Logo**: Replace images in `/images/` directory
- **Footer**: Edit footer section in PHP files
- **Navigation**: Modify menu items in the header sections

### Categories

Add or modify categories directly in the MySQL database via the Admin CMS or by updating the `categories` table.

---

## 🚢 Deployment

### Shared Hosting (Recommended)

1. Upload all files to your web hosting via FTP
2. Create a MySQL database and import `nexus.sql`
3. Update `includes/db.php` with production database credentials
4. Configure PHPMailer with your SMTP settings
5. Ensure `.htaccess` files are properly configured

### VPS/Dedicated Server

1. Set up LAMP/LEMP stack
2. Clone the repository to `/var/www/html/`
3. Configure Apache/Nginx virtual host
4. Set up MySQL and import the database
5. Configure SSL certificate (recommended: Let's Encrypt)

### Build Output

Compile Tailwind CSS for production:
```bash
npx tailwindcss -i ./src/input.css -o ./dist/output.css --minify
```

---

## 🔧 Environment Variables

Configuration is handled through PHP files. Key settings to configure:

| File | Setting | Description | Required |
|------|---------|-------------|----------|
| `includes/db.php` | Database connection | MySQL host, user, password, database name | ✅ |
| `includes/ResetPassword.php` | SMTP settings | Email server configuration for password recovery | ⚠️ Optional |

---

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Commit your changes**
   ```bash
   git commit -m 'Add some amazing feature'
   ```
4. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
5. **Open a Pull Request**

### Guidelines

- Follow existing code style and conventions
- Test your changes thoroughly
- Update documentation as needed
- Keep pull requests focused and concise

---

## 📝 License

This project is licensed under the **ISC License**.

---

## 👨‍💻 Author

**Ayman Ismail (ReBestX)**

- 🔗 LinkedIn: [aymanbismail](https://www.linkedin.com/in/aymanbismail/)
- 🐙 GitHub: [ReBestX](https://github.com/ReBestX)

---

## 🙏 Acknowledgments

- [Tailwind CSS](https://tailwindcss.com/) — Utility-first CSS framework
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) — Email sending library
- [SweetAlert2](https://sweetalert2.github.io/) — Beautiful alert modals
- [ScrollReveal](https://scrollrevealjs.org/) — Scroll animations
- [Font Awesome](https://fontawesome.com/) — Icon library
- [jQuery](https://jquery.com/) — JavaScript library

---

<div align="center">

⭐ If you found this project helpful, please consider giving it a star!

</div>
