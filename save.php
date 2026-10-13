
<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_registration";

// Create connection
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $database
);

// Check connection
if ($conn->connect_error) {

    die("Database connection failed: " . $conn->connect_error);
}


// Check whether form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $admission_number =
        trim($_POST["admission_number"] ?? "");
    $message = trim($_POST["message"] ?? "");


    // Basic validation
    if (
        empty($fullname) ||
        empty($email) ||
        empty($phone) ||
        empty($gender) ||
        empty($course) ||
        empty($admission_number)
    ) {

        die("Please fill in all required fields.");
    }


    // Prepared statement
    $sql = "INSERT INTO students
            (
                fullname,
                email,
                phone,
                gender,
                course,
                admission_number,
                message
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);


    if (!$stmt) {

        die("Database error: " . $conn->error);
    }


    // Bind values
    $stmt->bind_param(
        "sssssss",
        $fullname,
        $email,
        $phone,
        $gender,
        $course,
        $admission_number,
        $message
    );


    // Execute
    if ($stmt->execute()) {

        echo "
        <!DOCTYPE html>

        <html>

        <head>

            <title>Registration Successful</title>

            <style>

                body {
                    font-family: Arial;
                    background: #063970;

                    display: flex;
                    justify-content: center;
                    align-items: center;

                    min-height: 100vh;
                }

                .success-box {
                    background: white;
                    padding: 40px;

                    border-radius: 15px;

                    text-align: center;

                    max-width: 500px;
                }

                h1 {
                    color: #063970;
                }

                p {
                    color: #555;
                }

                a {
                    display: inline-block;

                    margin-top: 20px;

                    padding: 12px 25px;

                    background: #063970;
                    color: white;

                    text-decoration: none;

                    border-radius: 8px;
                }

            </style>

        </head>

        <body>

            <div class='success-box'>

                <h1>Registration Successful!</h1>

                <p>
                    The student's information has been
                    successfully saved to the database.
                </p>

                <a href='index.html'>
                    Register Another Student
                </a>

            </div>

        </body>

        </html>
        ";

    } else {

        echo "Error saving data: " . $stmt->error;
    }


    $stmt->close();
}

$conn->close();

?>
