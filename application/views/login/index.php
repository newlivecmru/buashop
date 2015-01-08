<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8">
        <title>templateAdmin</title>
            <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/login.css" />
    </header>
<body>
 <?php
 if($this->session->flashdata('msg_error'))
 {
     echo'<p><font color=red>';
     echo $this->session->flashdata('msg_error');
     echo '</font></p>';
 }
   
?>
     <form method="post" action="<?php echo site_url('login/dologin');?>" class="login">
  <p>
      <label for="login">Username:</label>
      <input type="text" name="username" id="username" value="admin">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="admin">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
  </form>

    
</body>
</html>