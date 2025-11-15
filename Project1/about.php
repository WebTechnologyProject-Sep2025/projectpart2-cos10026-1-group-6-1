<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Thieu Quang Phuoc">
  <meta name="description" content="about us">
  <meta name="country" content="Vietnam">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" href="images/logo_dataflow.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ABOUT US</title>
</head>

<body>
  <?php $pageTitle= "About Us" ?>
  <?php include 'nav.inc'; include 'header.inc.php';?>

  <!-- THIS THE MAIN CONTAINER -->

  <main class="main_container">
    <section id="flex_container_hero">
      <div>
        <h1 id="flex_left_hero">DataFlow - Flowing Data. Generating Action.</h1>
        <ul id="flex_left_hero_ul">
          <li>Tutor: Mr. Hoang</li>
          <li>Due time: 23:59 13/10/2025</li>
          <li>Project Start: 1/10/2025</li>
        </ul>
        <div class="stats_container">
          <div class="stat_item">
            <span class="stat_number">4</span>
            <span class="stat_label">Members</span>
          </div>
          <div class="stat_item">
            <span class="stat_number">1</span>
            <span class="stat_label">Project</span>
          </div>
          <div class="stat_item">
            <span class="stat_number">COS10026</span>
            <span class="stat_label">Class</span>
          </div>
        </div>
      </div>
      <div id="flex_right_hero">
        <img id="group_photo" src="images/group_photo_300kb.jpg" alt="Group Photo">
      </div>
    </section>

    <section class="flex_container_hero_2">

      <div id="flex_left_hero_2">
        <h2>About the Group</h2>
        <p>The group comprises four principal members, with each individual assigned responsibility
          for a specific project component. Our primary objective is to develop a highly functional
          website aimed at attracting the most qualified applicants.</p>
      </div>

      <aside id="flex_right_hero_2">
        <h2 id="student_ids">Student IDs</h2>
        <ol>
          <li><strong>106216829</strong> - Thiều Quang Phước</li>
          <li><strong>106438723</strong> - Nguyễn Lâm Khải</li>
          <li><strong>104382736</strong> - Vũ Duy Anh</li>
          <li><strong>103787392</strong> - Phạm Đức Minh Quân</li>
        </ol>
      </aside>

    </section>

    <section class="team_card">
      <h2 id="team_title">Our team</h2>

      <div class="team_grid">
        <article class="member">
          <img src="images/1_khai_aigenerated_300kb.jpg" alt="Photo 1">
          <h3 class="member_name">Nguyễn Lâm Khải</h3>
          <p class="member_role">Backend Developer (PHP + Database Setup)</p>
        </article>

        <article class="member">
          <img src="images/2_quan_aigenerated_300kb.jpg" alt="Photo 2">
          <h3 class="member_name">Phạm Đức Minh Quân</h3>
          <p class="member_role">Frontend Integration & Documentation</p>
        </article>

        <article class="member">
          <img src="images/3_duyanh_aigenerated_300kb.jpg" alt="Photo 3">
          <h3 class="member_name">Vũ Duy Anh</h3>
          <p class="member_role">HR Management & Authentication System</p>
        </article>

        <article class="member">
          <img src="images/4_phuoc_aigenerated_300kb.jpg" alt="Photo 4">
          <h3 class="member_name">Thiều Quang Phước</h3>
          <p class="member_role">Form Handling & Validation</p>
        </article>

      </div>
    </section>

    <section class="team_contributions">

      <h2>Team Contributions</h2>

      <dl>

        <dt>Nguyễn Lâm Khải</dt>
        <dd>Set up the database with settings.php, created jobs and eoi tables, and enabled dynamic job loading in jobs.php.</dd>

        <dt>Phạm Đức Minh Quân</dt>
        <dd>Modularized the site with PHP includes, updated about.php, added enhancements.php, and finalized project structure.</dd>

        <dt>Vũ Duy Anh</dt>
        <dd>Built manage.php for HR management with search, update, delete, and login functions including lockout security</dd>

        <dt>Thiều Quang Phước</dt>
        <dd>Developed process_eoi.php for form handling, validation, and secure data insertion into the database.</dd>

      </dl>

    </section>

    <section class="members_interests">

      <h2>Technical & Personal Interests</h2>

      <table class="members_interests_table">
        <caption id="caption_table">The table below illustrates the technical and personal interests of each member in
          The DataFlow Team.
        </caption>

        <thead>
          <tr>
            <th rowspan="2">Members</th>
            <th colspan="4">Liking Programming Languages</th>
            <th colspan="3">Personal Interests</th>

          </tr>

          <tr>
            <th>HTML & CSS</th>
            <th>PHP</th>
            <th>Python</th>
            <th>Javascript</th>
            <th>Movies</th>
            <th>Books</th>
            <th>Musics</th>

          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Nguyễn Lâm Khải</td>
            <td colspan="4">x</td>
            <td>The God Father</td>
            <td>Atomic Habits</td>
            <td>Despacito</td>

          </tr>

          <tr>
            <td>Phạm Đức Minh Quân</td>
            <td>x</td>
            <td></td>
            <td>x</td>
            <td></td>
            <td>Batman</td>
            <td>Doraemon</td>
            <td>Gangnam Style</td>
          </tr>

          <tr>
            <td>Vũ Duy Anh</td>
            <td></td>
            <td>x</td>
            <td></td>
            <td colspan="1">x</td>
            <td colspan="2">Harry Potter (both movies and books)</td>
            <td>Shape of You</td>

          </tr>

          <tr>
            <td>Thiều Quang Phước</td>
            <td></td>
            <td colspan="3">x</td>
            <td>3 idiots</td>
            <td>The Third Door</td>
            <td>Winter Sonata (Piano)</td>
          </tr>

        </tbody>

      </table>
    </section>

  </main>

<?php include 'footer.inc'; ?>

</body>

</html>