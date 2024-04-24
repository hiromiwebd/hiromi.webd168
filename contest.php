<!DOCTYPE html>
<!-- hiromi -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>File Upload Assignment</title>

    <style>
        body {
            background-image: url(https://digitalasset.intuit.com/IMAGE/A8K6wIHO2/photographer-taking-pictures-on-the-edge-of-a-cliff_INF31371.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0px;
        }
        
        body,
        input {
            font-family: arial, sans-serif;
            font-size: 100%;
        }
        
        h1 {
            font-size: 1.8em;
        }
        
        h2 {
            font-size: 1.25em;
        }
        
        p {
            color: #A0522D;
        }
        
        #wrapper {
            width: auto;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
        }
        
        .flexcontainer {
            width: 350px;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 25px;
        }
        
        .flexcontainer label {
            width: 50px;
        }
        
        [type=submit],
        [type=reset] {
            margin-top: 25px;
            padding: 10px;
            border: none;
            background-color: rgba(163, 84, 46, 0.2);
        }
        
        .grid-container {
            display: grid;
            grid-column-gap: 2px;
            grid-template-columns: 150px 150px 150px;
            padding: 0px;
        }
        
        .grid-item {
            background-color: rgba(163, 84, 46, 0.2);
            padding: 5px;
            text-align: center;
        }
        
        aside {
            font-size: 0.8em;
        }
        
        form {
            border-top: 1px solid #000;
            padding-top: 20px;
            margin-top: 20px;
        }

        .red {
            font-size: 20px;
            color: red;
        }
    </style>
</head>

<body>

<?php


    // check to see if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // initialize variables
        $msg = '';
        $photo_okay = false;

        $name = $_POST['name'];
        $email = $_POST['email'];

        //check if a file was uploaded without errors
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

            $file_name      = $_FILES["photo"]["name"];
            $file_type      = $_FILES["photo"]["type"];
            $file_size      = $_FILES["photo"]["size"];
            $file_tmp_name  = $_FILES["photo"]["tmp_name"];
            $file_error     = $_FILES["photo"]["error"]; 

            //test
            echo $file_name     ."<br>";
            echo $file_type     ."<br>";
            echo $file_size     ."<br>";
            echo $file_tmp_name     ."<br>";
            echo $file_error     ."<br>";

            //test
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";

            if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
                $msg = "<span class=red>You must upload a jpeg, or ong file</span>";
            }
            else {
                //upload the file exists
                $new_file_name = 'uploads/' . $file_name;
                move_uploaded_file($file_tmp_name, $new_file_name);

                $photo_okay = true;
                $msg = "Thank you $name for entering our photo contest. You have submitted the below photo: " . $new_file_name;
            }
        }
    }
    else {
        exit ('You do not have permission to view this page!');
    }

?>
    <div id="wrapper">
        <header>
            <h1>Photo Contest</h1>
        </header>

        <p> 
            <?php echo $msg;
            ?> 
        </p>

            <?php

                if ($photo_okay) {
                    echo "<img src=uploads/" . $file_name .">";
                }
            ?>
        <section>
            <h2>Upload your favorite photo for entry into our contest!</h2>

            <aside class="grid-container">
                <div class="grid-item">1st Place: $1,000.00</div>
                <div class="grid-item">2nd Place: $500.00</div>
                <div class="grid-item">3rd Place: $250.00</div>
            </aside>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">

                <div class="flexcontainer">
                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" maxlength="30" required>
                </div>

                <div class="flexcontainer">
                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" maxlength="30" required>
                </div>

                <div class="flexcontainer">
                    <label for="photo">Photo: </label>
                    <input type="file" id="photo" name="photo" required>
                </div>

                <p>Please upload a jpg, jpeg, or png file.</p>
                <input type="submit" value="Upload Photo" class="clear">

                <input type="reset" value="Clear Form">
            </form>
        </section>

    </div>

</body>

</html>
