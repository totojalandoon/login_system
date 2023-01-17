<?php

use LDAP\Result;

@include 'config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   < <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Welcome Admin</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
      <style>
         .content {
            width: 1000px;
            text-align: center;
         }

         .asd {
            justify-content: center;
            display: flex;
         }

         .topnav {
            overflow: hidden;
            background-color: #e9e9e9;
            border-radius: 15px;
         }

         .topnav input[type=text] {
            padding: 5px;
            margin-top: 8px;
            font-size: 17px;
            margin-right: 5px;
            float: right;
            border-radius: 5px;
            margin-bottom: 6px;

         }

         .topnav a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
         }

         table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 20px;
         }

         td,
         th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
         }

         tr:nth-child(even) {
            background-color: #dddddd;
         }

         .logout {
            width: 100%;
         }

         .search {
            width: 100%;

         }

         .bar {

            padding: 10px 30px;
         }
      </style>

</head>

<body>

   <div class="container">
      <div class="content">





         <div class="topnav search-bar">
            <form action="admin_page.php" method="post">
               <input type="text" placeholder="Search.." name="valueToSearch" class="search">
               <button class="search-btn " type="submit" name="search" class="searchbtn" value="Filter"> <span style="
    padding: 10px 30px;
    background: black;
    color: #fff;
    font-size: 12px;">Search</span></button>
         </div>
         <h3>Hi, <span><?php echo $_SESSION['admin_name'] ?></span></h3>
         <?php

         $conn = mysqli_connect("localhost", "root", "", "user_db");
         $sql = "SELECT * FROM user_form";
         $result = $conn->query($sql);
         // filter
         if (isset($_POST['search'])) {
            $valueToSearch = $_POST['valueToSearch'];
            // search in all table columns
            // using concat mysql function
            $query = "SELECT * FROM `user_form` WHERE `name` LIKE '%" . $valueToSearch . "%'";
            $search_result = filterTable($query);
         }

         function filterTable($query)
         {
            $connect = mysqli_connect("localhost", "root", "", "user_db");
            $filter_Result = mysqli_query($connect, $query);
            return $filter_Result;
         }

         ?>
         <p> </p>
         <p>Welcome <span><?php echo $_SESSION['admin_name'] ?></span>(Admin)</p>
         <table class=" table">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>ID Number</th>
                        </tr>
                     </thead>
                     <tbody>

                      <?php while ($row = mysqli_fetch_array($search_result)) : ?>
                           <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['idnum']; ?></td>

                           </tr>
                        <?php endwhile; ?>
                     <tbody>
                        </table>
                        <a href="logout.php" class="btn logout ">logout</a>

         </div>
         </form>
      </div>

</body>


</html>