# Role Management Deployment Guide

## Quick Deployment Commands

After pulling the code, run these commands in order:

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Seed Roles
```bash
php artisan db:seed --class=RoleSeeder
```

### Step 3: Assign Roles to Existing Users (IMPORTANT)
```bash
php artisan db:seed --class=AssignRolesToExistingUsersSeeder
```

---

## Complete Command Sequence

```bash
php artisan migrate
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=AssignRolesToExistingUsersSeeder
```

---

## What These Commands Do

1. **migrate**: Creates `roles` table and adds `role_id` column to `users` table
2. **RoleSeeder**: Creates 3 roles (Admin, Lead Management, Content Management)
3. **AssignRolesToExistingUsersSeeder**: Assigns Admin role to all existing users without a role

---

## Verification

After running the commands, verify roles are assigned:

```sql
SELECT u.id, u.name, u.email, r.name as role_name 
FROM users u 
LEFT JOIN roles r ON u.role_id = r.id;
```

All users should have a role assigned.

---

## Notes

- **Safe for Production**: `AssignRolesToExistingUsersSeeder` only updates users without roles
- **No Data Loss**: Existing users keep all their data, just get assigned Admin role
- **Default Role**: All existing users will be assigned Admin role automatically
