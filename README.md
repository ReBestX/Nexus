# Nexus Social

*A modern, feature-rich social media platform built with PHP, MySQL, and Tailwind CSS*

[![PHP](https://img.shields.io/badge/PHP-%5E7.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.3.2-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-ISC-blue.svg)](https://opensource.org/licenses/ISC)

## 🎥 Project Preview

Check out the project preview video to get a visual overview:

[Watch the Project Preview Video](https://youtu.be/sy2gPF2ULxY)

---

## 🌟 Features

### Design & UX
- **Modern UI/UX** - Clean, intuitive interface with smooth animations powered by ScrollReveal.js
- **Responsive Design** - Fully responsive layout that adapts seamlessly across all devices and screen sizes
- **Skeleton Loaders** - Enhanced loading experience with animated skeleton screens
- **Interactive Alerts** - Engaging user feedback with SweetAlert2 integration
- **Custom Styling** - Tailored design with Tailwind CSS and custom CSS modules

### Authentication & Security
- **Secure Authentication** - Robust login and registration system with encrypted password storage
- **Password Recovery** - Hassle-free account recovery via email verification
- **Session Management** - Secure session handling and user state management
- **Authorization Controls** - Role-based access control for admin and user functionalities

### Content Management
- **Full CRUD Operations** - Create, Read, Update, and Delete operations for posts and profiles
- **Draft Posts** - Compose, edit, and save posts as drafts before publishing
- **Post Categories** - Organize content with categorization system
- **Search Functionality** - Find posts and users with integrated search
- **Comment System** - Engage with posts through threaded comments

### User Experience
- **User Profiles** - Personalized profile pages with customizable information and avatars
- **Profile Editing** - Update profile information, change passwords, and manage account settings
- **Image Uploads** - Support for user avatars and post images
- **Admin Dashboard** - Comprehensive admin panel for platform management

---

## 📱 Sections

- **Home** - Main feed with post listings and navigation
- **Sign In / Sign Up** - User authentication pages with form validation
- **User Profile** - Personal profile pages with posts and draft management
- **Create Post** - Rich post creation interface with category selection
- **Post Details** - Individual post view with comments and interactions
- **Edit Profile** - Profile customization and account settings
- **Categories** - Browse posts by category
- **Search** - Global search functionality
- **About** - Platform information
- **Services** - Service offerings
- **Support** - User support and help center
- **404 Page** - Custom error page for not found resources

---

## 🚀 Tech Stack

| Category | Technology |
|----------|-----------|
| **Backend** | PHP 7.4+ |
| **Database** | MySQL |
| **Frontend** | HTML5, CSS3, JavaScript (ES6+) |
| **Styling** | Tailwind CSS 3.3.2, Material Tailwind HTML |
| **CSS Framework** | Custom CSS modules (Argon Dashboard) |
| **JavaScript Libraries** | jQuery 3.7.0 |
| **Animations** | ScrollReveal.js |
| **Alerts** | SweetAlert2 |
| **Email** | PHPMailer 6.8 |
| **Icons** | Font Awesome, Nucleo Icons |
| **Fonts** | Google Fonts (Inter, Satoshi), Font Share |
| **Package Manager** | npm, Composer |
| **Version Control** | Git |

---

## 📦 Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 7.4
- **MySQL** >= 5.7 or MariaDB >= 10.2
- **Composer** (for PHP dependencies)
- **Node.js** >= 14.x and npm (for Tailwind CSS)
- **Web Server** (Apache/Nginx) with mod_rewrite enabled

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
   - Create a new MySQL database
   - Import the database schema from `Nexus database/nexus.sql`
   ```bash
   mysql -u your_username -p your_database_name < "Nexus database/nexus.sql"
   ```

5. **Configure database connection**
   - Update the database credentials in `includes/db.php`:
   ```php
   <?php
   $db_host = "localhost";
   $db_user = "your_username";
   $db_pass = "your_password";
   $db_name = "your_database_name";
   ?>
   ```

6. **Configure PHPMailer** (for password recovery emails)
   - Update email settings in the appropriate files with your SMTP credentials

7. **Build Tailwind CSS**
   ```bash
   npm run dev
   ```

8. **Start your web server**
   - Point your web server document root to the `dist` directory
   - Or use PHP's built-in server for development:
   ```bash
   php -S localhost:8000 -t dist
   ```

9. **Access the application**
   - Open your browser and navigate to `http://localhost:8000` (or your configured domain)

---

## 🎯 Available Scripts

| Command | Description |
|---------|-------------|
| `npm run dev` | Watch mode - Builds Tailwind CSS and watches for changes |
| `composer install` | Installs PHP dependencies (PHPMailer) |
| `npm install` | Installs Node.js dependencies |

---

## 📁 Project Structure

```
Nexus/
├── dist/                       # Main application directory (web root)
│   ├── index.php              # Home page with post listings
│   ├── sign-in.php            # User login page
│   ├── sign-up.php            # User registration page
│   ├── Profile.php            # User profile page
│   ├── create-post.php        # Post creation interface
│   ├── post.php               # Individual post view
│   ├── EditProfile.php        # Profile editing page
│   ├── EditPassword.php       # Password change page
│   ├── Forget_Password.php    # Password recovery page
│   ├── SetNewPassword.php     # New password setup
│   ├── ProfileDraftPosts.php  # Draft posts management
│   ├── EditDraftPost.php      # Draft post editing
│   ├── category.php           # Category view
│   ├── search.php             # Search results page
│   ├── about.php              # About page
│   ├── Service.php            # Services page
│   ├── Support.php            # Support page
│   ├── 404page.php            # Custom 404 error page
│   ├── output.css             # Compiled Tailwind CSS
│   └── .htaccess              # Apache URL rewriting rules
├── includes/                   # PHP backend logic
│   ├── db.php                 # Database connection
│   ├── login.php              # Login processing
│   ├── Register.php           # Registration processing
│   ├── logout.php             # Logout handler
│   ├── userPostAdd.php        # Post creation logic
│   ├── UpdatePostStatus.php   # Post status updates
│   ├── UpdateDraftPost.php    # Draft post updates
│   ├── updateProfile.php      # Profile update logic
│   ├── updatePassword.php     # Password change logic
│   ├── ResetPassword.php      # Password reset logic
│   ├── NewPassword.php        # New password handler
│   ├── commentpost.php        # Comment handling
│   └── update_check_value.php # Status update helper
├── js/                        # JavaScript files
│   ├── jquery-3.7.0.min.js   # jQuery library
│   ├── index.js              # Home page scripts
│   ├── post.js               # Post interaction scripts
│   ├── login.js              # Login page scripts
│   ├── signup.js             # Registration scripts
│   ├── others.js             # Utility functions
│   └── perfect-scrollbar.min.js
├── src/                       # Source CSS files
│   ├── input.css             # Tailwind input file
│   ├── NexusHome.css         # Home page styles
│   ├── profile.css           # Profile page styles
│   ├── post.css              # Post page styles
│   ├── editprofile.css       # Edit profile styles
│   ├── Draftposts.css        # Draft posts styles
│   ├── others.css            # Utility styles
│   ├── argon-dashboard-tailwind.css
│   ├── nucleo-icons.css      # Icon fonts
│   └── all.min.css           # Font Awesome
├── images/                    # Static images and assets
│   ├── NexusLogo.png         # Platform logo
│   └── [various images]
├── webfonts/                  # Font files
├── Nexus database/            # Database files
│   ├── nexus.sql             # Database schema
│   └── nexus.json            # Database export (JSON)
├── Nexus CMS/                 # CMS module (separate instance)
├── vendor/                    # Composer dependencies
├── node_modules/              # npm dependencies
├── package.json               # npm configuration
├── composer.json              # Composer configuration
├── tailwind.config.js         # Tailwind CSS configuration
├── .htaccess                  # Main Apache configuration
└── README.md                  # This file
```

---

## 🎨 Customization

### Theme & Colors

1. **Tailwind Configuration**
   - Modify `tailwind.config.js` to customize colors, spacing, and breakpoints
   - Update `src/input.css` for custom Tailwind directives

2. **Custom Styles**
   - Edit CSS files in the `src/` directory for specific page styling
   - Main styles: `NexusHome.css`, `profile.css`, `post.css`

3. **Rebuild CSS**
   ```bash
   npm run dev
   ```

### Content Editing

1. **Logo & Branding**
   - Replace logo images in the `images/` directory
   - Update logo references in PHP files

2. **Static Pages**
   - Edit `about.php`, `Service.php`, and `Support.php` for content changes

3. **Database Content**
   - Access MySQL database directly to modify posts, categories, and user data

### Assets Replacement

- **Images**: Place new images in the `images/` directory
- **Fonts**: Update font references in CSS files and `webfonts/` directory
- **Icons**: Font Awesome and Nucleo icons are included

---

## 🚢 Deployment

### Apache/Nginx Server

1. **Upload Files**
   - Upload all files to your web server
   - Set the document root to the `dist/` directory

2. **Configure Database**
   - Import the SQL file to your production database
   - Update `includes/db.php` with production credentials

3. **Set Permissions**
   ```bash
   chmod 755 dist/
   chmod 644 dist/*.php
   chmod 755 includes/
   ```

4. **Configure URL Rewriting**
   - Ensure `.htaccess` is enabled for clean URLs
   - For Nginx, configure equivalent rewrite rules

### Shared Hosting

1. Upload files via FTP/SFTP
2. Import database through phpMyAdmin or cPanel
3. Update database credentials
4. Ensure PHP version compatibility (PHP 7.4+)

### Environment Considerations

- **PHP Extensions**: Ensure `mysqli`, `pdo_mysql`, and `openssl` are enabled
- **File Uploads**: Configure `php.ini` for appropriate upload limits
- **Email**: Configure SMTP settings for PHPMailer functionality
- **Security**: Use HTTPS in production
- **Sessions**: Ensure proper session configuration in `php.ini`

---

## 🔧 Environment Variables

While this project primarily uses `includes/db.php` for configuration, here are the key settings to configure:

| Variable | Description | Required |
|----------|-------------|----------|
| `$db_host` | MySQL database host | Yes |
| `$db_user` | Database username | Yes |
| `$db_pass` | Database password | Yes |
| `$db_name` | Database name | Yes |
| SMTP Host | Email server host (in PHPMailer config) | Yes (for email features) |
| SMTP Port | Email server port | Yes (for email features) |
| SMTP Username | Email account username | Yes (for email features) |
| SMTP Password | Email account password | Yes (for email features) |

**Note**: For enhanced security, consider moving sensitive credentials to environment variables or a separate configuration file outside the web root.

---

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. **Fork the repository**
   ```bash
   git clone https://github.com/ReBestX/Nexus.git
   ```

2. **Create a feature branch**
   ```bash
   git checkout -b feature/AmazingFeature
   ```

3. **Make your changes**
   - Follow existing code style and conventions
   - Test your changes thoroughly

4. **Commit your changes**
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```

5. **Push to the branch**
   ```bash
   git push origin feature/AmazingFeature
   ```

6. **Open a Pull Request**
   - Describe your changes clearly
   - Reference any related issues

### Development Guidelines

- Maintain consistent code formatting
- Comment complex logic
- Test all database operations
- Ensure responsive design compatibility
- Follow security best practices

---

## 📝 License

This project is licensed under the **ISC License**.

---

## 👨‍💻 Author

**ReBestX**

- GitHub: [@ReBestX](https://github.com/ReBestX)
- Repository: [Nexus](https://github.com/ReBestX/Nexus)

---

## 🙏 Acknowledgments

- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Font Awesome](https://fontawesome.com/) - Icon library
- [SweetAlert2](https://sweetalert2.github.io/) - Beautiful alert dialogs
- [ScrollReveal](https://scrollrevealjs.org/) - Scroll animations library
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - Email sending library
- [jQuery](https://jquery.com/) - JavaScript library
- [Material Tailwind](https://www.material-tailwind.com/) - Tailwind components

---

<div align="center">

**⭐ Star this repository if you find it helpful!**

Made with ❤️ by ReBestX

</div>
