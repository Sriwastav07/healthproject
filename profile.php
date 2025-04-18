<?php
session_start();

// Prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: /php/CA%20Health%20project/healthproject/backend/signup.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <!-- Using a single CDN for Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      .profile-gradient {
        background: linear-gradient(135deg, #63e6be 0%, #4f46e5 100%);
      }
      .sidebar-icon {
        transition: all 0.3s ease;
      }
      .sidebar-icon:hover {
        transform: scale(1.2);
        color: #4f46e5;
      }
      .sidebar-active {
        color: #63e6be;
        position: relative;
      }
      .sidebar-active::after {
        content: "";
        position: absolute;
        right: -12px;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 20px;
        background-color: #63e6be;
        border-radius: 4px;
      }
      .custom-input {
        transition: all 0.3s ease;
      }
      .custom-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
      }
      .btn-primary {
        background: linear-gradient(135deg, #63e6be 0%, #4f46e5 100%);
        transition: all 0.3s ease;
      }
      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
      }
      .btn-danger {
        background: linear-gradient(135deg, #fca5a5 0%, #ef4444 100%);
        transition: all 0.3s ease;
      }
      .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
      }
    </style>
  </head>
  <body class="bg-gray-50 flex">
    <!-- Sidebar -->
    <div
      class="hidden sm:flex flex-col h-screen py-8 justify-between w-20 items-center bg-white fixed left-0 top-0 bottom-0 shadow-lg"
    >
      <div class="flex flex-col items-center space-y-1">
        <a href="#" class="p-3 rounded-full">
          <i
            class="fa-solid fa-heart-pulse text-3xl sidebar-icon text-[#f06419]"
          ></i>
        </a>
      </div>

      <div class="flex flex-col items-center space-y-10">
        <a href="nit.php" class="p-3 rounded-full">
          <i class="fa-solid fa-house text-3xl sidebar-icon"></i>
        </a>
        <a href="appointment.php" class="p-3 rounded-full">
          <i class="fa-solid fa-calendar-days text-3xl sidebar-icon"></i>
        </a>
        <a href="runner.php" class="p-3 rounded-full">
          <i class="fa-solid fa-person-running text-3xl sidebar-icon"></i>
        </a>
        <a href="profile.php" class="p-3 rounded-full sidebar-active">
          <i class="fa-solid fa-user text-3xl sidebar-icon"></i>
        </a>
      </div>

      <div class="flex flex-col items-center space-y-1">
        <a href="#" id="logout-sidebar" class="p-3 rounded-full">
          <i
            class="fa-solid fa-door-open text-3xl sidebar-icon text-gray-500"
          ></i>
        </a>
      </div>
    </div>
    <script>
        document.getElementById("logout-sidebar").addEventListener("click", function (e) {
            e.preventDefault();
            window.location.href = "backend/logout.php"; // Adjusted path
        });
    </script>


    <!-- Main Content -->
    <div class="ml-0 sm:ml-20 w-full min-h-screen p-4 sm:p-8">
      <!-- Mobile Header -->
      <div class="sm:hidden flex justify-between items-center mb-6 p-2">
        <div class="flex items-center">
          <i class="fa-solid fa-heart-pulse text-2xl text-[#f06419] mr-2"></i>
          <h2 class="text-lg font-semibold">Health App</h2>
        </div>
        <button id="mobile-menu-btn" class="text-2xl">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

      <!-- Mobile Menu (hidden by default) -->
      <div
        id="mobile-menu"
        class="hidden sm:hidden fixed top-14 left-0 right-0 bg-white shadow-lg z-50 p-4"
      >
        <div class="flex flex-col space-y-4">
          <a
            href="nit.php"
            class="flex items-center p-2 hover:bg-gray-100 rounded"
          >
            <i class="fa-solid fa-house text-xl mr-3"></i>
            <span>Home</span>
          </a>
          <a
            href="dashBoard.html"
            class="flex items-center p-2 hover:bg-gray-100 rounded"
          >
            <i class="fa-solid fa-calendar-days text-xl mr-3"></i>
            <span>Calendar</span>
          </a>
          <a href="#" class="flex items-center p-2 hover:bg-gray-100 rounded">
            <i class="fa-solid fa-person-running text-xl mr-3"></i>
            <span>Activities</span>
          </a>
          <a href="#" class="flex items-center p-2 bg-gray-100 rounded">
            <i class="fa-solid fa-user text-xl mr-3 text-[#63E6BE]"></i>
            <span>Profile</span>
          </a>
          <a
            href="#"
            id="logout-mobile"
            class="flex items-center p-2 hover:bg-gray-100 rounded text-red-500"
          >
            <i class="fa-solid fa-door-open text-xl mr-3"></i>
            <span>Logout</span>
          </a>
        </div>
      </div>

      <div class="max-w-4xl mx-auto">
        <div
          class="flex flex-col md:flex-row justify-between items-center mb-8"
        >
          <h1 class="text-3xl font-bold text-gray-800 mb-2 md:mb-0">
            Profile Settings
          </h1>
          <div class="flex items-center">
            <span
              id="verification-badge"
              class="hidden bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full flex items-center mr-2"
            >
              <i class="fa-solid fa-check-circle mr-1"></i>
              Verified
            </span>
            <span id="user-since" class="text-sm text-gray-500"
              >Member since: <span id="join-date">Loading...</span></span
            >
          </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
          <!-- Profile Header -->
          <div class="profile-gradient h-32 relative">
            <div class="absolute -bottom-16 left-6">
              <div class="relative">
                <img
                  id="profile-pic-main"
                  src="/api/placeholder/120/120"
                  alt="Profile"
                  class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md"
                />
                <label
                  for="upload-profile-main"
                  class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 cursor-pointer shadow-md hover:bg-blue-600 transition"
                >
                  <i class="fa-solid fa-camera"></i>
                </label>
                <input
                  type="file"
                  id="upload-profile-main"
                  class="hidden"
                  accept="image/*"
                />
              </div>
            </div>
          </div>

          <!-- Profile Body -->
          <div class="pt-20 px-6 pb-6">
            <form id="profile-form">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username -->
                <div>
                  <label
                    for="username"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Username</label
                  >
                  <div class="relative">
                    <span
                      class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                    >
                      <i class="fa-solid fa-user"></i>
                    </span>
                    <input
                      type="text"
                      id="username"
                      class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                      value="Loading..."
                      disabled
                    />
                  </div>
                </div>

                <!-- Full Name -->
                <div>
                  <label
                    for="full-name"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Full Name</label
                  >
                  <div class="relative">
                    <span
                      class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                    >
                      <i class="fa-solid fa-id-card"></i>
                    </span>
                    <input
                      type="text"
                      id="full-name"
                      class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                      placeholder="Enter your full name"
                    />
                  </div>
                </div>

                <!-- Email -->
                <div>
                  <label
                    for="email"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Email</label
                  >
                  <div class="relative">
                    <span
                      class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                    >
                      <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input
                      type="email"
                      id="email"
                      class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                      placeholder="Enter your email"
                    />
                  </div>
                </div>

                <!-- Phone Number -->
                <div>
                  <label
                    for="phone"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >Phone Number</label
                  >
                  <div class="relative">
                    <span
                      class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                    >
                      <i class="fa-solid fa-phone"></i>
                    </span>
                    <input
                      type="tel"
                      id="phone"
                      class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                      placeholder="Enter your phone number"
                    />
                  </div>
                </div>
              </div>

              <!-- Password Section -->
              <div class="mt-8 mb-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                  Change Password
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Current Password -->
                  <div>
                    <label
                      for="current-password"
                      class="block text-sm font-medium text-gray-700 mb-1"
                      >Current Password</label
                    >
                    <div class="relative">
                      <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                      >
                        <i class="fa-solid fa-lock"></i>
                      </span>
                      <input
                        type="password"
                        id="current-password"
                        class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                        placeholder="Enter current password"
                      />
                    </div>
                  </div>

                  <!-- New Password -->
                  <div>
                    <label
                      for="new-password"
                      class="block text-sm font-medium text-gray-700 mb-1"
                      >New Password</label
                    >
                    <div class="relative">
                      <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                      >
                        <i class="fa-solid fa-key"></i>
                      </span>
                      <input
                        type="password"
                        id="new-password"
                        class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                        placeholder="Enter new password"
                      />
                    </div>
                  </div>

                  <!-- Confirm New Password -->
                  <div class="md:col-span-2">
                    <label
                      for="confirm-password"
                      class="block text-sm font-medium text-gray-700 mb-1"
                      >Confirm New Password</label
                    >
                    <div class="relative">
                      <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                      >
                        <i class="fa-solid fa-check-double"></i>
                      </span>
                      <input
                        type="password"
                        id="confirm-password"
                        class="custom-input pl-10 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none"
                        placeholder="Confirm new password"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <!-- Email Verification Status -->
              <div
                id="email-verification"
                class="my-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg hidden"
              >
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <i
                      class="fa-solid fa-exclamation-circle text-yellow-400 text-xl"
                    ></i>
                  </div>
                  <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">
                      Email verification required
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700">
                      <p>
                        Please verify your email address to access all features.
                      </p>
                    </div>
                    <div class="mt-4">
                      <button
                        type="button"
                        id="resend-verification"
                        class="text-sm font-medium text-yellow-800 hover:text-yellow-900"
                      >
                        Resend verification email
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Update Button -->
              <div class="mt-6">
                <button
                  type="submit"
                  class="btn-primary w-full py-3 px-4 text-white font-medium rounded-lg focus:outline-none"
                >
                  Update Profile
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
          <div class="px-6 py-4 bg-red-50 border-b border-red-100">
            <h3 class="text-lg font-semibold text-red-800">Danger Zone</h3>
          </div>
          <div class="p-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
              <div>
                <h4 class="text-base font-medium text-gray-800">
                  Delete Account
                </h4>
                <p class="text-sm text-gray-600">
                  This action cannot be undone.
                </p>
              </div>
              <button
                id="delete-account"
                class="btn-danger mt-4 md:mt-0 py-2 px-4 text-white font-medium rounded-lg focus:outline-none"
              >
                Delete Account
              </button>
            </div>
          </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center mb-8">
          <button
            id="logout-btn"
            class="btn-danger w-full md:w-1/2 py-3 px-4 text-white font-medium rounded-lg focus:outline-none flex items-center justify-center"
          >
            <i class="fa-solid fa-door-open mr-2"></i>
            Logout
          </button>
        </div>
      </div>
    </div>

    <!-- Confirmation Modal for Delete Account -->
    <div
      id="delete-modal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
    >
      <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Delete Account</h3>
        <p class="text-gray-600 mb-6">
          Are you sure you want to delete your account? This action cannot be
          undone and all your data will be permanently removed.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-end">
          <button
            id="cancel-delete"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition"
          >
            Cancel
          </button>
          <button
            id="confirm-delete"
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
          >
            Delete Account
          </button>
        </div>
      </div>
    </div>

    <!-- Toast Notification -->
    <div
      id="toast"
      class="fixed bottom-4 right-4 px-4 py-2 bg-green-600 text-white rounded-lg shadow-lg z-50 hidden"
    >
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle mr-2"></i>
        <span id="toast-message">Profile updated successfully!</span>
      </div>
    </div>

    <script>
      // DOM Elements
      // Function to fetch user data from your SQL database
      async function fetchUserData() {
        try {
          // Show loading state if needed

          // Make API call to your backend
          const response = await fetch("/api/user/profile", {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"), // If using JWT authentication
            },
          });

          if (!response.ok) {
            throw new Error("Failed to fetch profile data");
          }

          // Parse the response from your SQL database
          userData = await response.json();

          // Populate the form with user data
          populateUserData();

          showToast("Profile data loaded successfully");
        } catch (error) {
          console.error("Error fetching user data:", error);
          showToast("Failed to load profile data", false);
        }
      }

      // Function to update user data in your SQL database
      async function updateUserData(formData) {
        try {
          // Make API call to update user data
          const response = await fetch("/api/user/profile", {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"), // If using JWT
            },
            body: JSON.stringify({
              fullName: formData.fullName,
              email: formData.email,
              phone: formData.phone,
            }),
          });

          if (!response.ok) {
            throw new Error("Failed to update profile");
          }

          // Update local data with response
          const result = await response.json();
          userData = result.user;

          showToast("Profile updated successfully");
        } catch (error) {
          console.error("Error updating user data:", error);
          showToast("Failed to update profile", false);
        }
      }

      // Function to update password
      async function updatePassword(currentPassword, newPassword) {
        try {
          const response = await fetch("/api/user/password", {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
            body: JSON.stringify({
              currentPassword,
              newPassword,
            }),
          });

          if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || "Password update failed");
          }

          showToast("Password updated successfully");
          return true;
        } catch (error) {
          console.error("Error updating password:", error);
          showToast(error.message || "Failed to update password", false);
          return false;
        }
      }

      // Update profile form submission handler
      profileForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const fullName = document.getElementById("full-name").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const currentPassword =
          document.getElementById("current-password").value;
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword =
          document.getElementById("confirm-password").value;

        // Basic validation
        if (!fullName || !email) {
          showToast("Please fill in all required fields", false);
          return;
        }

        // Update profile information
        await updateUserData({ fullName, email, phone });

        // Handle password update separately if provided
        if (newPassword) {
          if (!currentPassword) {
            showToast("Please enter your current password", false);
            return;
          }

          if (newPassword !== confirmPassword) {
            showToast("New passwords do not match", false);
            return;
          }

          const passwordUpdated = await updatePassword(
            currentPassword,
            newPassword
          );
          if (passwordUpdated) {
            // Clear password fields
            document.getElementById("current-password").value = "";
            document.getElementById("new-password").value = "";
            document.getElementById("confirm-password").value = "";
          }
        }
      });

      // Handle profile image upload
      async function uploadProfileImage(file) {
        try {
          const formData = new FormData();
          formData.append("profileImage", file);

          const response = await fetch("/api/user/profile/image", {
            method: "POST",
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
            body: formData,
          });

          if (!response.ok) {
            throw new Error("Failed to upload image");
          }

          const result = await response.json();
          return result.imageUrl;
        } catch (error) {
          console.error("Error uploading image:", error);
          throw error;
        }
      }

      // Update the profile image handler
      uploadProfileBtn.addEventListener("change", async (event) => {
        const file = event.target.files[0];
        if (file) {
          try {
            // First show the image locally for immediate feedback
            const reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById("profile-pic-main").src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Then upload to server
            await uploadProfileImage(file);
            showToast("Profile picture updated successfully");
          } catch (error) {
            showToast("Failed to update profile picture", false);
          }
        }
      });

      // Handle account deletion
      confirmDeleteBtn.addEventListener("click", async () => {
        try {
          const response = await fetch("/api/user/account", {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          });

          if (!response.ok) {
            throw new Error("Failed to delete account");
          }

          // Clear local storage/session
          localStorage.removeItem("token");
          sessionStorage.clear();

          showToast("Account deleted successfully");

          // Redirect to login page after a short delay
          setTimeout(() => {
            window.location.href = "index.html";
          }, 2000);
        } catch (error) {
          console.error("Error deleting account:", error);
          showToast("Failed to delete account", false);
        } finally {
          deleteModal.classList.add("hidden");
        }
      });

      // Resend verification email
      resendVerificationBtn.addEventListener("click", async () => {
        try {
          const response = await fetch("/api/user/verify-email/resend", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          });

          if (!response.ok) {
            throw new Error("Failed to send verification email");
          }

          showToast("Verification email sent");
        } catch (error) {
          console.error("Error sending verification email:", error);
          showToast("Failed to send verification email", false);
        }
      });

      // Logout functionality
      function handleLogout() {
        // Clear authentication tokens
        localStorage.removeItem("token");
        sessionStorage.clear();

        showToast("Logging out...");

        setTimeout(() => {
          window.location.href = "index.html";
        }, 1500);
      }
    </script>
  </body>
</html>
