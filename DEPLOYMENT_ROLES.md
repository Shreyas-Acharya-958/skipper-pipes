# Role Management Deployment Guide

## Overview

This application uses a role-based access control system with three roles:
- **Admin**: Full access to all modules
- **Lead Management**: Access to Dashboard module (inquiries management)
- **Content Management**: Access to Blog Module and Product Module

All routes are under `/admin/*` and menu visibility is controlled by user role.

---

## Production Deployment Steps

### Step 1: Run Migrations
```bash
php artisan migrate
```
This will:
- Create the `roles` table
- Add `role_id` column to `users` table

### Step 2: Seed Roles
```bash
php artisan db:seed --class=RoleSeeder
```
This creates the three roles:
- Admin (slug: `admin`)
- Lead Management (slug: `lead-management`)
- Content Management (slug: `content-management`)

### Step 3: Assign Roles to Existing Users (IMPORTANT)
```bash
php artisan db:seed --class=AssignRolesToExistingUsersSeeder
```
This safely assigns the Admin role to all existing users who don't have a role assigned.
**This is safe to run in production** - it only updates users without roles.

### Step 4: (Optional) Create Test Users
Only run this in development/staging:
```bash
php artisan db:seed --class=AdminUserSeeder
```
This creates test users. **DO NOT run this in production** if you don't want these test users.

---

## Development/Staging Deployment

For fresh installations or development environments, you can run all seeders:

```bash
php artisan migrate
php artisan db:seed
```

This will:
1. Create roles
2. Create test admin users (if they don't exist)
3. Assign admin role to any users without roles
4. Seed other data (banners, blogs, etc.)

---

## Route Structure

All routes are under `/admin/*`:

- **Dashboard**: `/admin/dashboard` (accessible by all authenticated users)
- **Blog Module**: `/admin/blogs`, `/admin/blog-categories` (admin, content-management)
- **Product Module**: `/admin/products`, `/admin/product-categories` (admin, content-management)
- **Other Modules**: `/admin/*` (admin only)

### Access Control

Routes are protected using middleware:
- `auth`: All routes require authentication
- `role:admin`: Admin-only routes
- `role:admin,content-management`: Routes accessible by Admin and Content Management

---

## Menu Visibility

Menu visibility is controlled by user role in the layout file (`resources/views/admin/layouts/app.blade.php`):

### Admin Role
- Dashboard
- Blog Module
- Resources Module
- Product Module
- Content Module
- Settings

### Content Management Role
- Dashboard
- Blog Module
- Product Module

### Lead Management Role
- Dashboard

---

## Role Assignment

### Default Behavior
- All existing users are automatically assigned the **Admin** role
- New users should be assigned a role when created

### Manual Role Assignment

You can assign roles to users via database:

```sql
-- Assign Admin role (ID: 1)
UPDATE users SET role_id = 1 WHERE email = 'user@example.com';

-- Assign Lead Management role (ID: 2)
UPDATE users SET role_id = 2 WHERE email = 'user@example.com';

-- Assign Content Management role (ID: 3)
UPDATE users SET role_id = 3 WHERE email = 'user@example.com';
```

### Role IDs
- Admin: `1`
- Lead Management: `2`
- Content Management: `3`

---

## Verifying Deployment

After running the seeders, verify:

### 1. Check roles exist:
```sql
SELECT * FROM roles;
```

Expected output:
- ID: 1, Name: Admin, Slug: admin
- ID: 2, Name: Lead Management, Slug: lead-management
- ID: 3, Name: Content Management, Slug: content-management

### 2. Check users have roles:
```sql
SELECT u.id, u.name, u.email, r.name as role_name 
FROM users u 
LEFT JOIN roles r ON u.role_id = r.id;
```

All users should have a role assigned.

### 3. Test Login:
- Login with any user credentials
- All users should redirect to `/admin/dashboard`
- Menu visibility should match their role:
  - **Admin**: See all menus
  - **Content Management**: See Dashboard, Blog Module, Product Module
  - **Lead Management**: See Dashboard only

### 4. Test Access Control:
- **Content Management** user trying to access `/admin/users` → Should get 403 error
- **Lead Management** user trying to access `/admin/blogs` → Should get 403 error
- **Admin** user → Can access all routes

---

## Important Notes

1. **AdminUserSeeder is production-safe**: It only creates users if they don't exist, and won't overwrite existing users.

2. **AssignRolesToExistingUsersSeeder**: This is the key seeder for production. It assigns the Admin role to all existing users without a role.

3. **User Access**: After deployment, all existing users will have Admin role by default. You can manually change their roles in the database if needed.

4. **New Users**: When creating new users, make sure to assign them a `role_id`:
   - Admin role ID: 1
   - Lead Management role ID: 2
   - Content Management role ID: 3

5. **Single Route Structure**: All routes are under `/admin/*`. Menu visibility is controlled by role, not by separate route groups.

6. **Middleware**: Access control is handled by `RoleMiddleware` which supports comma-separated roles (e.g., `role:admin,content-management`).

---

## Troubleshooting

### Users can't login
- Check if users have a role assigned: `SELECT * FROM users WHERE role_id IS NULL;`
- Run `AssignRolesToExistingUsersSeeder` to assign roles

### Users see wrong menus
- Clear browser cache
- Check user role: `SELECT u.email, r.slug FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = 'user@example.com';`
- Verify layout file is using role-based conditions

### 403 Unauthorized errors
- Check if route middleware is correct
- Verify user has the required role
- Check `RoleMiddleware` is registered in `bootstrap/app.php`

### Routes not working
- Run `php artisan route:clear`
- Run `php artisan config:clear`
- Verify routes are under `/admin/*` prefix

---

## File Structure

Key files for role management:

- **Migrations**:
  - `database/migrations/2025_12_04_125141_create_roles_table.php`
  - `database/migrations/2025_12_04_125144_add_role_id_to_users_table.php`

- **Models**:
  - `app/Models/Role.php`
  - `app/Models/User.php` (updated with role relationship)

- **Middleware**:
  - `app/Http/Middleware/RoleMiddleware.php`

- **Seeders**:
  - `database/seeders/RoleSeeder.php`
  - `database/seeders/AssignRolesToExistingUsersSeeder.php`
  - `database/seeders/AdminUserSeeder.php` (development only)

- **Controllers**:
  - `app/Http/Controllers/AuthController.php` (updated for role-based redirect)
  - `app/Http/Controllers/DashboardController.php` (role-based dashboard content)

- **Views**:
  - `resources/views/admin/layouts/app.blade.php` (role-based menu visibility)

- **Routes**:
  - `routes/web.php` (all routes under `/admin/*` with role middleware)

---

## Support

If you encounter any issues during deployment, check:
1. All migrations have run successfully
2. Roles are seeded correctly
3. Users have roles assigned
4. Middleware is registered in `bootstrap/app.php`
5. Routes are properly configured

For questions or issues, refer to the code comments in the respective files.

