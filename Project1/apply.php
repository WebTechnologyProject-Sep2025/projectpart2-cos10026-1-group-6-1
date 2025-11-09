<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Job application form">
  <meta name="keywords" content="job, application, form">
  <title>Job Application Form</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
  <?php $pageTitle= "Application" ?>
 <?php include 'nav.inc'; include 'header.inc.php';?>
  <main class="main_container">
    <div class="form_container">
      <form class="application_form" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php">
        <div id="logo_apply">
          <img src="images/logo_dataflow.png" alt="dataflow_logo">
        </div>
        <fieldset class="form_wrapper">
          <h2 class="form-title">Job Application Form</h2>
          <!-- Job reference number selection -->
          <label for="job-reference">Select your Job reference number:</label>
          <select name="job-reference" id="job-reference" required="required">
            <option value="">Job reference number </option>
            <option value="CLD01">CLD01 (Cloud Engineer)</option>
            <option value="SEC02">SEC02 (Cybersecurity Analyst)</option>
            <option value="FED03">FED03 (Front-End Developer)</option>
          </select>
          <br>
          <fieldset class="personalinfo">
            <legend>Personal Information</legend>
            <!-- Fisrtname and Lastname inputs-->
            <div class="name_grid">
              <label for="fname">Firstname:</label>
              <input id="fname" type="text" name="fname" required="required" maxlength="20" pattern="[A-Za-z]{1,20}"
                placeholder="Firstname" title="enter alphabet characters only">
              <label for="lname">Lastname:</label>
              <input id="lname" type="text" name="lname" required="required" maxlength="20" pattern="[A-Za-z]{1,20}"
                placeholder="Lastname" title="enter alphabet characters only">
            </div>
            <br>
            <!-- Date of Birth -->
            <label for="dob">Date of Birth:</label>
            <input id="dob" type="date" name="dob" required="required" min="1900-01-01" max="2007-12-31">
            <br>
            <!-- Gender -->
            <fieldset>
              <legend>Your Gender</legend>
              <label><input type="radio" name="gender" value="Male" required="required">Male</label>
              <label><input type="radio" name="gender" value="Female">Female</label>
            </fieldset>
            <br>
            <!-- Street Address -->
            <label for="street_add">Enter your Street Address:</label>
            <input id="street_add" type="text" name="street_add" maxlength="40" pattern=".{1,40}" required="required"
              placeholder="Your Street Address" title="Please enter your Street Address">
            <br>
            <!-- Suburb/town -->
            <label for="suto">Enter your Suburb/town:</label>
            <input id="suto" type="text" name="suburb_town" maxlength="40" pattern=".{1,40}" required="required"
              placeholder="Your Suburb/town" title="Please enter your suburb/town">
            <br>
            <!-- State -->
            <label for="state">Select your State:</label>
            <select name="state" id="state" required="required">
              <option value="">Select your State</option>
              <option value="VIC">VIC</option>
              <option value="NSW">NSW</option>
              <option value="QLD">QLD</option>
              <option value="NT">NT</option>
              <option value="WA">WA</option>
              <option value="SA">SA</option>
              <option value="TAS">TAS</option>
              <option value="ACT">ACT</option>
            </select>
            <br>
            <!-- Postcode -->
            <label for="postcode">Enter your postcode:</label>
            <input id="postcode" type="text" name="postcode" maxlength="4" required="required" pattern="^[0-9]{4}$"
              placeholder="Your Postcode" title=" Please type exactly 4 digits based on States ">
            <br>
            <!-- Email address -->
            <label for="email">Enter your Email address:</label>
            <input id="email" type="text" name="email" required="required"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Your Email"
              title="Please enter the right format">
            <br>
            <!-- Phone number -->
            <label for="phone">Enter your phone number:</label>
            <input id="phone" type="text" name="phone_number" required="required" size="25" pattern="[0-9\s]{8,12}"
              placeholder="Your phone number" title="please enter the correct format">
            <br>
          </fieldset>
          <!-- Required technical list -->
          <fieldset class="reqskills">
            <legend>Required Technical Skills</legend>

            <!-- Core Networking & Security -->
            <label><input type="checkbox" name="skills[]" value="Network Security"> Network
              Security</label>
            <label><input type="checkbox" name="skills[]" value="Firewalls"> Firewalls</label>
            <label><input type="checkbox" name="skills[]" value="Incident Response"> Incident
              Response</label>
            <label><input type="checkbox" name="skills[]" value="Penetration Testing"> Penetration
              Testing</label>
            <label><input type="checkbox" name="skills[]" value="Ethical Hacking"> Ethical
              Hacking</label>
            <label><input type="checkbox" name="skills[]" value="SIEM Tools"> SIEM Tools</label>
            <label><input type="checkbox" name="skills[]" value="Risk Assessment"> Risk
              Assessment</label>
            <label><input type="checkbox" name="skills[]" value="Malware Analysis"> Malware
              Analysis</label>

            <!-- Cloud & Infrastructure -->
            <label><input type="checkbox" name="skills[]" value="AWS"> AWS (Amazon Web
              Services)</label>
            <label><input type="checkbox" name="skills[]" value="Azure"> Microsoft Azure</label>
            <label><input type="checkbox" name="skills[]" value="Google Cloud"> Google Cloud Platform
              (GCP)</label>
            <label><input type="checkbox" name="skills[]" value="Docker"> Docker</label>
            <label><input type="checkbox" name="skills[]" value="CI/CD"> CI/CD Pipelines</label>
            <label><input type="checkbox" name="skills[]" value="Linux Administration"> Linux
              Administration</label>
            <label><input type="checkbox" name="skills[]" value="Cloud Networking"> Cloud
              Networking</label>
            <label><input type="checkbox" name="skills[]" value="Cloud Security"> Cloud Security
            </label>
            <br>
            <label id="honest"> <input type="checkbox" name="skills[]" value="All I ticked are true" required="required"
                checked="checked">The skills I ticked are true representation of my
              abilities</label>
          </fieldset>
          <br>
          <!-- Other skills -->
          <label for="otherskills">Other skills (optional):</label>
          <br>
          <textarea name="otherskills" id="otherskills" placeholder="Other technical or job related skills"></textarea>
          <br>
          <!-- submit button -->
          <p class="apply">Submit your application form</p>
          <input type="submit" value="Apply" id="apply">
        </fieldset>
      </form>
    </div>
  </main>

<?php include 'footer.php'; ?>
</body>

</html>