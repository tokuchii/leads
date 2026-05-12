# Leads Agri

A modern Laravel-based web application for Leads Agri, featuring lead generation, career applications, AI-powered chat support, product information, and news management.

## About

Leads Agri is a comprehensive web platform built with Laravel and Vue.js that serves as the digital presence for an agricultural company. The application includes:

- **Lead Generation**: Contact forms and inquiry management
- **Career Portal**: Job application submissions and management
- **AI Chat Support**: Intelligent chatbot for customer inquiries
- **Product Information**: Agricultural product catalog and details
- **News Management**: Dynamic news articles with social media integration
- **Responsive Design**: Mobile-first approach with modern UI/UX

## Features

- **Inquiry Management**: Handle customer inquiries and leads
- **Career Applications**: Process job applications with resume uploads
- **AI-Powered Chat**: Automated customer support with fallback options
- **Product Catalog**: Information about agricultural products (insecticides, herbicides, fungicides, fertilizers, molluscicides)
- **News Articles**: SEO-optimized articles with Open Graph meta tags
- **Responsive Frontend**: Vue.js SPA with Tailwind CSS styling
- **RESTful API**: Clean API endpoints for all functionalities

## Tech Stack

### Backend
- **Laravel 12**: PHP web framework
- **PHP 8.2+**: Server-side scripting
- **MySQL/SQLite**: Database storage
- **Composer**: PHP dependency management

### Frontend
- **Vue.js 3**: Progressive JavaScript framework
- **Vite**: Fast build tool and development server
- **Tailwind CSS 4**: Utility-first CSS framework
- **Axios**: HTTP client for API requests
- **Vue Router**: Single-page application routing

### Additional Libraries
- **SweetAlert2**: Beautiful modal dialogs
- **SimpleBar**: Custom scrollbars
- **Ionicons**: Icon library
- **Font Awesome**: Additional icon set

## Installation

### Prerequisites

Before you begin, ensure you have the following installed:
- **PHP 8.2 or higher**
- **Composer** (PHP dependency manager)
- **Node.js 18+ and npm**
- **MySQL** or **SQLite** database
- **Git** (optional, for cloning)

### Step-by-Step Installation

1. **Clone the repository** (if applicable):
   ```bash
   git clone <repository-url>
   cd leads
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Environment Configuration**:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and other settings.

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Build Frontend Assets**:
   ```bash
   npm run build
   ```
   Or for development:
   ```bash
   npm run dev
   ```

8. **Start the Development Server**:
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

### Alternative: Using Laravel Sail (Docker)

If you prefer Docker, Laravel Sail is configured:

1. Install dependencies:
   ```bash
   composer install
   npm install
   ```

2. Start Sail:
   ```bash
   ./vendor/bin/sail up
   ```

3. Run migrations:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

## Development

### Available Commands

- **Start development server**: `composer run dev`
- **Run tests**: `composer run test`
- **Code formatting**: `vendor/bin/pint`
- **Build assets**: `npm run build`
- **Watch assets**: `npm run dev`


## Testing

Run the test suite:

```bash
php artisan test
```

Or with coverage:

```bash
php artisan test --coverage
```

## Deployment

1. Set up your production environment (PHP 8.2+, web server)
2. Configure environment variables in `.env`
3. Run database migrations
4. Build production assets: `npm run build`
5. Set proper file permissions
6. Configure web server (Apache/Nginx) to serve `public/` directory

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and ensure code quality
5. Submit a pull request

## Support

For support or questions, please contact the development team.
