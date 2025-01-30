<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logs Table Reader</title>
  <link rel="stylesheet" href="<?=ROOT?>public/assets/css/style.css"/>
</head>
<body>
  <section class="git-header-section"></section>
  <section class="main-section">
  <section class="logs-section">
    <div class="exception-container">
      <form method="post" id="exception-form">
        <input type="text" name="exception-name" minlength="3" maxlength="20" placeholder="insert exception name" pattern="^[A-Za-z0-9 ]+$" required/>
        <input type="hidden" name="type" id="type" value="exception"/>
        <input type="submit"/>
      </form>
    </div>
    <div class="error-container">
      <form method="post" id="error-form">
        <input type="text" name="error-name" minlength="3" maxlength="20" placeholder="insert error name" pattern="^[A-Za-z0-9 ]+$" required/>
        <input type="hidden" name="type" id="type" value="error"/>
        <input type="submit"/>
      </form>
    </div>
    <div class="access-container">
      <form method="post" id="access-form">
        <input type="text" name="access-name" minlength="3" maxlength="20" placeholder="insert access name" pattern="^[A-Za-z0-9 ]+$" required/>
        <input type="hidden" name="type" id="type" value="access"/>
        <input type="submit"/>
      </form>
    </div>
  </section>
  <section class="table-section">
  </section>
  </section>
  <section class="footer-section"></section>
  <script src="<?= ROOT?>public/assets/js/view/home.view.js" type="module"></script>
  <script src="<?= ROOT?>public/assets/js/common-components/index.js" type="module"></script>
</body>
</html>