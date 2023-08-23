# Appointment System

The Appointment System is a web application built using Laravel and connected to MySQL, designed to streamline the appointment scheduling process between trainers (teachers) and students. Users can register as either students or trainers. Trainers can set their availability in the office, and the system will automatically generate available time slots. Students can then request appointments during these time slots. The trainer has the option to accept or reject student requests. The system includes comprehensive validation to ensure a smooth user experience.

## Key Features
- **User Roles**: Users can register as students or trainers, allowing for distinct experiences based on their role.
- **Trainer Availability**: Trainers can specify their availability time slots, indicating when they are open for appointments.
- **Automated Time Slot Generation**: The system generates available time slots based on the trainer's specified availability.
- **Appointment Requests**: Students can request appointments during available time slots.
- **Accept/Reject Mechanism**: Trainers can accept or reject appointment requests from students.
- **Comprehensive Validation**: The system includes validation checks to ensure accurate and reliable data entry.

## Installation
1. Clone this repository to your local machine:
git clone https://github.com/aliyoussef11/appointment-system.git

2. Navigate to the project directory:
cd appointment-system

3. Install the required dependencies using Composer:
composer install

4. Create a copy of the `.env.example` file and name it `.env`. Update the database connection details in the `.env` file.
5. Generate a new application key:
php artisan key:generate

6. Run the database migrations and seed the initial data:
php artisan migrate --seed

7. Start the development server:
php artisan serve

8. Access the application by visiting `http://localhost:8000` in your web browser.

## Usage
1. Register as a student or a trainer using the respective registration forms.
2. **Trainer**: After registration, log in and navigate to the availability settings. Specify your available time slots.
3. The system will automatically generate available time slots based on your specified availability.
4. **Student**: Log in as a student and view the available time slots of trainers.
5. Request an appointment during an available time slot.
6. The trainer will receive a notification and can choose to accept or reject the appointment request.

## Technologies Used
- Laravel: The web application framework used to build the system.
- MySQL: The relational database management system for storing data.
- Blade Templating Engine: Laravel's built-in templating engine for creating dynamic views.

## License
This project is licensed under the [MIT License](LICENSE).
