
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Web Technology Project">
  <meta name="keywords" content="Job, IT, Cloud Engineer, Cybersecurity">
  <meta name="author" content="Pham Duc Minh Quan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT Job Descriptions</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" href="images/logo_dataflow.png">
</head>

<body id="jobs_page">
  <?php 
  $pageTitle = "Job Description";
  include 'nav.inc'; 
  include 'header.inc.php';
  ?>

  <main class="main_container">
    <?php
    // Include database settings
    require_once 'settings.php';
    
    // Check if database connection is successful
    if ($conn) {
        // Fetch jobs from database
        $query = "SELECT * FROM jobs ORDER BY job_id";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<!-- Jobs loaded dynamically from database -->";
            
            $job_count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $job_count++;
                
                if ($job_count > 1) {
                    echo '<div class="job_divider"></div>';
                }
                ?>
                
                <section id="job<?php echo $job_count; ?>" class="job_card">
                    <h2>Position <?php echo $job_count; ?>: <?php echo $row['job_title']; ?></h2>
                    
                    <div class="job_summary">
                        <p><strong>Reference No:</strong> <?php echo $row['job_reference_number']; ?></p>
                        <p><strong>Reports To:</strong> <?php echo $row['reports_to']; ?></p>
                        <p><strong>Salary Range:</strong> <?php echo $row['salary_range']; ?></p>
                    </div>

                    <h3>Position Description</h3>
                    <p><?php echo $row['position_description']; ?></p>

                    <h3>Key Responsibilities</h3>
                    <ul>
                        <?php
                        $responsibilities = explode(';', $row['key_responsibilities']);
                        foreach ($responsibilities as $responsibility) {
                            if (trim($responsibility)) {
                                echo '<li>' . trim($responsibility) . '</li>';
                            }
                        }
                        ?>
                    </ul>

                    <h3>Required Qualifications & Skills</h3>
                    <h4>Essential</h4>
                    <ol>
                        <?php
                        $qualifications = explode(';', $row['required_qualifications']);
                        foreach ($qualifications as $qualification) {
                            if (trim($qualification)) {
                                echo '<li>' . trim($qualification) . '</li>';
                            }
                        }
                        ?>
                    </ol>

                    <h4>Preferable</h4>
                    <ul>
                        <?php
                        if (!empty($row['preferable_skills'])) {
                            $preferable_skills = explode(';', $row['preferable_skills']);
                            foreach ($preferable_skills as $skill) {
                                if (trim($skill)) {
                                    echo '<li>' . trim($skill) . '</li>';
                                }
                            }
                        } else {
                            echo '<li>None specified</li>';
                        }
                        ?>
                    </ul>
                </section>
                
                <?php
            }
            
            mysqli_free_result($result);
        } else {
            // If no jobs found in database, show error message
            echo '<div class="error-message">';
            echo '<h2>No Job Positions Available</h2>';
            echo '<p>We are currently not hiring. Please check back later for new opportunities.</p>';
            echo '</div>';
        }
        
        mysqli_close($conn);
    } else {
        // Database connection failed
        echo '<div class="error-message">';
        echo '<h2>Database Connection Error</h2>';
        echo '<p>Unable to load job positions at this time. Please try again later.</p>';
        echo '</div>';
    }
    ?>

    <aside id="job_facts">
      <h3>Did You Know?</h3>
      <p>Cloud Engineers and Cybersecurity Analysts are among the top 5 fastest-growing IT careers worldwide. Their combined expertise ensures both innovation and protection in modern digital infrastructure.</p>
    </aside>
  </main>

  <?php include 'footer.inc'; ?>
</body>
</html>
