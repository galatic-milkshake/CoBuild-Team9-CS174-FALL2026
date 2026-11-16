# CoBuild-Team9-CS174-FALL2026
CoBuild Platform

## Project Structure

```text
cobuild/
├── README.md                         # Project overview and local setup instructions
├── .gitignore                        # Excludes credentials and temporary files from Git
│
├── app/                              # Internal application code
│   ├── bootstrap.php                 # Initializes sessions and loads shared dependencies
│   ├── config/
│   │   ├── config.example.php        # Configuration template with placeholder values
│   │   └── config.local.php          # Private environment configuration; excluded from Git
│   ├── core/
│   │   ├── database.php              # Creates the MySQL connection using PDO
│   │   ├── auth.php                  # Checks login status and identifies the current user
│   │   ├── csrf.php                  # Generates and validates CSRF tokens
│   │   ├── validation.php            # Validates submitted data on the server
│   │   └── helpers.php               # Shared escaping, redirect, and notification helpers
│   ├── repositories/
│   │   ├── user_repository.php       # Database queries for user accounts
│   │   ├── profile_repository.php    # Database queries for profiles, skills, and interests
│   │   ├── discovery_repository.php  # Searches and filters user profiles
│   │   ├── saved_profile_repository.php # Database queries for saved profiles
│   │   ├── connection_repository.php # Database queries for connection requests
│   │   └── message_repository.php    # Database queries for conversations and messages
│   ├── services/
│   │   ├── compatibility_service.php # Generates explanations of complementary strengths
│   │   └── connection_service.php    # Validates connection permissions and status changes
│   └── views/
│       └── partials/
│           ├── header.php            # Shared HTML head and opening page layout
│           ├── navbar.php            # Shared navigation menu
│           ├── footer.php            # Shared footer and script imports
│           └── flash.php             # Displays success and error notifications
│
├── public/                           # Web-accessible pages, handlers, and static assets
│   ├── index.php                     # Landing page
│   ├── register.php                  # Registration form
│   ├── login.php                     # Login form
│   ├── dashboard.php                 # Overview of saved profiles, requests, and conversations
│   ├── discover.php                  # Profile discovery page with filters
│   ├── profile.php                   # Displays a user's profile
│   ├── edit-profile.php              # Form for editing the current user's profile
│   ├── saved.php                     # Displays saved profiles
│   ├── connections.php               # Displays incoming, outgoing, and accepted connections
│   ├── conversation.php              # Displays a conversation and message form
│   ├── actions/
│   │   ├── register.php              # Handles account registration
│   │   ├── login.php                 # Handles authentication
│   │   ├── logout.php                # Ends the current session
│   │   ├── save-profile.php          # Saves changes to the current user's profile
│   │   ├── toggle-saved.php          # Saves or removes a bookmarked profile
│   │   ├── send-request.php          # Sends a personalized connection request
│   │   ├── respond-request.php       # Accepts, declines, or cancels a connection request
│   │   └── send-message.php          # Sends a message within an authorized conversation
│   ├── api/
│   │   └── messages.php              # Returns conversation messages as JSON for polling
│   └── assets/
│       ├── css/
│       │   └── style.css             # Shared styles and responsive layout adjustments
│       ├── js/
│       │   ├── discovery.js          # Supports interactive discovery filters
│       │   └── messages.js           # Periodically retrieves new conversation messages
│       └── images/
│           └── .gitkeep              # Keeps the empty images directory tracked in Git
│
├── database/
│   ├── schema.sql                    # Defines tables, relationships, and constraints
│   └── seed.sql                      # Sample data for development and demonstrations
│
└── docs/
    ├── development-plan.md           # Feature order, milestones, and review checkpoints
    ├── database-design.md            # Table definitions and relationship documentation
    ├── deployment.md                 # Server configuration and deployment instructions
    └── manual-tests.md               # Manual checks for features and access permissions
```

> This structure is the planned project skeleton. Features will be implemented incrementally.
> `app/config/config.local.php` contains private credentials and must never be committed to Git.