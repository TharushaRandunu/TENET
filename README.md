# Hotel Management System

This project is a  hotel management system developed using HTML, CSS, and PHP. It provides features for both customers and staff such as food ordering, service requesting, staff login/registration, housekeeping/maintenance requests, check-in, check-out, and more.

---

## File Structure Overview

### User Authentication
- `register.html` – Customer registration form.
- `register.php` – Handles customer registration data.
- `login.html` – Customer login form.
- `login.php` – Validates customer login.
- `register-staff.php` – Staff registration backend (e.g., housekeeping, maintenance, front office).
- `login-staff.php` – Staff login backend.

###  Front Office Functions
- `frontoffice-home.php` – Dashboard for front office staff.
- `checkin.php` – Handles guest check-in.
- `checkout.php` – Handles guest check-out.
- `register-foreign-user.php` – (To be created) Registration for foreign guests.

### Food Orders
- `menu.php` – Display available menu items.
- `orderMenu.php` – Order form for customers.
- `order-item.php` – Handles food item ordering.
- `update-food-orders.php` – Update food order status.
- `view-room-orders.php` – View food orders by room.

###  Service Requests
- `request-service.html` – Service request form.
- `request-service.php` – Handles service requests.
- `view_service_requests.php` – Displays service requests for logged-in users.
- `view-checkins.php` – Displays checked-in users.

###  Staff Dashboards
- `housekeeping_requests.php` – View housekeeping service requests.
- `maintenance_requests.php` – View maintenance requests.

###  Shared Pages
- `homePage.php` – Home page after customer login.
- `view-items.php` – Displays food menu.
- `stylesMenu.css`, `style.css`, `styles2.css`, `stylesService.css` – CSS styling files.

---

##  Features
- Customer registration and login
- Staff registration/login (housekeeping, maintenance, front office)
- Food ordering and viewing room orders
- Service requests (housekeeping and maintenance)
- Staff-specific views for requests
- Front office check-in/checkout
- Foreign guest registration (to be added)

---

##  Future Enhancements
- Add foreign user registration (`register-foreign-user.php`)
- Improve UI/UX using Bootstrap or modern CSS frameworks
- Add database backup/download/export feature

---

## Setup Instructions
1. Place the project folder in your server directory (e.g., `htdocs` for XAMPP).
2. Make sure your MySQL database is configured correctly.
3. Start Apache and MySQL from XAMPP.
4. Open browser and navigate to `http://localhost/your-folder-name/login.html`.

---

##  Author
Developed by: **[Tharusha Randunu Silva]**  
Location: Sri Lanka  
