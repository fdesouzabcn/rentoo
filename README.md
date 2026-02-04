# 🏠 Rentoo

Rentoo is a **property rental management system** developed with **PHP/Laravel-Blade/Tailwind CSS**, designed specifically for the Spanish rental market.

The project enables property owners to manage their rental properties and contracts, with full compliance to Spanish legal requirements including LAU (Ley de Arrendamientos Urbanos) and Catalunya-specific regulations.


## Project Description

**Rentoo** allows property owners to register, manage their rental properties, and create legally compliant rental contracts with complete tenant information.

The system tracks:
- Property owners with DNI/NIE/TIE validation
- Rental properties with cadastral references and energy certificates
- Rental contracts with dual tenant support and IRPA compliance

The project has been developed as an **academic project** for the Barcelona Activa Fullstack PHP bootcamp, with emphasis on:
- MVC architecture
- Database relational design
- Spanish legal compliance (LAU, IRPA, energy certificates)
- Professional Git workflow with GitFlow

## Technologies and Tools Used

- **PHP 8.5.0**
- **Laravel 12**
- **MariaDB 10.4.32** (via XAMPP)
- **Blade Templates**
- **Tailwind CSS**
- **Vite**
- **Thunder Client** (API testing)
- **Git & GitFlow** (version control)


## Features

### Property Owner Management
- Complete CRUD operations for property owners
- DNI/NIE/TIE validation with Spanish regex patterns
- Contact information management
- View all properties owned by each owner

### Property Management
- Complete CRUD operations for rental properties
- Owner assignment with dynamic information display
- Cadastral reference validation (20-character format)
- Energy certificate tracking (A-G rating scale)
- Built area and rooms specification
- Financial information management


### Contract Management
- Complete CRUD operations for rental contracts
- Property selection with automatic owner information display
- Dual tenant support (Tenant 1 and Tenant 2)
- DNI/NIE validation for all tenants
- Contract dates with validation
- Financial information management
- IRPA zone classification (tensioned/non-tensioned areas)
- Contract status
- Browser-based contract printing (PDF generation coming in Level 3)


## Application Flow

1. Owner registers in the system with validated DNI/NIE
2. Owner adds rental properties with legal requirements
3. Owner creates a new contract in DRAFT status
4. Owner selects property
5. Owner adds tenant information with validated DNI/NIE/TIE
6. Owner completes contract details
7. Owner finalizes the contract
8. Owner can print contracts directly from browser


## Database Design

The database follows a **relational design** with three main entities:

- **owners** → Property owners (UUID primary key)
  - Personal information (name, surnames)
  - DNI/NIE with Spanish validation
  - Contact information (phone, email)
  
- **properties** → Rental properties (UUID primary key)
  - Address details (street, number, floor, door, postal code, city, province)
  - Cadastral reference (20 characters)
  - Energy certificate (A-G rating)
  - Built area and room count
  - IRPA zone classification
  - Belongs to one owner (foreign key with cascade delete protection)
  
- **contracts** → Rental contracts (UUID primary key)
  - Belongs to one property (foreign key with cascade delete protection)
  - Dual tenant information (Tenant 1 & Tenant 2)
  - Contract dates (start and end)
  - Financial information (monthly rent, deposit)
  - Status enum (DRAFT or FINALIZED)

### Key Relationships
- **owners → properties** (1:many) - One owner can have multiple properties
- **properties → contracts** (1:many) - One property can have multiple contracts over time
- Cascade delete protection ensures data integrity


## Project Structure

* **app/**
    * **Http/**
        * **Controllers/**
            * `OwnerController.php`
            * `PropertyController.php`
            * `ContractController.php`
    * **Models/**
        * `Owner.php`
        * `Property.php`
        * `Contract.php`
* **database/**
    * **factories/**
        * `ContractFactory.php`
        * `OwnerFactory.php`
        * `PropertyFactory.php`
    * **migrations/**
        * `2026_01_22_131239_create_owners_table.php`
        * `2026_01_22_134841_create_properties_table.php`
        * `2026_01_22_185023_create_contracts_table.php`
    * **seeders/**
        * `DatabaseSeeder.php`
* **public/**
    * `index.php`
* **resources/**
    * **views/**
        * **owners/**
            * `index.blade.php`
            * `show.blade.php`
            * `create.blade.php`
            * `edit.blade.php`
        * **properties/**
            * `index.blade.php`
            * `show.blade.php`
            * `create.blade.php`
            * `edit.blade.php`
        * **contracts/**
            * `index.blade.php`
            * `show.blade.php`
            * `create.blade.php`
            * `edit.blade.php`
        * **layouts/**
            * `app.blade.php`
        * **components/**
        * `welcome.blade.php`
* **routes/**
    * `web.php`
    * `api.php`
* **storage/**


## Installation

### Prerequisites
- PHP 8.5.0 or higher
- Composer 2.8.12 or higher
- Node.js v22.19.0 and NPM 10.9.3
- MariaDB 10.4.32 or higher (or MySQL)
- Git

### Installation Steps

**1. Clone the repository**
```bash
git clone https://github.com/fdesouzabcn/rentoo.git
cd rentoo
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install Frontend dependencies**
```bash
npm install
```

**4. Create environment file**
```bash
cp .env.example .env
```

**5. Configure database**
Edit `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rentoo
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**6. Generate application key**
```bash
php artisan key:generate
```

**7. Run migrations**
```bash
php artisan migrate
```

**8. Enable frontend assets**
```bash
npm run dev
```

**9. Start Laravel development server**
```bash
php artisan serve
```

**10. Access the application**
Open your browser and navigate to:
```
http://127.0.0.1:8000
```

## Author

**Flavio de Souza**  
Repository: [https://github.com/fdesouzabcn/rentoo](https://github.com/fdesouzabcn/rentoo)

## Acknowledgments

- Barcelona Activa Fullstack PHP Bootcamp  (2025/2026)
