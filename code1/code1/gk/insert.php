<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Name']) && isset($_POST['Password']) &&
        isset($_POST['Gender']) && isset($_POST['Email'])) 
     {
        
        $Name = $_POST['Name'];
        $Password = $_POST['Password'];
        $Email = $_POST['Email'];
        $Gender = $_POST['Gender'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "user2";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Email FROM register2 WHERE Email = ? LIMIT 1";
            $Insert = "INSERT INTO register2(Name, Password, Gender, Email) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssss",$Name, $Password, $Gender, $Email);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
 
?>