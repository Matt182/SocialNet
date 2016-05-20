<?php
use hive2\models\User;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Profile ???</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <?php include_once 'head.php'; ?>
    <link rel="stylesheet" href="/hive2/src/views/style/profileStyle.css" />

</head>

<body>
  <div class="container">
             <!-- Sidebar -->
         <div class="col-md-4 bg-warning">
           <div>
             <h2>Egorrrrrr</h2>
           </div>
           <div><img class="thumbnail" src="/hive2/src/views/profile/avatars/default.jpg"></div>

            <p>Your friend|Confirm request|empty</p>

            <div>Edit profile|empty</div>
            <ul>
              <li><a id="home" href="/hive2/profile/????">Hive2</a></li>
              <li><a id="friends" href="/hive2/profile/???? ?>/friends">Friends <span class="badge">42</span></a></li>
              <li><a id="members" href="/hive2/members">Members</a></li>
              <li><a id="logout" href="/hive2/logout">Log Out</a></li>
            </ul>
         </div>
         <!-- /#sidebar-wrapper -->

         <!-- Page Content -->
         <div class="col-md-8">
                 <div class="row bg-warning">
                   <div class="col-md-offset-9 col-md-3">wasOnline</div>
                 </div>
                 <div class="row whitebg">
                   <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel panel-default">
                       <div class="panel-heading" role="tab" id="headingOne">
                         <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                             Info
                           </a>
                         </h4>
                       </div>
                       <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                         <div class="panel-body">
                           <p class="text-left">
                             resume resume resume resume resume resume resume resume resume resume
                             resume resume resume resume resume resume resume resume resume resume
                             resume resume resume resume resume resume resume resume resume resume
                             resume resume resume resume resume resume resume resume resume resume
                           </p>
                         </div>
                       </div>
                     </div>
                   </div>

                 </div>

                 <div class="row bg-info">
                     <form class="form-inline" method="post" action="/hive2/profile/???/postRecord">
                       <textarea class="form-control" rows='1' name="content" id="content"></textarea>
                       <button class="btn btn-default" type="submit" >post</button>
                     </form>
                 </div>

                 <div class="col-md-offset-2 col-md-8">
                   <div class="row myRecord">

                         <div class="col-md-8"><b>Андреич</b></div> <div class="col-md-4">25.09.2016</div>
                         <div class="col-md-offset-1 col-md-10">
                           <p>
                             Запись запись запись
                             Запись запись запись
                             Запись запись запись
                           </p>

                         </div>
                         <div class="col-md-offset-10 col-md-2"><span class="glyphicon glyphicon-menu-up"></span> 0</div>


                           <div class="col-md-offset-1 col-md-10">
                             <b>Сергеич</b> 23.05.2016<br>
                             комент комент комент комент
                           </div>
                           <form class="form-inline" method="post" action="/hive2/profile/???/??? ?>/addComment">
                             <div class="input-group">
                               <input type="text" class="form-control" placeholder="Comment...">
                               <span class="input-group-btn">
                                 <button class="btn btn-default" type="button">Go!</button>
                               </span>
                             </div>
                           </form>
                   </div>
                   <hr />
                 </div>

         </div>
         <!-- /#page-content-wrapper -->
       </div>
</body>
</html>
