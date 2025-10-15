# ReadCycle - Book Sharing Platform

A web-based book sharing platform designed for students in Bangladesh to promote sustainable reading practices and reduce the cost of buying books.

## Project Overview

ReadCycle is a university project developed by Mohammad Ibrahim as part of academic coursework. The platform allows students to share their books with each other, creating a community-driven approach to book access that benefits both the environment and students' budgets.

## Problem Statement

Students in Bangladesh often face financial constraints when purchasing academic and recreational books. This leads to:
- High costs for individual book purchases
- Limited access to diverse reading materials
- Environmental waste from unused books
- Lack of community engagement around reading

## Solution

ReadCycle provides a platform where students can:
- Share their books with other students
- Request books they need for their studies
- Build a community of book lovers
- Reduce individual book purchasing costs
- Promote sustainable consumption practices

## Features

### User Management
- Student registration with university information
- Secure authentication system
- Profile management with picture upload
- University and department-based user categorization

### Book Management
- Add books with cover images (file upload or URL)
- Organize books by categories
- Search and browse available books
- Edit and delete book listings
- View detailed book information

### Book Swapping System
- Request book swaps with other users
- Accept or decline swap requests
- Track swap status and history
- Manage ongoing book exchanges

### Categories
- Predefined book categories in Bengali
- Categories include: Novels, Science, History, Technology, Poetry, Religion, Stories, Drama, Travel, Biography, Philosophy, Education, Medicine, Agriculture
- Easy book organization and discovery

### Dashboard
- Personal dashboard with statistics
- View recent books and swap requests
- Quick access to all platform features
- Bengali language interface

## Technology Stack

### Backend
- **Laravel 12** - PHP web framework
- **PHP 8.2+** - Programming language
- **MySQL** - Database management system
- **Laravel Sanctum** - API authentication

### Frontend
- **HTML5 & CSS3** - Markup and styling
- **Bootstrap 5** - CSS framework
- **JavaScript** - Client-side functionality
- **Blade Templates** - Laravel templating engine

### Additional Tools
- **Composer** - PHP dependency management
- **Git** - Version control
- **Swagger UI** - API documentation

## Installation Guide

### Prerequisites
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/readcycle-laravel.git
   cd readcycle-laravel
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Create a MySQL database
   - Update database credentials in `.env` file:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=readcycle
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

5. **Run database migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed the database with sample data**
   ```bash
   php artisan db:seed
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   - Open your browser and go to `http://localhost:8000`
   - The application should be running successfully

## API Documentation

The project includes comprehensive API documentation accessible through Swagger UI:

- **Swagger UI**: `http://localhost:8000/swagger`
- **API Endpoints**: `http://localhost:8000/api/`
- **Project Documentation**: `http://localhost:8000/documentation`

### API Features
- RESTful API design
- Bearer token authentication
- File upload support
- Comprehensive error handling
- Input validation
- Pagination support

## Database Schema

### Users Table
- User registration information
- University and department details
- Profile picture support
- Authentication data

### Books Table
- Book information and metadata
- Category relationships
- Image storage (file or URL)
- User ownership

### Categories Table
- Book categorization system
- Bengali category names
- Book relationships

### Swaps Table
- Book swap request management
- Status tracking (pending, accepted, declined)
- User relationships

## Project Structure

```
readcycle-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/ (API Controllers)
│   │   ├── Auth/ (Authentication)
│   │   └── Dashboard/ (Web Interface)
│   ├── Models/ (Database Models)
│   ├── Policies/ (Authorization)
│   └── Services/ (Business Logic)
├── database/
│   ├── migrations/ (Database Schema)
│   └── seeders/ (Sample Data)
├── public/
│   ├── assets/ (CSS, JS, Images)
│   └── storage/ (Uploaded Files)
├── resources/
│   ├── views/ (Blade Templates)
│   └── lang/ (Language Files)
└── routes/
    ├── api.php (API Routes)
    └── web.php (Web Routes)
```

## Key Features Implementation

### Authentication System
- Custom web authentication (no Breeze due to PHP version constraints)
- Laravel Sanctum for API authentication
- Secure password hashing
- Session management

### File Upload System
- Support for both file uploads and external URLs
- Image validation and processing
- Secure file storage
- Automatic file cleanup

### Authorization
- Policy-based authorization system
- Users can only modify their own resources
- Swap request authorization
- Admin-level permissions

### Bengali Language Support
- Bengali font integration
- Bengali interface text
- Bengali book titles and categories
- Responsive design for Bengali text

## Sample Data

The project includes comprehensive sample data:
- 20+ sample users from different universities
- 14 book categories in Bengali
- 50+ sample books with cover images
- 15+ sample swap requests
- Realistic user profiles and book data

## Development Notes

### Challenges Faced
- PHP version compatibility issues with Laravel 12
- Custom authentication implementation
- Bengali font integration
- File upload handling for both local and external sources

### Solutions Implemented
- Manual migration creation
- Custom web authentication system
- Flexible image handling system
- Comprehensive error handling

## Future Enhancements

- Mobile application development
- Real-time notifications
- Book rating and review system
- Advanced search with filters
- Book recommendation system
- Integration with university libraries
- Payment system for premium features

## Contributing

This is a university project, but suggestions and improvements are welcome. Please feel free to:
- Report bugs or issues
- Suggest new features
- Improve documentation
- Enhance code quality

## Author

**Mohammad Ibrahim**
- University: North Western University, Khulna
- Department: Computer Science and Engineering
- Project: ReadCycle - Book Sharing Platform

## License

This project is developed for educational purposes as part of university coursework. The code is available for learning and reference purposes.

## Acknowledgments

- Laravel framework and community
- Bootstrap for frontend components
- Swagger UI for API documentation
- Bengali font providers
- University faculty and peers for guidance

## Contact

For questions about this project, please contact:
- Email: ibrahim@example.com
- University: North Western University, Khulna

---

*This project represents a comprehensive web application development effort, showcasing skills in Laravel framework, database design, API development, and user interface design.*