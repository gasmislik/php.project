  <!--sidebar.php-->
 <div id="side-bar" class="bg-dark-subtle text-dark-emphasis .bg-gradient"  id="subMenu"> 
        <nav>
             <div class="profile">
                 <img src="..\img\18.png" alt=" person" width="50" height="50"   onclick="show()"   > 
                 <ul>
                    <li>
                         <a href="main.php">Home</a>
                        </li>
                    <li>
                         <a href="actions.php">Actions</a>
                        </li>
                    
                </ul>
             </div>
             <div style="text-align:center; padding:15%;"> 
      <p  style="font-size:20px; font-weight:bold;"> 
       Hello  <?php  
       if(isset($_SESSION['email'])){ 
        $email=$_SESSION['email']; 
        $query=mysqli_query($conn, "SELECT users.* FROM users WHERE users.email='$email'"); 
        while($row=mysqli_fetch_array($query)){ 
            echo $row['firstName'].' '.$row['lastName']; 
        } 
       } 
       ?> 
       
       
      </p> 
      <a href="../backend/Logout.php">Logout</a> 
    </div> 
               
         </nav></div>
     
     

