    <header id="main_header">
        <img src="images/todo_logo.gif" class="logo logo_large">
        <nav id="main-nav">
            <ul>
			<!--
                <li><a>Register</a></li>
                <li><a>Login</a></li>
                <li><a>About-us</a></li>
                <li><a>Account</a></li>
			-->


<?php
//loop through pages to create content
foreach($pages as $menu_id=>$menu_contents)
{
   //detect if our current page is the same page as the menu item we are currently creating
    //print("page = ".$_GET['page']." and menu_contest[pageUrl] = $menu_contents[pageUrl]<br>");
   $selected_menu_class = '';
   if($_GET['page']==$menu_contents['pageUrl'])
   {
       //add or create a class or style to apply to our current menu item
       $selected_menu_class = 'selected_menu_item';
   }
   //create LIs with encapsulated A with appropriate links and text contents
   echo "<li><a class='$selected_menu_class' href='index.php?page=$menu_contents[pageUrl]'>$menu_id</a></li>";
}

?>

				
					
            </ul>
        </nav>
    </header>