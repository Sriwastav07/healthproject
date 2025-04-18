<?php
// Start session for error handling
session_start();

$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "myapp"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signUp'])) {
        // Sign Up Logic
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if username or email already exists
        $checkUserQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Username or Email already exists.";
        } else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                $_SESSION['error_message'] = "Registration successful. Please sign in.";
            } else {
                $_SESSION['error_message'] = "Error during registration.";
            }
        }

    } elseif (isset($_POST['signIn'])) {
        // Sign In Logic
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch user details from the database
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Redirect to a different page after successful login
                header("Location: ../nit.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid password.";
            }
        } else {
            $_SESSION['error_message'] = "Username does not exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp/Login to Health</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        function showForm(formType) {
            if (formType === "signUp") {
                document.getElementById("signInForm").classList.add("hidden");
                document.getElementById("signUpForm").classList.remove("hidden");
                document
                    .getElementById("signInTab")
                    .classList.remove("border-blue-500", "text-blue-500");
                document
                    .getElementById("signUpTab")
                    .classList.add("border-blue-500", "text-blue-500");
            } else {
                document.getElementById("signInForm").classList.remove("hidden");
                document.getElementById("signUpForm").classList.add("hidden");
                document
                    .getElementById("signUpTab")
                    .classList.remove("border-blue-500", "text-blue-500");
                document
                    .getElementById("signInTab")
                    .classList.add("border-blue-500", "text-blue-500");
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-gray-100 flex justify-center items-center min-h-screen p-6">
    <div class="flex flex-col md:flex-row bg-white p-8 md:p-10 rounded-3xl shadow-2xl gap-8 w-full max-w-5xl transition-all duration-300">

        <!-- Left Side: Health Analytics -->
        <div class="space-y-8 w-full md:w-1/2">
            <!-- Content Sections -->
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <img src="img/img-1.png" alt="Health Data" class="w-full md:w-1/2 rounded-xl shadow-md object-cover transform hover:scale-105 transition-transform duration-300" />
                <p class="text-gray-700 text-sm w-full md:w-1/2">We refine dirty data to unlock its hidden potential for healthcare transformation.</p>
            </div>
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <p class="text-gray-700 text-sm w-full md:w-1/2 font-semibold">Cost-Effective</p>
                <img src="img/img-2.png" alt="Healthcare Insights" class="w-full md:w-1/2 rounded-xl shadow-md object-cover transform hover:scale-105 transition-transform duration-300" />
            </div>
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <img src="img/img-3.png" alt="Predictive Analysis" class="w-full md:w-1/2 rounded-xl shadow-md object-cover transform hover:scale-105 transition-transform duration-300" />
                <p class="text-gray-700 text-sm w-full md:w-1/2">View collective data of individual providers.</p>
            </div>
        </div>

        <!-- Right Side: Sign In/Sign Up Panel -->
        <div class="w-full md:w-1/2 max-w-sm mx-auto">
            <!-- Tabs -->
            <div class="flex justify-between border-b pb-2 mb-6">
                <div id="signInTab" class="w-1/2 text-center cursor-pointer border-b-2 border-blue-500 text-blue-500 font-bold pb-2 transition-all duration-300 hover:opacity-80" onclick="showForm('signIn')">Sign In</div>
                <div id="signUpTab" class="w-1/2 text-center cursor-pointer border-b-2 text-gray-500 pb-2 transition-all duration-300 hover:text-blue-500" onclick="showForm('signUp')">Sign Up</div>
            </div>

            <!-- Sign In Form -->
            <form method="POST" id="signInForm" class="bg-blue-50 p-10 rounded-xl shadow-lg w-full min-h-[350px] transition-all duration-300">
                <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Sign In</h2>
                <label class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all" placeholder="Enter username" />
                <label class="block text-gray-700 mt-4 font-medium">Password</label>
                <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all" placeholder="Enter password" />
                
                <?php if (isset($_SESSION['error_message'])): ?>
                    <p class="text-red-500 text-sm mt-2"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
                <?php endif; ?>

                <p class="text-right text-blue-500 text-sm mt-2 cursor-pointer hover:underline">Forgot Password?</p>
                <button type="submit" name="signIn" class="w-full bg-blue-500 text-white p-3 rounded-lg mt-4 shadow-md hover:bg-blue-600 transition-all">Login</button>
            </form>

            <!-- Sign Up Form -->
            <form method="POST" id="signUpForm" class="bg-blue-50 p-10 rounded-xl shadow-lg w-full min-h-[350px] hidden transition-all duration-300">
                <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Sign Up</h2>
                <label class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all" placeholder="Enter username" />
                <label class="block text-gray-700 mt-4 font-medium">Email</label>
                <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all" placeholder="Enter email" />
                <label class="block text-gray-700 mt-4 font-medium">Password</label>
                <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all" placeholder="Enter password" />

                <?php if (isset($_SESSION['error_message'])): ?>
                    <p class="text-red-500 text-sm mt-2"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
                <?php endif; ?>

                <button type="submit" name="signUp" class="w-full bg-blue-500 text-white p-3 rounded-lg mt-4 shadow-md hover:bg-blue-600 transition-all">Sign Up</button>
            </form>

            <br />
            <p class="text-center text-gray-700 font-medium">Other Sign-up Options</p>

            <!-- Social Icons -->
            <div class="flex justify-evenly items-center gap-4 p-4">
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://logos-world.net/wp-content/uploads/2023/08/X-Logo.png" alt="X/Twitter" class="w-10 h-10 object-contain" />
                </a>
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHP2W0X8Bj9Wwou8Y5Iv2q_Aa-nME9SMwEAA&s" alt="Instagram" class="w-10 h-10 object-contain" />
                </a>
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/en/0/04/Facebook_f_logo_%282021%29.svg" alt="Facebook" class="w-10 h-10 object-contain" />
                </a>
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Gmail_icon_%282020%29.svg" alt="Gmail" class="w-10 h-10 object-contain" />
                </a>
            </div>
        </div>
    </div>
</body>
</html>
