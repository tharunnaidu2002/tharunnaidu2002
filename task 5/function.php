<?php
session_start();
require 'config.php';

if(isset($_POST['delete_college']))
{
    $college_id = mysqli_real_escape_string($con, $_POST['delete_college']);

    $query = "DELETE FROM college WHERE id='$college_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "College Details Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "College Details Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_college']))
{
    $college_id = mysqli_real_escape_string($con, $_POST['college_id']);

    $Name = mysqli_real_escape_string($con, $_POST['Name']);
    $Branches = mysqli_real_escape_string($con, $_POST['Branches']);
    $Year = mysqli_real_escape_string($con, $_POST['Year']);
    $Fees = mysqli_real_escape_string($con, $_POST['Fees']);

    $query = "UPDATE college SET Name='$Name', Branches='$Branches', Year='$Year', Fees='$Fees' WHERE id='$college_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "College Details Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "College Details Not Updated";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_college']))
{
    $Name = mysqli_real_escape_string($con, $_POST['Name']);
    $Branches = mysqli_real_escape_string($con, $_POST['Branches']);
    $Year = mysqli_real_escape_string($con, $_POST['Year']);
    $Fees = mysqli_real_escape_string($con, $_POST['Fees']);

    $query = "INSERT INTO college (Name,Branches,Year,Fees) VALUES ('$Name','$Branches','$Year','$Fees')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "College Details Created Successfully";
        header("Location: college-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "College Details Not Created";
        header("Location: college-create.php");
        exit(0);
    }
}

?>