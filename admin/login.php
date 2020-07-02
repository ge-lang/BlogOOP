<?php
require_once("includes/header.php");



//*controle of er reeds is ingelogd**/
if($session->is_signed_in()){
    redirect("index.php");
}
/**isset functie kijkt of er IETS aanwezig is dus geen NULL**/
if(isset($_POST['submit'])){
   $username = trim($_POST['username']);
   $password = trim($_POST['password']);

   /**methode check of de user bestaat*/
   $user_found = User::verify_user($username,$password);

   if($user_found){
       $session->login($user_found);
       redirect("index.php");
   }else{
       $the_message = "PASSWORD OR USERNAME NOT CORRECT, CHEATING HUH!";
   }

}else{
    $username = "";
    $password = "";
}



?>
<div class="container">
<div class="row">
    <div class="col-md-6 offset-md-3">
		<h3 class="bg-warning text-white text-center">
			<?php

			//echo $the_message;

			?></h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username"
                       value="<?php echo htmlentities($username); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password"
                       value="<?php echo htmlentities($password); ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Inloggen" class="btn btn-primary" name="submit">
            </div>
        </form>
    </div>
</div>
</div>
