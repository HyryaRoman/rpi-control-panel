<!doctype html>
<html>
  <head>
    <title>Control panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/control_panel.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="scripts/control_panel.js"></script>
  </head>
  <body>
    <!-- Page header -->
    <header>
      <h1>
        GPIO control panel
      </h1>
      <div class="refresh">
        Refresh rate <input type="number" min="15" max="60" step="5" value="30" id="timeout"> sec
      </div>
    </header>

    <!-- Main -->
    <section class="main">

      <!-- Card grid -->
      <div class="card-holder">
        <?php
          include 'scripts/create_panels.php';
        ?>
      </div>

    </section>

  </body>
</html>
