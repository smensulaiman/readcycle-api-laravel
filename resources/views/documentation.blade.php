<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadCycle - Project Documentation</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
            background-color: #ffffff;
            color: #000000;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }
        
        h2 {
            font-size: 22px;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        
        h3 {
            font-size: 18px;
            margin-top: 25px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        
        h4 {
            font-size: 16px;
            margin-top: 20px;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        p {
            text-align: justify;
            margin-bottom: 15px;
        }
        
        .code-block {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            overflow-x: auto;
        }
        
        .table-container {
            margin: 20px 0;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        
        .flowchart {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            border: 2px solid #000;
            background-color: #f9f9f9;
        }
        
        .flowchart-box {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            border: 2px solid #000;
            background-color: white;
            font-weight: bold;
        }
        
        .arrow {
            font-size: 20px;
            margin: 0 10px;
        }
        
        ul, ol {
            margin: 15px 0;
            padding-left: 30px;
        }
        
        li {
            margin-bottom: 8px;
        }
        
        .highlight {
            background-color: #ffffcc;
            padding: 2px 4px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .center {
            text-align: center;
        }
        
        .right {
            text-align: right;
        }
        
        .bold {
            font-weight: bold;
        }
        
        .italic {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ReadCycle - Book Sharing Platform</h1>
        <h2 class="center">Project Documentation</h2>
        
        <div class="right">
            <p><strong>Prepared by:</strong> Development Team<br>
            <strong>Date:</strong> {{ date('F d, Y') }}<br>
            <strong>Version:</strong> 1.0</p>
        </div>

        <h2>Table of Contents</h2>
        <ol>
            <li><a href="#introduction">Introduction</a></li>
            <li><a href="#objectives">Project Objectives</a></li>
            <li><a href="#technology">Technology Stack</a></li>
            <li><a href="#system-architecture">System Architecture</a></li>
            <li><a href="#database-design">Database Design</a></li>
            <li><a href="#user-flow">User Flow</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#api-endpoints">API Endpoints</a></li>
            <li><a href="#security">Security Features</a></li>
            <li><a href="#deployment">Deployment</a></li>
            <li><a href="#appendices">Appendices</a></li>
        </ol>

        <div class="page-break"></div>

        <h2 id="introduction">1. Introduction</h2>
        
        <p>ReadCycle is a web-based book sharing platform designed for students and book lovers in Bangladesh. The main idea is to help people share their books with each other instead of buying new books every time. This helps save money and also helps the environment by reducing waste.</p>
        
        <p>The platform allows users to:</p>
        <ul>
            <li>Add their books to the platform</li>
            <li>Search for books they want to read</li>
            <li>Request to swap books with other users</li>
            <li>Manage their book collection</li>
            <li>Connect with other book lovers</li>
        </ul>

        <h2 id="objectives">2. Project Objectives</h2>
        
        <h3>2.1 Main Objectives</h3>
        <ul>
            <li>Create a platform where students can share books easily</li>
            <li>Reduce the cost of buying books for students</li>
            <li>Promote reading culture in Bangladesh</li>
            <li>Help the environment by reducing paper waste</li>
        </ul>
        
        <h3>2.2 Technical Objectives</h3>
        <ul>
            <li>Build a secure and user-friendly web application</li>
            <li>Implement proper user authentication and authorization</li>
            <li>Create a responsive design that works on all devices</li>
            <li>Ensure data security and privacy</li>
        </ul>

        <h2 id="technology">3. Technology Stack</h2>
        
        <h3>3.1 Backend Technologies</h3>
        <ul>
            <li><strong>PHP 8.2+</strong> - Programming language</li>
            <li><strong>Laravel 12</strong> - Web framework</li>
            <li><strong>MySQL</strong> - Database management system</li>
            <li><strong>Laravel Sanctum</strong> - API authentication</li>
        </ul>
        
        <h3>3.2 Frontend Technologies</h3>
        <ul>
            <li><strong>HTML5</strong> - Markup language</li>
            <li><strong>CSS3</strong> - Styling</li>
            <li><strong>Bootstrap 5</strong> - CSS framework</li>
            <li><strong>JavaScript</strong> - Client-side scripting</li>
            <li><strong>Blade Templates</strong> - Laravel templating engine</li>
        </ul>
        
        <h3>3.3 Additional Tools</h3>
        <ul>
            <li><strong>Composer</strong> - PHP dependency manager</li>
            <li><strong>Git</strong> - Version control</li>
            <li><strong>Laravel Tinker</strong> - Command line tool</li>
        </ul>

        <div class="page-break"></div>

        <h2 id="system-architecture">4. System Architecture</h2>
        
        <h3>4.1 Overall Architecture</h3>
        <div class="flowchart">
            <div class="flowchart-box">User Interface<br>(Web Browser)</div>
            <span class="arrow">→</span>
            <div class="flowchart-box">Laravel Application<br>(PHP Framework)</div>
            <span class="arrow">→</span>
            <div class="flowchart-box">MySQL Database</div>
        </div>
        
        <h3>4.2 MVC Pattern</h3>
        <p>The application follows the Model-View-Controller (MVC) pattern:</p>
        <ul>
            <li><strong>Model:</strong> Handles data and business logic (User, Book, Category, Swap)</li>
            <li><strong>View:</strong> Handles user interface (Blade templates)</li>
            <li><strong>Controller:</strong> Handles user requests and responses</li>
        </ul>

        <h2 id="database-design">5. Database Design</h2>
        
        <h3>5.1 Entity Relationship Diagram</h3>
        <div class="flowchart">
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                <div class="flowchart-box">Users<br>1</div>
                <span class="arrow">1:N</span>
                <div class="flowchart-box">Books<br>N</div>
                <span class="arrow">N:1</span>
                <div class="flowchart-box">Categories<br>1</div>
            </div>
            <br><br>
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                <div class="flowchart-box">Books<br>1</div>
                <span class="arrow">1:N</span>
                <div class="flowchart-box">Swaps<br>N</div>
                <span class="arrow">N:1</span>
                <div class="flowchart-box">Users<br>1</div>
            </div>
        </div>
        
        <h3>5.2 Database Tables</h3>
        
        <h4>5.2.1 Users Table</h4>
        <div class="table-container">
            <table>
                <tr>
                    <th>Column Name</th>
                    <th>Data Type</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td>id</td>
                    <td>BIGINT</td>
                    <td>Primary key, auto increment</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>VARCHAR(255)</td>
                    <td>User's full name</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>VARCHAR(255)</td>
                    <td>User's email address (unique)</td>
                </tr>
                <tr>
                    <td>university_name</td>
                    <td>VARCHAR(255)</td>
                    <td>Name of university</td>
                </tr>
                <tr>
                    <td>department</td>
                    <td>VARCHAR(255)</td>
                    <td>Department/Subject</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>VARCHAR(50)</td>
                    <td>Academic year (1st, 2nd, 3rd, 4th)</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>VARCHAR(255)</td>
                    <td>Hashed password</td>
                </tr>
                <tr>
                    <td>profile_picture</td>
                    <td>VARCHAR(255)</td>
                    <td>Path to profile picture</td>
                </tr>
                <tr>
                    <td>created_at</td>
                    <td>TIMESTAMP</td>
                    <td>Account creation time</td>
                </tr>
                <tr>
                    <td>updated_at</td>
                    <td>TIMESTAMP</td>
                    <td>Last update time</td>
                </tr>
            </table>
        </div>
        
        <h4>5.2.2 Categories Table</h4>
        <div class="table-container">
            <table>
                <tr>
                    <th>Column Name</th>
                    <th>Data Type</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td>id</td>
                    <td>BIGINT</td>
                    <td>Primary key, auto increment</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>VARCHAR(255)</td>
                    <td>Category name (unique)</td>
                </tr>
                <tr>
                    <td>created_at</td>
                    <td>TIMESTAMP</td>
                    <td>Creation time</td>
                </tr>
                <tr>
                    <td>updated_at</td>
                    <td>TIMESTAMP</td>
                    <td>Last update time</td>
                </tr>
            </table>
        </div>
        
        <h4>5.2.3 Books Table</h4>
        <div class="table-container">
            <table>
                <tr>
                    <th>Column Name</th>
                    <th>Data Type</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td>id</td>
                    <td>BIGINT</td>
                    <td>Primary key, auto increment</td>
                </tr>
                <tr>
                    <td>user_id</td>
                    <td>BIGINT</td>
                    <td>Foreign key to users table</td>
                </tr>
                <tr>
                    <td>category_id</td>
                    <td>BIGINT</td>
                    <td>Foreign key to categories table</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>VARCHAR(255)</td>
                    <td>Book title</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>TEXT</td>
                    <td>Book description</td>
                </tr>
                <tr>
                    <td>photo_path</td>
                    <td>VARCHAR(255)</td>
                    <td>Path to book cover image</td>
                </tr>
                <tr>
                    <td>created_at</td>
                    <td>TIMESTAMP</td>
                    <td>Creation time</td>
                </tr>
                <tr>
                    <td>updated_at</td>
                    <td>TIMESTAMP</td>
                    <td>Last update time</td>
                </tr>
            </table>
        </div>
        
        <h4>5.2.4 Swaps Table</h4>
        <div class="table-container">
            <table>
                <tr>
                    <th>Column Name</th>
                    <th>Data Type</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td>id</td>
                    <td>BIGINT</td>
                    <td>Primary key, auto increment</td>
                </tr>
                <tr>
                    <td>book_requested_id</td>
                    <td>BIGINT</td>
                    <td>Foreign key to books table (book being requested)</td>
                </tr>
                <tr>
                    <td>book_offered_id</td>
                    <td>BIGINT</td>
                    <td>Foreign key to books table (book being offered)</td>
                </tr>
                <tr>
                    <td>requester_id</td>
                    <td>BIGINT</td>
                    <td>Foreign key to users table (person making request)</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>ENUM</td>
                    <td>pending, accepted, declined</td>
                </tr>
                <tr>
                    <td>created_at</td>
                    <td>TIMESTAMP</td>
                    <td>Request creation time</td>
                </tr>
                <tr>
                    <td>updated_at</td>
                    <td>TIMESTAMP</td>
                    <td>Last update time</td>
                </tr>
            </table>
        </div>

        <div class="page-break"></div>

        <h2 id="user-flow">6. User Flow</h2>
        
        <h3>6.1 Registration and Login Flow</h3>
        <div class="flowchart">
            <div class="flowchart-box">User visits website</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Choose: Register or Login</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Fill registration form<br>(Name, Email, University, etc.)</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Account created successfully</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Redirect to Dashboard</div>
        </div>
        
        <h3>6.2 Book Sharing Flow</h3>
        <div class="flowchart">
            <div class="flowchart-box">User logs in</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Go to "My Books" section</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Click "Add New Book"</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Fill book details<br>(Title, Category, Description, Image)</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Book added to platform</div>
        </div>
        
        <h3>6.3 Book Swap Flow</h3>
        <div class="flowchart">
            <div class="flowchart-box">User finds a book they want</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Click "Request Swap"</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Select a book to offer in exchange</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Send swap request</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Book owner receives notification</div>
            <span class="arrow">↓</span>
            <div class="flowchart-box">Owner can Accept or Decline</div>
        </div>

        <h2 id="features">7. Features</h2>
        
        <h3>7.1 User Management</h3>
        <ul>
            <li>User registration with university information</li>
            <li>Secure login and logout</li>
            <li>Profile management with picture upload</li>
            <li>Password change functionality</li>
        </ul>
        
        <h3>7.2 Book Management</h3>
        <ul>
            <li>Add books with cover images</li>
            <li>Edit book information</li>
            <li>Delete books from collection</li>
            <li>View all books in the platform</li>
            <li>Search books by title or category</li>
        </ul>
        
        <h3>7.3 Category Management</h3>
        <ul>
            <li>Predefined categories (Novels, Science, History, etc.)</li>
            <li>Admin can add new categories</li>
            <li>Books organized by categories</li>
        </ul>
        
        <h3>7.4 Swap System</h3>
        <ul>
            <li>Request book swaps with other users</li>
            <li>Accept or decline swap requests</li>
            <li>Track swap status (pending, accepted, declined)</li>
            <li>View swap history</li>
        </ul>
        
        <h3>7.5 Dashboard</h3>
        <ul>
            <li>Overview of user's books and swaps</li>
            <li>Statistics (total books, swaps sent/received)</li>
            <li>Recent activity feed</li>
            <li>Quick access to all features</li>
        </ul>

        <div class="page-break"></div>

        <h2 id="api-endpoints">8. API Endpoints</h2>
        
        <h3>8.1 Authentication Endpoints</h3>
        <div class="code-block">
POST /api/register - Register new user
POST /api/login - User login
POST /api/logout - User logout (requires authentication)
        </div>
        
        <h3>8.2 User Endpoints</h3>
        <div class="code-block">
GET /api/users - Get all users (requires authentication)
GET /api/users/{id} - Get specific user
PUT /api/users/{id} - Update user profile
DELETE /api/users/{id} - Delete user account
        </div>
        
        <h3>8.3 Book Endpoints</h3>
        <div class="code-block">
GET /api/books - Get all books (public)
GET /api/books/{id} - Get specific book (public)
POST /api/books - Add new book (requires authentication)
PUT /api/books/{id} - Update book (requires authentication)
DELETE /api/books/{id} - Delete book (requires authentication)
        </div>
        
        <h3>8.4 Category Endpoints</h3>
        <div class="code-block">
GET /api/categories - Get all categories (public)
GET /api/categories/{id} - Get specific category (public)
POST /api/categories - Add new category (requires authentication)
PUT /api/categories/{id} - Update category (requires authentication)
DELETE /api/categories/{id} - Delete category (requires authentication)
        </div>
        
        <h3>8.5 Swap Endpoints</h3>
        <div class="code-block">
GET /api/swaps - Get user's swaps (requires authentication)
POST /api/swaps - Create new swap request (requires authentication)
GET /api/swaps/{id} - Get specific swap details
PUT /api/swaps/{id} - Update swap request
DELETE /api/swaps/{id} - Cancel swap request
POST /api/swaps/update-status - Update swap status
        </div>

        <h2 id="security">9. Security Features</h2>
        
        <h3>9.1 Authentication</h3>
        <ul>
            <li>Laravel Sanctum for API token authentication</li>
            <li>Password hashing using bcrypt</li>
            <li>Session management for web interface</li>
        </ul>
        
        <h3>9.2 Authorization</h3>
        <ul>
            <li>Users can only edit/delete their own books</li>
            <li>Users can only manage their own profile</li>
            <li>Swap requests can only be managed by involved parties</li>
            <li>API endpoints protected with authentication middleware</li>
        </ul>
        
        <h3>9.3 Data Validation</h3>
        <ul>
            <li>Input validation on all forms</li>
            <li>File upload validation (type, size)</li>
            <li>SQL injection prevention through Eloquent ORM</li>
            <li>XSS protection through Blade templating</li>
        </ul>

        <h2 id="deployment">10. Deployment</h2>
        
        <h3>10.1 System Requirements</h3>
        <ul>
            <li>PHP 8.2 or higher</li>
            <li>MySQL 5.7 or higher</li>
            <li>Composer for dependency management</li>
            <li>Web server (Apache/Nginx)</li>
        </ul>
        
        <h3>10.2 Installation Steps</h3>
        <ol>
            <li>Clone the repository from Git</li>
            <li>Install PHP dependencies using Composer</li>
            <li>Copy .env.example to .env and configure database</li>
            <li>Generate application key</li>
            <li>Run database migrations</li>
            <li>Seed the database with sample data</li>
            <li>Configure web server to point to public directory</li>
        </ol>

        <div class="page-break"></div>

        <h2 id="appendices">11. Appendices</h2>
        
        <h3>Appendix A: Color Scheme</h3>
        <p>The application uses a green color scheme representing nature and sustainability:</p>
        <ul>
            <li><strong>Primary Color:</strong> #0a6d3a (Forest Green)</li>
            <li><strong>Secondary Color:</strong> #35875b (Light Green)</li>
            <li><strong>Light Color:</strong> #F0F6FF (Light Blue-White)</li>
            <li><strong>Dark Color:</strong> #262B47 (Dark Navy)</li>
        </ul>
        
        <h3>Appendix B: File Structure</h3>
        <div class="code-block">
readcycle-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/ (API Controllers)
│   │   ├── Auth/ (Authentication Controllers)
│   │   └── Dashboard/ (Dashboard Controllers)
│   ├── Models/ (Database Models)
│   ├── Policies/ (Authorization Policies)
│   └── Services/ (Business Logic Services)
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
        </div>
        
        <h3>Appendix C: Database Seeder Data</h3>
        <p>The application includes sample data for testing:</p>
        <ul>
            <li><strong>Users:</strong> 20+ sample users with different universities</li>
            <li><strong>Categories:</strong> 14 book categories in Bengali</li>
            <li><strong>Books:</strong> 50+ sample books with cover images</li>
            <li><strong>Swaps:</strong> 15+ sample swap requests</li>
        </ul>
        
        <h3>Appendix D: Bengali Language Support</h3>
        <p>The application supports Bengali language:</p>
        <ul>
            <li>All user interface text in Bengali</li>
            <li>Bengali font (Bangla.ttf) integrated</li>
            <li>Book titles and categories in Bengali</li>
            <li>Responsive design for Bengali text</li>
        </ul>
        
        <h3>Appendix E: Future Enhancements</h3>
        <p>Planned features for future versions:</p>
        <ul>
            <li>Mobile application (Android/iOS)</li>
            <li>Real-time notifications</li>
            <li>Book rating and review system</li>
            <li>Advanced search with filters</li>
            <li>Book recommendation system</li>
            <li>Integration with university libraries</li>
        </ul>
        
        <div class="center" style="margin-top: 50px;">
            <p><strong>End of Documentation</strong></p>
            <p><em>This document provides a complete overview of the ReadCycle project, including technical specifications, database design, and implementation details.</em></p>
        </div>
    </div>
</body>
</html>
