# Manual Tests

## Local Setup

1. Copy `app/config/config.example.php` to `app/config/config.local.php`.
2. Fill in local database values in `config.local.php`.
3. Never commit `config.local.php` or real credentials.
4. Import the approved `database/schema.sql` into the development database.
5. Start the application from the repository root:

   ```bash
   php -S localhost:8000 -t public
   ```

6. Open `http://localhost:8000` in a browser.

For the instructor-hosted database, `localhost` refers to the instructor's PHP server, not a developer laptop. MySQL Workbench requires the correct remote host and an allowlisted public IP.

## Authentication Tests

| ID | Test | Expected result |
| --- | --- | --- |
| AUTH-01 | Register with a valid email and password | A new account is created and the user receives a success response. |
| AUTH-02 | Register with an existing email | Registration is rejected without creating a duplicate user. |
| AUTH-03 | Register with an invalid email | Server-side validation rejects the request. |
| AUTH-04 | Register with a short password | Server-side validation rejects the request. |
| AUTH-05 | Inspect the database after registration | Only a password hash is stored; the plain-text password is absent. |
| AUTH-06 | Log in with valid credentials | A session is created and the user is redirected to the authenticated area. |
| AUTH-07 | Log in with an incorrect password | Login fails without revealing whether the email or password was wrong. |
| AUTH-08 | Access a protected page while logged out | The user is redirected to the login page. |
| AUTH-09 | Log out and revisit a protected page | The session is invalidated and access is denied. |
| AUTH-10 | Log in and inspect the session ID | The session ID changes after authentication. |
| AUTH-11 | Submit a mutation without a CSRF token | The request is rejected with a safe error response. |
| AUTH-12 | Submit a mutation with an invalid CSRF token | The request is rejected with a safe error response. |
| AUTH-13 | Disable a user and attempt login | Login is rejected for the inactive account. |

## Shared Core Smoke Tests

| ID | Test | Expected result |
| --- | --- | --- |
| CORE-01 | Start the app without `config.local.php` | The application fails clearly without exposing credentials. |
| CORE-02 | Connect with valid PDO settings | The application connects using exceptions, associative fetches, and native prepared statements. |
| CORE-03 | Submit text containing HTML characters | Rendered output is escaped and does not execute as HTML or JavaScript. |
| CORE-04 | Trigger a redirect helper | The browser receives an internal application redirect. |
| CORE-05 | Set and consume a flash message | The message appears once and is removed after it is consumed. |

## Security Checks

- [ ] No passwords or database credentials appear in source files, commits, logs, or screenshots.
- [ ] All user queries use PDO prepared statements.
- [ ] All state-changing requests require CSRF validation.
- [ ] All user-controlled output is escaped before rendering.
- [ ] Protected pages verify the current session on the server.
- [ ] Error responses do not expose stack traces, SQL, passwords, or connection details.
- [ ] Users cannot access another user's private data by changing an ID in the URL.

## Browser Debugging

- Use the **Console** tab to identify JavaScript errors.
- Use the **Network** tab to verify request methods, status codes, payloads, and responses.
- Use the **Application** tab to inspect session cookies without exposing their values in screenshots.
- Check the database after each mutation to confirm that the expected record changed.
