<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db1";
$insert = false;
$update = false;
$delete = false;
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    echo "Server not Connected" . mysqli_connect_error();
}

// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['delete'])) {
        $sno = $_GET["delete"];
        $sql = "DELETE FROM `notes` WHERE `notes`.`sr` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snedit'])) {
        //update record
        $snedit = $_POST["snedit"];
        $title = $_POST["title"];
        $description = $_POST["desc"];
        $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description'  WHERE `notes`.`sr` = $snedit";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["desc"];

        $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        body {
            background: url(bg1.jpg) no-repeat center center/cover;
        }
        .container{
            margin-top: 70px;
            margin-left: 93px;
            max-width: 777px;
        }
        .container h2{
            text-align: center;

        }
        .form-group label{
            font-weight: bold;
            color: red;
            /* filter: ; */
        }
        .form-group input,.form-group textarea{
            background: none;
            border: 2px solid black;
            width: 720px;
        }
        .dataTables_wrapper{
            width: 722px;
            background: none;
        }
    </style>
    <title>Make-Notes</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
        Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodallable" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodallable">Edit Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="snedit" id="snedit">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Note-Title</label>
                            <input type="text" id="titleedit" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Heading Comes Here...!">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Note-Description</label>
                            <textarea class="form-control" id="descedit" name="desc" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update-Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Notes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About-Us <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Contact-Us <span class="sr-only">(current)</span></a>
                </li>

            </ul>
           
        </div>
    </nav>
    <?php
    if ($insert) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Congrats....!</strong> You have added record successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if ($update) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Congrats....!</strong> You have Updated record successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if ($delete) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Congrats....!</strong> You have Deleted the record successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }



    ?>
    <div class="container ">
        <h2>Add Notes</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Note-Title</label>
                <input type="text" class="form-control" id="heding" name="title" aria-describedby="emailHelp" placeholder="Heading Comes Here...!">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Note-Description</label>
                <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add-to-Notes</button>
        </form>


    </div>
    <div class="container my-4">


        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query = "SELECT * FROM notes";
                $result = mysqli_query($conn, $query);
                $sr = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sr = $sr + 1;
                    echo "<tr>
            <th scope='row'>" . $sr . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><button class='edit btn btn-sm btn-primary' id=" . $row['sr'] . ">Edit</button> / <button class='delete btn btn-sm btn-primary'id=d" . $row['sr'] . ">Delete</button></a>
            </td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
        <hr>
    </div>

    <!-- <h1>Hello, world!</h1> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                // console.log(title, description);
                titleedit.value = title;
                descedit.value = description;
                snedit.value = e.target.id;
                // console.log(e.target.id);
                $('#editmodal').modal('toggle')
            })
        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit", );
                // tr = e.target.parentNode.parentNode;

                sno = e.target.id.substr(1, );
                // title = tr.getElementsByTagName("td")[0].innerText;
                // description = tr.getElementsByTagName("td")[1].innerText;
                // console.log(title, description);   

                if (confirm("Are you sure to delete this Record...!")) {
                    window.location = `index.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>