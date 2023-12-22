# Gym Management System

Welcome to the Gym Management System! This system is designed to help gym administrators manage member information, gym equipment, and payment details efficiently. The system is built using HTML for the frontend, PHP for the backend, and utilizes XAMPP for the database.

## Features

1. **Member Login:**
   - Members can registered for the gym.

2. **Admin Dashboard:**
   - Admins have a dedicated dashboard to oversee the entire gym management system.

3. **Member Management:**
   - Admins can view, add, edit, and delete member profiles.
   - Member profiles include personal details, contact information, and membership status.

4. **Equipment Management:**
   - Admins can manage gym equipment, including adding, editing, and deleting items.
   - Each equipment entry contains details such as name, quantity, and maintenance status.

5. **Payment Management:**
   - Admins can monitor and manage members' payment details.
   - Track payment history, due dates, and update payment status.

## Getting Started

### Prerequisites

- XAMPP: Ensure XAMPP is installed on your server or local machine.
- Web Browser: Use a modern web browser for testing.

### Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/yourusername/gym-management-system.git
   ```

2. Move the project folder to the `htdocs` directory in your XAMPP installation.

3. Start the Apache and MySQL services in XAMPP.

4. Import the database:
   - Open `phpmyadmin` in your browser (`http://localhost/phpmyadmin`).
   - Create a new database named `gym_management_system`.
   - Import the SQL file provided: `gym_management_system.sql`.

5. Configure the database connection:
   - Open `config/config.php` and update the database connection details.

6. Open the Gym Management System in your browser:
   - Navigate to `http://localhost/gym-management-system`.

## Usage

1. **Admin Login:**
   - Admins can log in using the admin credentials.

2. **Admin Dashboard:**
   - Once logged in, admins can access the dashboard to manage members, equipment, and payments.
