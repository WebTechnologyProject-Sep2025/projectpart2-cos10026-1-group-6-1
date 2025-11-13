<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project Enhancements">
  <meta name="keywords" content="enhancements, features, technical improvements">
  <meta name="author" content="Pham Duc Minh Quan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Enhancements</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
  <?php 
  $pageTitle = "Project Enhancements Documentation";
  include 'nav.inc'; 
  include 'header.inc.php';
  ?>

  <main class="main_container">
    <section class="enhancements-intro">
      <p>This page documents the additional features and security enhancements implemented beyond the basic requirements for our COS10026 Web Technology project.</p>
    </section>

    <section class="enhancement-list">
      <!-- Enhancement 1: Account Lockout System -->
      <article class="enhancement-item">
        <h2>1. Account Lockout System After Multiple Failed Login Attempts</h2>
        <div class="enhancement-details">
          <p><strong>Status:  IMPLEMENTED</strong></p>
          <p><strong>Description:</strong> Implemented a security feature that locks user accounts after 3 consecutive failed login attempts to prevent brute-force attacks.</p>
          <p><strong>Technical Implementation:</strong></p>
          <ul>
            <li>Added a 'failed_attempt' column in the hr_users table to track unsuccessful login attempts</li>
            <li>Modified login_process.php to increment the failed_attempt counter on each failed login</li>
            <li>When failed_attempt reaches 3, the account is locked and user cannot login even with correct credentials</li>
            <li>System displays remaining attempts to the user</li>
            <li>Failed attempts counter resets to 0 on successful login</li>
          </ul>
          <p><strong>Code Files Modified:</strong></p>
          <ul>
            <li><code>login_process.php</code> - Main logic for handling login attempts and lockouts</li>
            <li><code>login.php</code> - Displays error messages and remaining attempts</li>
            <li><code>project2_db.sql</code> - Added failed_attempt column to hr_users table</li>
            <li><code>hr_users</code> table structure updated</li>
          </ul>
          <p><strong>Security Benefit:</strong> Prevents automated password guessing attacks and enhances overall system security.</p>
        </div>
      </article>

      <!-- Enhancement 2: Authentication System -->
      <article class="enhancement-item">
        <h2>2. Control Access to manage.php with Username and Password Authentication</h2>
        <div class="enhancement-details">
          <p><strong>Status:  IMPLEMENTED</strong></p>
          <p><strong>Description:</strong> Implemented a secure authentication system that restricts access to the management interface (manage.php) to authorized HR personnel only.</p>
          <p><strong>Technical Implementation:</strong></p>
          <ul>
            <li>Created dedicated login system with login.php and login_process.php</li>
            <li>Used PHP sessions to maintain user authentication state</li>
            <li>Implemented secure password hashing using password_hash() function</li>
            <li>Created hr_users table with secure credential storage</li>
            <li>manage.php checks for valid session before displaying sensitive data</li>
            <li>Automatic redirect to login page if user is not authenticated</li>
          </ul>
          <p><strong>Code Files Modified:</strong></p>
          <ul>
            <li><code>login.php</code> - User authentication interface</li>
            <li><code>login_process.php</code> - Credential verification logic</li>
            <li><code>manage.php</code> - Session validation and access control</li>
            <li><code>config.php</code> - Database configuration for authentication</li>
            <li><code>hash_generator.php</code> - Utility for creating password hashes</li>
          </ul>
          <p><strong>Security Features:</strong> Session management, password hashing, secure redirects.</p>
        </div>
      </article>

      <!-- Enhancement 3: EOI Record Sorting -->
      <article class="enhancement-item">
        <h2>3. Sort EOI Records by Different Fields</h2>
        <div class="enhancement-details">
          <p><strong>Status: ARTIALLY IMPLEMENTED</strong></p>
          <p><strong>Description:</strong> Enhanced the EOI management interface to allow sorting of records by different fields (EOI number, name, date, etc.).</p>
          <p><strong>Current Implementation:</strong></p>
          <ul>
            <li>Basic EOI record display in manage.php</li>
            <li>Table structure ready for sorting functionality</li>
            <li>Search functionality implemented for EOI records</li>
          </ul>
          <p><strong>Planned Enhancement:</strong></p>
          <ul>
            <li>Add clickable column headers for sorting</li>
            <li>Implement ASC/DESC toggle functionality</li>
            <li>Add visual indicators for current sort order</li>
          </ul>
          <p><strong>Files Involved:</strong></p>
          <ul>
            <li><code>manage.php</code> - Main management interface</li>
            <li><code>search_result.php</code> - Search functionality</li>
          </ul>
        </div>
      </article>

      <!-- Enhancement 4: Manager Registration -->
      <article class="enhancement-item">
        <h2>4. Manager Registration System</h2>
        <div class="enhancement-details">
          <p><strong>Status: PLANNED</strong></p>
          <p><strong>Description:</strong> Create a manager registration page with server-side validation for unique usernames and secure password rules.</p>
          <p><strong>Planned Features:</strong></p>
          <ul>
            <li>Registration form with client and server-side validation</li>
            <li>Unique username enforcement</li>
            <li>Password strength requirements (min length, special characters)</li>
            <li>Email verification system</li>
            <li>Admin approval workflow for new manager accounts</li>
          </ul>
          <p><strong>Technical Requirements:</strong></p>
          <ul>
            <li>New registration.php page</li>
            <li>Enhanced hr_users table with additional fields</li>
            <li>Email sending capability for verification</li>
            <li>Admin approval interface</li>
          </ul>
        </div>
      </article>

      <!-- Additional Implemented Enhancements -->
      <article class="enhancement-item">
        <h2>Additional Security & Functionality Enhancements</h2>
        <div class="enhancement-details">
          <p><strong> Input Validation & Sanitization</strong></p>
          <ul>
            <li>Server-side validation in process_eoi.php for all form inputs</li>
            <li>HTML special characters escaping to prevent XSS attacks</li>
            <li>SQL injection prevention using proper database escaping</li>
            <li>File upload restrictions and validation</li>
          </ul>

          <p><strong>Session Management & Logout</strong></p>
          <ul>
            <li>Secure session handling across all authenticated pages</li>
            <li>Proper logout functionality that destroys sessions</li>
            <li>Session timeout considerations</li>
          </ul>

          <p><strong> Database Security</strong></p>
          <ul>
            <li>Separate database configuration files</li>
            <li>Secure password hashing using PHP password_hash()</li>
            <li>Prepared statements for database queries</li>
            <li>Proper error handling without exposing sensitive information</li>
          </ul>
        </div>
      </article>
    </section>

    <section class="technical-specs">
      <h2>Technical Implementation Summary</h2>
      <table class="specs-table">
        <thead>
          <tr>
            <th>Enhancement</th>
            <th>Status</th>
            <th>Files Modified</th>
            <th>Security Level</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Account Lockout System</td>
            <td> Implemented</td>
            <td>login_process.php, login.php, SQL schema</td>
            <td>High</td>
          </tr>
          <tr>
            <td>Authentication System</td>
            <td> Implemented</td>
            <td>login.php, manage.php, config.php</td>
            <td>High</td>
          </tr>
          <tr>
            <td>EOI Record Sorting</td>
            <td>Partial</td>
            <td>manage.php</td>
            <td>Medium</td>
          </tr>
          <tr>
            <td>Manager Registration</td>
            <td>Planned</td>
            <td>N/A</td>
            <td>Medium</td>
          </tr>
          <tr>
            <td>Input Validation</td>
            <td> Implemented</td>
            <td>process_eoi.php, apply.php</td>
            <td>High</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section class="implementation-notes">
      <h2>Implementation Notes</h2>
      <div class="notes-grid">
        <div class="note-item">
          <h3>Security Best Practices</h3>
          <ul>
            <li>All passwords are hashed using PHP's password_hash() function</li>
            <li>Session management prevents unauthorized access</li>
            <li>Input validation prevents SQL injection and XSS attacks</li>
            <li>Error messages don't reveal sensitive system information</li>
          </ul>
        </div>
        <div class="note-item">
          <h3>Database Schema</h3>
          <ul>
            <li>hr_users table includes failed_attempt tracking</li>
            <li>Secure password storage with hashing</li>
            <li>Proper indexing for performance</li>
            <li>Foreign key relationships where applicable</li>
          </ul>
        </div>
        <div class="note-item">
          <h3>User Experience</h3>
          <ul>
            <li>Clear error messages for login attempts</li>
            <li>Responsive design for mobile devices</li>
            <li>Intuitive navigation and interface</li>
            <li>Accessibility considerations</li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <?php include 'footer.inc'; ?>
</body>
</html>
