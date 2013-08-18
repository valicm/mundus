<?php ?>

<!-- start from drupal body -->
<body>

  <!-- Top menu / toolbar -->
  <div class="topline">
    <div class="row">

      <header id="header" role="banner" class="large-12 columns">

        <!-- Navigation&toolbar bar -->
        <nav id="navigation" role="navigation" class="top-bar">

          <!-- Print main menu  -->
          <section class="top-bar-section">
            <?php if ($main_menu): ?>
              <div id="main-menu" class="navigation">
                <?php print theme('links__system_main_menu'); ?>
              </div>
            <?php endif; ?>
          </section>
          <!-- end main menu  -->

          <!-- Toolbar & mobile menu icon -->
          <ul class="title-area">
            <li class="name">
              <ul id="quick-links">

                <!-- Mundus search  -->
                <?php if (theme_get_setting('mundus_search_top')): ?>
                  <li class="search">
                    <a href="#" data-reveal-id="search-mundus">
                      <?php print t('Search '); ?>
                      <i class="foundicon-search"></i>
                    </a>
                    <div id="search-mundus" class="reveal-modal">
                      <?php print $mundus_search; ?>
                      <a class="close-reveal-modal">
                        <i class="foundicon-remove"></i>
                      </a>
                    </div>
                  </li>
                <?php endif; ?>
                <!-- end Mundus search  -->

                <!-- Mundus social  -->
                <?php if (theme_get_setting('social_profiles_top')): ?>
                  <li class="social">
                    <a href="#" data-reveal-id="social-mundus">
                      <?php print t('Social '); ?>
                      <i class="foundicon-people"></i>
                    </a>
                    <div id="social-mundus" class="reveal-modal">
                      <?php print render($page['social']); ?>
                      <a class="close-reveal-modal">
                        <i class="foundicon-remove"></i>
                      </a>
                    </div>
                  </li>
                <?php endif; ?>
                <!-- end Mundus social  -->

                <!-- Mundus login  -->
                <?php if (theme_get_setting('mundus_login_top')): ?>

                  <?php if ($logged_in): ?>
                    <li class="login"> <?php print l(t('My Account'), 'user'); ?></li>
                  <?php else: ?>

                    <li class="login">
                      <a href="#" data-reveal-id="login-mundus">
                        <?php print t('Log in '); ?>
                        <i class="foundicon-lock"></i>
                      </a>
                      <div id="login-mundus" class="reveal-modal">
                        <div class="large-6 columns">
                          <?php print drupal_render(drupal_get_form('user_login')); ?>
                          <ul class="inline-list">
                            <li> <?php print l(t(' Create an account '), 'user/register'); ?></a><li>
                            <li> <?php print l(t(' Forgot your password? '), 'user/password'); ?></a><li>
                          </ul>
                        </div>
                        <div class="large-6 columns">
                          <?php print render($page['login_region']); ?>
                        </div>
                        <a class="close-reveal-modal">
                          <i class="foundicon-remove"></i>
                        </a>
                      </div>
                    </li>

                  <?php endif; ?>
                <?php endif; ?>
                <!-- end Mundus login  -->

              </ul>
            </li>

            <!--  mobile menu icon -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
            <!-- end mobile menu icon -->

          </ul>
          <!-- end toolbar & mobile menu icon -->

        </nav>
        <!-- end navigation toolbar bar-->

      </header>
    </div>
  </div>
  <!-- end of top menu / toolbar -->

  <!-- Additional header region - full width -->
  <div class="row">
    <?php print render($page['header']); ?>
  </div>
  <!-- end of header region -->


  <div class="row">
    <div id="content" class="large-8 columns" role="main">

      <!-- Mundus logo -->
      <div id="logo">
        <h1><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a></h1>
      </div>
      <!-- end logo -->

      <!-- Drupal default content  -->
      <?php print $messages; ?>
      <?php print render($page['help']); ?>

      <?php if ($page['highlighted']): ?>
        <div id="highlighted"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>

      <!-- Two additionl region on frontpage -->
      <div class="row">

        <?php if ($page['content_left']): ?>
          <div class="large-6 columns">
            <?php print render($page['content_left']); ?>
          </div>
        <?php endif; ?>

        <?php if ($page['content_right']): ?>
          <div class="large-6 columns">
            <div class="panel radius">
              <?php print render($page['content_right']); ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
      <!-- end additional region frontpage -->

      <?php if ($breadcrumb): ?>
        <?php print $breadcrumb; ?>
      <?php endif; ?>

      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($tabs): ?>
        <div class="tabs"><?php print render($tabs); ?></div>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>

      <?php print render($page['content']); ?>
    </div>
    <!-- end Drupal default content  -->

    <!-- Print sidebar region -->
    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" class="large-4 columns" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>
    </div>
  <?php endif; ?>
  <!-- end sidebar region -->

  <!-- Middle full width block region -->
  <div class="row">
    <div class="large-12 columns">
      <?php print render($page['middle']); ?>
    </div>
  </div>
  <!-- end middle region -->

  <!-- Three blocks region -->
  <div class="row">

    <div class="large-4 columns">
      <?php print render($page['one']); ?>
    </div>

    <div class="large-4 columns">
      <?php print render($page['two']); ?>
    </div>

    <div class="large-4 columns">
      <?php print render($page['three']); ?>
    </div>

  </div>
  <!-- end three blocks region -->

  <!-- FOOTER REGION -->
  <?php if ($page['footer']): ?>
    <div class="row">
      <div class="large-12 columns">
        <footer id="footer" role="contentinfo">
          <?php print render($page['footer']); ?>
        </footer>
      </div>
    </div>
  <?php endif; ?>
  <!-- end footer -->
