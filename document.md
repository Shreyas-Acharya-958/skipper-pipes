Build a complete Laravel Admin Panel using the database structure from the provided table schema. The panel should include the following features:

🧑‍💼 Admin Template
Use a standard admin template (like AdminLTE, SB Admin, CoreUI).

Integrate with Laravel Blade views.

🔐 Authentication
Create a custom login system (no Laravel Breeze).

Secure all admin routes via middleware.

🧱 Database Tables & Models
Create migrations, models, controllers, and views for the following tables:

blogs

Fields: cat_id, title, page_image, image_1, image_2, slug, short_description, long_description, status, published_at, created_at, updated_at

products

Fields: title, slug, page_image, product_overview, product_overview_image, features_benefits, technical, application, faq, brochure, status, created_at, updated_at

blog_categories

Fields: id, title, status, created_at, updated_at

blog_comments

Fields: blog_id, name, email, description, status

company_pages

Fields: id, title, slug, short_description, long_description, status, is_active, created_at, updated_at

contacts

Fields: name, email, phone, subject, message, status, created_at, updated_at

📤 File Uploads
Support image/file uploads for:

Blogs (page_image, image_1, image_2)

Products (page_image, product_overview_image, brochure)

Store in storage/app/public and link via php artisan storage:link

⚙️ Admin Features (CRUD with AJAX)
Implement CRUD for all modules with:

Form validation

DataTable integration (AJAX)

Modal-based form submission or dynamic pages

Notifications for success/failure

Use jQuery AJAX for all data operations.

📂 Dynamic Menu Management
Add menu manager with parent-child nesting

Menus stored in a menus table

Render sidebar menus dynamically in admin template

✅ Deliverables
Laravel project with:

Migrations

Models

Resource Controllers

Views (Blade)

Custom Auth

jQuery-based AJAX

File Upload Handling

Admin template integration

Sidebar with dynamic menus

Preloaded seeders (optional) for testing data

Let me know if you want a starter Laravel repo or code snippets (migration/model/controller/view) for any of these modules.

Your Answer

Create a new Laravel project if you haven't already.

######### Answer

Authentication: Do you have any specific requirements for the custom login system?NO custom give just prifiex /admin

File Uploads: Are there any specific storage requirements or configurations for file uploads?NO
Dynamic Menus: Do you have a specific structure in mind for the menus, or should we follow a standard parent-child nesting?Yes
AJAX Library: Is jQuery acceptable for AJAX operations, or do you prefer another library?no use AJAX
