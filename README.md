# RentGrid — Equipment Rental Marketplace

RentGrid is a web application designed to simplify equipment rentals by bringing different categories of rental products into one centralized marketplace. It aims to help customers discover equipment, compare rental prices, check date-based availability, and make reservations, while helping rental businesses manage inventory and bookings.

**Project Status:** 🚧 Under Development

## Problem Statement

Rental services are often fragmented across category-specific platforms, making it difficult for customers to compare prices and check equipment availability in one place. RentGrid aims to address this problem by providing a unified marketplace for discovering and renting equipment.

## Key Features

### Implemented
- Equipment marketplace homepage
- Equipment listings with rental prices
- Equipment details pages
- Database integration for retrieving equipment information
- Equipment search by name, category, and description

### Planned
- Date-based equipment availability
- Reservation and cancellation management
- Inventory tracking for individual equipment units
- Double-booking prevention
- Rental business management dashboard
- Multi-channel inventory synchronization
- Booking and inventory analytics

## Technology Stack

- **Backend:** PHP, Laravel
- **Frontend:** HTML, CSS, JavaScript, Blade
- **Database:** MySQL
- **Development Tools:** Visual Studio Code, Composer, Git, GitHub

## How It Works

1. Customers browse available equipment through the marketplace.
2. They view equipment details and compare rental prices.
3. They select rental dates and request reservations as booking functionality is developed.
4. Rental businesses will be able to manage equipment inventory and bookings through a centralized system.

## Technical Challenges

A major engineering goal is preventing double bookings when multiple customers request the same equipment for overlapping dates.

The planned reservation engine will use database transactions, row-level locking, and date-overlap validation to ensure reliable inventory allocation.

## Future Enhancements

- REST API integrations and webhook-based updates
- Multi-channel inventory synchronization
- Failed synchronization monitoring and retry mechanisms
- Role-based access control and secure API authentication
- Automated testing and deployment

## Local Setup

### Prerequisites
- PHP and Composer
- MySQL
- Node.js and npm, if frontend dependencies require them

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/VeerendraSD/rentgrid.git
   cd rentgrid
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Create your environment file:

   ```bash
   cp .env.example .env
   ```

   On Windows PowerShell, use:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Create a MySQL database named `rentgrid` and configure the database credentials in `.env`.

6. Run database migrations:

   ```bash
   php artisan migrate
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```

8. Open the local URL displayed in your terminal, usually `http://127.0.0.1:8000`.

If frontend dependencies are required, run `npm install` and `npm run dev` in a separate terminal.

## Project Goals

RentGrid aims to simplify equipment rentals for customers and rental businesses while exploring reliable inventory management, reservation processing, and multi-channel availability synchronization.

This project is being developed as a hands-on learning experience in full-stack web development, database design, business workflow analysis, and problem-solving.

## Author

**Veerendra S. D.**

GitHub: [VeerendraSD](https://github.com/VeerendraSD)

---

*RentGrid is an ongoing project. Features listed under Planned or Future Enhancements are not yet represented as completed functionality.*