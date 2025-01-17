
<?php
?>
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                <nav class="main-nav">
                  <!-- ***** Logo Start ***** -->
                  <a href="/eduwell/index.php" class="logo">
                      <img src="/eduwell/assets/images/templatemo-eduwell.png" alt="EduWell Template">
                  </a>
                  <!-- ***** Logo End ***** -->
                  <!-- ***** Menu Start ***** -->
                  <ul class="nav">
                    <li class="scroll-to-section"><a href="/eduwell/index.php#top" class="active">Home</a></li>
                    <li class="scroll-to-section"><a href="/eduwell/index.php#services">Services</a></li>
                    <li class="scroll-to-section"><a href="/eduwell/index.php#courses">Courses</a></li>
                    <li class="has-sub">
                        <a href="javascript:void(0)">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="/eduwell/about-us.php">About Us</a></li>
                            <li><a href="/eduwell/our-services.php">Our Services</a></li>
                            <li><a href="/eduwell/contact-us.php">Contact Us</a></li>
                        </ul>
                    </li>
                    <li><a href="/eduwell/index.php#testimonials">Testimonials</a></li> 
                    <li><a href="/eduwell/index.php#contact-section">Contact Us</a></li> 

		    <!-- Admin sekcia -->
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li><a href="/eduwell/admin/admin.php">Admin Panel</a></li>
                        <li><a href="/eduwell/admin/logout.php">Odhlásiť sa</a></li>
                    <?php else: ?>
                        <li><a href="/eduwell/admin/login.php">Prihlásiť sa</a></li>
                    <?php endif; ?>

                  </ul>      
                  <a class='menu-trigger'>
                      <span>Menu</span>
                  </a>
                  <!-- ***** Menu End ***** -->
                </nav>
              </div>
          </div>
      </div>
  </header>