# Database Design

## Users

The `users` table stores only authentication and account-status data. Profile information such as skills, interests, mission, and location belongs in separate profile tables.

| Column | Type | Rules | Purpose |
| --- | --- | --- | --- |
| `id` | `INT UNSIGNED` | Primary key, auto-increment | Identifies the user |
| `email` | `VARCHAR(255)` | Required, unique | Login identifier |
| `password_hash` | `VARCHAR(255)` | Required | Stores a PHP password hash, never a plain-text password |
| `is_active` | `TINYINT(1)` | Required, default `1` | Enables or disables the account |
| `last_login_at` | `DATETIME` | Nullable | Stores the last successful login time |
| `created_at` | `TIMESTAMP` | Required, current timestamp | Account creation time |
| `updated_at` | `TIMESTAMP` | Required, automatically updated | Last account record update |

### Authentication Rules

- Use `password_hash()` when creating a user password.
- Use `password_verify()` during login.
- Never store or display a plain-text password.
- Use prepared statements for all user queries.
- Treat email uniqueness as a database constraint and also validate it before inserting.
- Create profile records separately and reference `users.id` with a foreign key.
