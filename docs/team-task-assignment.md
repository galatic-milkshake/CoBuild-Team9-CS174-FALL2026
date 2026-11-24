# CoBuild Team Task Assignment

## General Rules

- Each member must work on a separate branch and must not commit directly to `main`.
- Use this branch naming format: `feature/<member-name>-<module>`.
- Every task must include a clear commit, basic testing, and a Pull Request for team review.
- Do not change the database schema, shared interfaces, or another member's module without discussing it with the team first.
- Each member owns the frontend, PHP processing, and database queries for their assigned module.

## Assigned Branches

| Member | Proposed main branch |
| --- | --- |
| Samuel | `feature/samuel-auth-integration` |
| Lin | `feature/lin-profile-layout` |
| Thet Noe | `feature/thet-noe-connections-messaging` |
| Zack | `feature/zack-discovery-saved` |

## Detailed Responsibilities

### 1. Samuel — Authentication, Shared Infrastructure, and Integration

**Branch:** `feature/samuel-auth-integration`

- Create and maintain the project skeleton, bootstrap process, and example configuration.
- Build registration, login, logout, and session protection.
- Build shared utilities: PDO connection, CSRF protection, escaping, redirects, flash messages, and basic validation.
- Coordinate the database contract with the team; own the `users` table and sample user seed data.
- Integrate all modules into the dashboard and test the complete workflow:
  `register → login → profile → discover → request → message`.
- Update local setup instructions and help prepare deployment after the team approves it.

**Deliverables:** authentication pages/actions, core utilities, dashboard integration, setup documentation, and the main workflow test checklist.

### 2. Lin — User Profiles and Shared Layout

**Branch:** `feature/lin-profile-layout`

- Build the profile view and profile edit pages.
- Handle profile fields: background, skills, interests, mission, vision, collaboration type, availability, time commitment, location, and working preferences.
- Write repositories and queries for profiles, skills, and interests.
- Implement contact-information visibility rules based on user permissions.
- Build the shared layout: header, navbar, footer, flash messages, and responsive CSS.
- Provide sample profile data for the team to test discovery and connections.

**Deliverables:** `profile.php`, `edit-profile.php`, profile repository, shared partials, related CSS, and tests for profile viewing/editing permissions.

### 3. Thet Noe — Connections and Messaging

**Branch:** `feature/thet-noe-connections-messaging`

- Build sending, accepting, declining, and canceling connection requests.
- Validate legal status transitions and prevent duplicate requests, including requests in the opposite direction.
- Build the connections page for incoming, outgoing, and accepted connections.
- Build conversations and message sending for connected users only.
- Protect conversation/message access by checking participant membership; validate input and CSRF tokens for POST actions.
- Add Fetch polling as a separate task after basic messaging is stable.
- Write manual tests for the request lifecycle, unauthorized access, and message permissions.

**Deliverables:** connection repository/service, connection actions, `connections.php`, `conversation.php`, `send-message.php`, messages API, and access-control tests.

### 4. Zack — Discovery, Compatibility, and Saved Profiles

**Branch:** `feature/zack-discovery-saved`

- Build the discovery page and filters for skills, interests, collaboration type, campus/city, and time commitment.
- Write profile search repositories and queries using prepared statements.
- Build a compatibility service that explains two-way matches: offered/desired skills, interests, collaboration type, and working conditions.
- Do not display a misleading overall “compatibility score”; display specific reasons to connect instead.
- Build save/unsave profile functionality and the saved profiles page.
- Add JavaScript/Fetch interactions for filters where needed while keeping server-side validation.
- Write manual tests for filters, empty results, SQL injection inputs, and save/unsave permissions.

**Deliverables:** `discover.php`, `saved.php`, discovery repository, compatibility service, saved-profile repository, related JavaScript, and discovery tests.

## Shared Workload Requirements

Every member must complete all of the following for their assigned module:

1. Implement both frontend and backend functionality.
2. Write or update the related database queries.
3. Test valid input, invalid input, and unauthorized access.
4. Update the related documentation or manual tests.
5. Open a Pull Request, review the diff, and address feedback.
6. Review at least one other member's Pull Request.

Each member is also responsible for the dashboard section related to their module. Samuel will connect the sections and run the final end-to-end check, but integration work should not become one person's entire workload.

## Branch Workflow

```bash
git switch main
git pull origin main
git switch -c feature/<member-name>-<module>

# work, test, and commit
git add <changed-files>
git commit -m "feat: <short-description>"
git push -u origin feature/<member-name>-<module>
```

When opening a Pull Request:

- Describe the changed files and how the work was tested.
- Assign at least one other team member as a reviewer.
- Merge only after feedback is addressed and conflicts with `main` are checked.
- Delete the remote branch after it has been merged if it is no longer needed. Create a new branch from the latest `main` for every new task.

## Recommended Collaboration Order

1. The team agrees on the database schema and table names before writing SQL.
2. Samuel completes the minimum core/auth layer for the other modules to use.
3. Lin completes the profile contract; Zack uses it for discovery.
4. Thet Noe completes the connection contract and then integrates messaging.
5. Zack and Thet Noe coordinate so the connection button in discovery creates the correct request.
6. Samuel integrates the dashboard, runs the full manual test flow, and summarizes issues before the demo.

## Pre-Merge Checklist

- [ ] The branch was created from the latest `main`.
- [ ] No passwords, credentials, or `config.local.php` are included in the commit.
- [ ] User data uses PDO prepared statements.
- [ ] Mutating actions have CSRF protection.
- [ ] Server-side validation and output escaping are implemented.
- [ ] The happy path, invalid data, and unauthorized access were tested.
- [ ] The Pull Request includes a description, relevant evidence/screenshots, and at least one reviewer.
