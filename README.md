# Fanatics Shop Test

This is a simple eCommerce web application built with Laravel. The application features product management, category browsing, shopping cart functionality, and a basic checkout process. It is containerized using Docker for easy setup and deployment.

## Features

- **Homepage**
  - Introductory text
  - Demo banner image
  - Slider showcasing the latest 10 products on promotion
- **User Authentication**
  - Login functionality
- **Category Browsing**
  - View products by category
  - Add products to the shopping cart
- **Shopping Cart and Checkout**
  - View cart contents
  - Adjust product quantities
  - Remove products from the cart
  - Basic checkout process that calculates the total and stores the order in the database

## Prerequisites

- **Docker** and **Docker Compose** installed on your machine

## Usage
- Run the database migrations

```bash
php artisan migrate
```
- Seed the database

```bash
php artisan db:seed
```

## Troubleshooting

If you encounter any issues with configuration, routes, or views, you can clear and rebuild the caches using the following commands:

```bash
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:clear
```

## Support

For any support or questions, please contact me at [pignatelli1994@gmail.com](mailto:pignatelli1994@gmail.com).

