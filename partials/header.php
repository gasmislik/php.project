 <!--header.php-->
    <section class=" pt-2  text-white .bg-gradient  text-center card border rounded-5 p-3  shadow box-area border-white bg-transparent sticky-top " id="first">
 <nav class="navbar navbar-expand-lg  "> 
        <div class="text-start ps-2 ">
            <img id="person" src="..\img\18.png" alt=" person" width="50" height="50" onclick="show()" > 
        </div>
<div class="up ps-5">
<a href="main.php" aria-current="page" class="d-inline-block ps-5 text-white  link-offset-2 link-underline link-underline-opacity-0" >Home</a>
   <a href="documents.php" class="d-inline-block ps-5 text-white  link-offset-2 link-underline link-underline-opacity-0" >Documents</a>
   <a href="grade_appeal.php"  class="d-inline-block ps-5 text-white link-offset-2 link-underline link-underline-opacity-0">Grade Appeal</a>

  </div>
<div class="position-absolute top-0 end-0 ps-2  " >

<a class="icon-link" href="actions.php" style="position: relative; display: inline-block;">
    <img src="..\img\15.png" alt="notifications" width="50" height="50">
    <?php if ($totalNotifications > 0): ?>
        <span class="badge bg-danger" style="position: absolute; top: 7px; right: 14px; padding: 5px 10px; font-size: 16px; color: white; border-radius: 50%;">
            <?php echo $totalNotifications; ?>
        </span>
    <?php endif; ?>
</a>

  </div>
 </nav>
</section>
