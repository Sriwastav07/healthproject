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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Responsive Navbar & BMI Calculator</title>
    <style>
        html, body {
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
        .chart-bar {
            transition: height 0.5s ease-in-out;
        }
        .health-card {
            transition: transform 0.3s ease;
        }
        .health-card:hover {
            transform: translateY(-5px);
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
          }
          .calendar-day {
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s;
          }
          .calendar-day:hover {
            background-color: rgba(59, 130, 246, 0.1);
          }
          .calendar-day.active {
            background-color: rgba(59, 130, 246, 0.2);
            font-weight: bold;
          }
          .calendar-day.has-data {
            position: relative;
          }
          .calendar-day.has-data::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            background-color: #3b82f6;
            border-radius: 50%;
          }
    </style>
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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Atugatran/FontAwesome6Pro@latest/css/all.min.css" > -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <div class="flex flex-col min-h-screen max-w-full">
        <!-- Top Navbar -->
        
    
        <div class="flex flex-col sm:flex-row flex-grow">
            <!-- Sidebar for Desktop -->
            <div class="hidden sm:flex flex-col h-screen py-8 justify-between w-20 items-center bg-white fixed left-0 top-0 bottom-0 shadow-lg">
                <div class="flex flex-col items-center space-y-1">
                  <a href="#" class="p-3 rounded-full">
                    <i class="fa-solid fa-heart-pulse text-3xl sidebar-icon text-[#f06419]"></i>
                  </a>
                </div>
                
                <div class="flex flex-col items-center space-y-10">
                  <a href="nit.html" class="p-3 rounded-full sidebar-active">
                    <i class="fa-solid fa-house text-3xl sidebar-icon"></i>
                  </a>
                  <a href="appointment.php" class="p-3 rounded-full">
                    <i class="fa-solid fa-calendar-days text-3xl sidebar-icon"></i>
                  </a>
                  <a href="runner.php" class="p-3 rounded-full">
                    <i class="fa-solid fa-person-running text-3xl sidebar-icon"></i>
                  </a>
                  <a href="profile.php" class="p-3 rounded-full ">
                    <i class="fa-solid fa-user text-3xl sidebar-icon"></i>
                  </a>
                </div>
                
                <div class="flex flex-col items-center space-y-1">
                  <a href="#" id="logout-sidebar" class="p-3 rounded-full">
                    <i class="fa-solid fa-door-open text-3xl sidebar-icon text-gray-500"></i>
                  </a>
                </div>
              </div>
              <script>
                document.getElementById("logout-sidebar").addEventListener("click", function (e) {
                  e.preventDefault();
                  window.location.href = "backend/logout.php"; // Adjusted path
                });
              </script>

            </div>
            <!-- Main Content -->
            <div class="flex flex-col p-4 sm:ml-20 items-center w-full border-4 border-amber-300">
                <!-- Name Header - Full Width -->
                <div class="heading bg-blue-100 rounded-2xl flex justify-between items-center p-3 md:p-4 text-lg md:text-2xl lg:text-3xl w-full max-w-screen-lg mb-4">
                    <div class="font-bold">
                        <h1>Hii <span class="text-blue-600">Aarti</span></h1>
                        
                    </div>
                    <ul class="flex gap-3 sm:gap-5">
                        <li><i class="fa-solid fa-magnifying-glass"></i></li>
                        <li><i class="fa-solid fa-bell"></i></li>
                    </ul>
                </div>
                
                <!-- Main Content Container - Side by Side -->
                <div class="flex flex-col lg:flex-row flex-grow justify-between w-full">
                    <!-- Health Metrics Container -->
                    <div class="flex flex-col w-full lg:w-4/6">
                        <div class="gap-3 flex flex-col sm:flex-row w-full sm:gap-7 md:gap-10">
                            <div class="!bg-blue-50 h-[225px] w-full p-4 rounded-2xl flex flex-col">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <i class="fa-solid fa-droplet text-6xl" style="color: #e73313;"></i>
                                    </div>
                                    <span class="mr-[10px] text-sm">Blood Sugar</span>
                                </div>
                                <div class="flex-grow mt-3">
                                    <span class="bg-red-200">Normal</span>
                                    <p class="mt-5">
                                        <span class="text-2xl">80</span> mg/dL
                                    </p>
                                </div>
                                <button class="bg-green-400 w-[70%] cursor-pointer text-white flex justify-center mx-auto rounded-lg">Try Again</button>
                            </div>
                            
                            <div class="!bg-blue-50 h-[225px] w-full rounded-2xl flex flex-col p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <i class="fa-solid fa-heart-pulse text-6xl" style="color: #e55d34;"></i>
                                    </div>
                                    <span class="mr-[10px] text-sm">Blood Pressure</span>
                                </div>
                                <div class="flex-grow mt-3">
                                    <span class="bg-red-200">Normal</span>
                                    <p class="mt-5">
                                        <span class="text-2xl">102/72</span> mmhg
                                    </p>
                                </div>
                                <button class="bg-green-400 w-[70%] text-white cursor-pointer flex justify-center mx-auto rounded-lg">Try Again</button>
                            </div>
                            
                            <div class="!bg-blue-50 h-[225px] w-full rounded-2xl flex flex-col p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <i class="fa-solid fa-heart-circle-bolt text-6xl" style="color: #97d2f7;"></i>
                                    </div>
                                    <span class="mr-[10px] text-sm">Heart Rate</span>
                                </div>
                                <div class="flex-grow mt-3">
                                    <span class="bg-red-200 text-sm">Normal</span>
                                    <p class="mt-5">
                                        <span class="text-2xl">96</span> bpm
                                    </p>
                                </div>
                                <button class="bg-green-400 w-[70%] text-white cursor-pointer flex justify-center mx-auto rounded-lg">Try Again</button>
                            </div>
                            
                        </div>

                        <!-- Graph -->
                        <div class="max-w-full p-4 bg-white rounded-xl shadow-md">
                          <!-- Header -->
                          <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                              <h1 class="text-xl font-bold text-gray-800 mb-3 md:mb-0">Exercise Activity Tracker</h1>
                              <button id="add-exercise-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
                                  Add Exercise
                              </button>
                          </div>
                  
                          <!-- Graph Section -->
                          <div class="mb-6 h-64 md:h-80">
                              <canvas id="exercise-chart"></canvas>
                          </div>
                  
                          <!-- Exercise Summary -->
                          <div class="mb-6">
                              <h2 class="text-lg font-semibold mb-3">Activity Summary</h2>
                              <div class="grid grid-cols-2 md:grid-cols-4 gap-3" id="activity-summary">
                                  <div class="p-3 bg-blue-100 rounded-lg">
                                      <div class="text-sm text-gray-600">Running</div>
                                      <div class="font-bold text-lg" id="running-total">120 min</div>
                                      <div class="text-xs text-gray-500">This week</div>
                                  </div>
                                  <div class="p-3 bg-green-100 rounded-lg">
                                      <div class="text-sm text-gray-600">Cycling</div>
                                      <div class="font-bold text-lg" id="cycling-total">90 min</div>
                                      <div class="text-xs text-gray-500">This week</div>
                                  </div>
                                  <div class="p-3 bg-yellow-100 rounded-lg">
                                      <div class="text-sm text-gray-600">Swimming</div>
                                      <div class="font-bold text-lg" id="swimming-total">45 min</div>
                                      <div class="text-xs text-gray-500">This week</div>
                                  </div>
                                  <div class="p-3 bg-purple-100 rounded-lg">
                                      <div class="text-sm text-gray-600">Jogging</div>
                                      <div class="font-bold text-lg" id="jogging-total">60 min</div>
                                      <div class="text-xs text-gray-500">This week</div>
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Recent Exercise History -->
                          <div>
                              <h2 class="text-lg font-semibold mb-3">Recent Activity</h2>
                              <div class="overflow-x-auto">
                                  <table class="min-w-full bg-white">
                                      <thead class="bg-gray-100">
                                          <tr>
                                              <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                              <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                              <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                              <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody class="divide-y divide-gray-200" id="activity-table-body">
                                          <tr>
                                              <td class="py-2 px-3 text-sm text-gray-800">Apr 01, 2025</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">Running</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">30 min</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">
                                                  <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                                  <button class="text-red-600 hover:text-red-800">Delete</button>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="py-2 px-3 text-sm text-gray-800">Mar 31, 2025</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">Cycling</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">45 min</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">
                                                  <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                                  <button class="text-red-600 hover:text-red-800">Delete</button>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="py-2 px-3 text-sm text-gray-800">Mar 30, 2025</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">Swimming</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">20 min</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">
                                                  <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                                  <button class="text-red-600 hover:text-red-800">Delete</button>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="py-2 px-3 text-sm text-gray-800">Mar 29, 2025</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">Jogging</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">30 min</td>
                                              <td class="py-2 px-3 text-sm text-gray-800">
                                                  <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                                  <button class="text-red-600 hover:text-red-800">Delete</button>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  
                      <!-- Add Exercise Modal -->
                      <div id="exercise-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                          <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                              <h2 class="text-xl font-bold mb-4">Add Exercise</h2>
                              <form id="exercise-form">
                                  <div class="mb-4">
                                      <label for="exercise-date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                      <input type="date" id="exercise-date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                  </div>
                                  <div class="mb-4">
                                      <label for="exercise-type" class="block text-sm font-medium text-gray-700 mb-1">Activity Type</label>
                                      <select id="exercise-type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                          <option value="">Select an activity</option>
                                          <option value="Running">Running</option>
                                          <option value="Cycling">Cycling</option>
                                          <option value="Swimming">Swimming</option>
                                          <option value="Jogging">Jogging</option>
                                          <option value="Weight Training">Weight Training</option>
                                          <option value="Yoga">Yoga</option>
                                          <option value="Other">Other</option>
                                      </select>
                                  </div>
                                  <div class="mb-4">
                                      <label for="exercise-duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                                      <input type="number" id="exercise-duration" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                  </div>
                                  <div class="mb-4">
                                      <label for="exercise-notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                                      <textarea id="exercise-notes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2"></textarea>
                                  </div>
                                  <div class="flex justify-end space-x-3">
                                      <button type="button" id="cancel-btn" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">Cancel</button>
                                      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Activity</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                        
                        
                        <!-- Consultation -->
                        <div class=" bg-gray-200 mt-auto h-auto min-h-[50px] text-[20px] sm:text-[25px] flex flex-col sm:flex-row justify-center items-center p-2 sm:p-4 w-full">
                            <span>Upcoming Event - </span>
                            <span id="currentTime" class="mx-2 font-semibold"></span>
                            <span>Consultation with <span class="font-bold">Dr. John Doe</span></span>
                        </div>
                    </div>
                    
                    
                    <!-- BMI Calculator - Side by Side -->
                    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-sm h-full">
                      <div class="p-6 bg-gradient-to-r from-cyan-100 to-blue-100 border-5 border-amber-700">
                          <!-- Tabs for BMI and Body Measurements -->
                          <div class="flex rounded-lg bg-gray-200 p-1 mb-4">
                              <button id="bmi-tab-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium bg-blue-500 text-white">BMI Calculator</button>
                              <button id="measurements-tab-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium text-gray-700">Body Measurements</button>
                          </div>
                          
                          <!-- BMI Calculator Section -->
                          <div id="bmi-section" class="text-center">
                              <h1 class="text-xl font-bold text-gray-800 mb-4">BMI Calculator</h1>
                              
                              <!-- Unit Toggle -->
                              <div class="flex rounded-lg bg-gray-200 p-1 mb-6">
                                  <button id="metric-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium bg-blue-500 text-white">Metric</button>
                                  <button id="imperial-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium text-gray-700">Imperial</button>
                              </div>
                              
                              <!-- Metric Form -->
                              <div id="metric-form" class="space-y-4">
                                  <div>
                                      <label for="metric-height" class="block text-sm font-medium text-gray-700 text-left mb-1">Height (cm)</label>
                                      <input type="number" id="metric-height" placeholder="e.g., 175" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                                  
                                  <div>
                                      <label for="metric-weight" class="block text-sm font-medium text-gray-700 text-left mb-1">Weight (kg)</label>
                                      <input type="number" id="metric-weight" placeholder="e.g., 70" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                              </div>
                              
                              <!-- Imperial Form -->
                              <div id="imperial-form" class="space-y-4 hidden">
                                  <div>
                                      <label for="imperial-height-ft" class="block text-sm font-medium text-gray-700 text-left mb-1">Height (ft)</label>
                                      <input type="number" id="imperial-height-ft" placeholder="e.g., 5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                                  
                                  <div>
                                      <label for="imperial-height-in" class="block text-sm font-medium text-gray-700 text-left mb-1">Height (in)</label>
                                      <input type="number" id="imperial-height-in" placeholder="e.g., 9" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                                  
                                  <div>
                                      <label for="imperial-weight" class="block text-sm font-medium text-gray-700 text-left mb-1">Weight (lbs)</label>
                                      <input type="number" id="imperial-weight" placeholder="e.g., 150" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                              </div>
                              
                              <!-- Calculate Button -->
                              <button id="calculate-btn" class="w-full mt-6 py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-300 ease-in-out">Calculate BMI</button>
                              
                              <!-- Results Section -->
                              <div id="result" class="mt-6 p-4 rounded-lg hidden">
                                  <h2 class="text-lg font-semibold mb-2">Your BMI Result</h2>
                                  <div id="bmi-value" class="text-3xl font-bold my-2">0.0</div>
                                  <div id="bmi-category" class="text-lg font-medium mb-2">Category</div>
                                  <p id="bmi-description" class="text-sm text-gray-600">Description of your BMI result will appear here.</p>
                              </div>
                          </div>
                          
                          <!-- Body Measurements Section -->
                          <div id="measurements-section" class="text-center hidden">
                              <h1 class="text-xl font-bold text-gray-800 mb-4">Body Measurements</h1>
                              
                              <!-- Measurement Units Toggle -->
                              <div class="flex rounded-lg bg-gray-200 p-1 mb-6">
                                  <button id="cm-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium bg-blue-500 text-white">Centimeters</button>
                                  <button id="inch-btn" class="w-1/2 py-2 rounded-lg text-sm font-medium text-gray-700">Inches</button>
                              </div>
                              
                              <!-- Measurements Form -->
                              <div class="space-y-4">
                                  <div>
                                      <label for="chest-size" class="block text-sm font-medium text-gray-700 text-left mb-1">Chest Size</label>
                                      <input type="number" id="chest-size" placeholder="e.g., 95" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                                  
                                  <div>
                                      <label for="waist-size" class="block text-sm font-medium text-gray-700 text-left mb-1">Waist Size</label>
                                      <input type="number" id="waist-size" placeholder="e.g., 80" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                                  
                                  <div>
                                      <label for="hip-size" class="block text-sm font-medium text-gray-700 text-left mb-1">Hip Size</label>
                                      <input type="number" id="hip-size" placeholder="e.g., 100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                  </div>
                              </div>
                              
                              <!-- Save Button -->
                              <button id="save-measurements-btn" class="w-full mt-6 py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-300 ease-in-out">Save Measurements</button>
                              
                              <!-- Measurements History -->
                              <div class="mt-6">
                                  <h3 class="text-lg font-semibold mb-2 text-left">Saved Measurements</h3>
                                  <div id="measurements-history" class="text-sm">
                                      <div class="bg-gray-100 p-3 rounded-lg mb-2">
                                          <div class="flex justify-between text-gray-700">
                                              <span>Date:</span>
                                              <span id="current-date">-</span>
                                          </div>
                                          <div class="flex justify-between mt-1">
                                              <span>Chest:</span>
                                              <span id="current-chest">-</span>
                                          </div>
                                          <div class="flex justify-between mt-1">
                                              <span>Waist:</span>
                                              <span id="current-waist">-</span>
                                          </div>
                                          <div class="flex justify-between mt-1">
                                              <span>Hip:</span>
                                              <span id="current-hip">-</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <!-- Bottom Navigation for Mobile -->
        <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg p-3 flex justify-around items-center sm:hidden border-t border-gray-300">
            <i class="fa-solid fa-heart-pulse text-2xl text-[#f06419] cursor-pointer hover:scale-110 transition-transform"></i>
            <i class="fa-solid fa-house text-2xl text-[#63E6BE] cursor-pointer hover:scale-110 transition-transform"></i>
            <i class="fa-solid fa-calendar-days text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
            <i class="fa-solid fa-person-running text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
            <i class="fa-solid fa-user text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
            <i class="fa-solid fa-door-open text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
        </div>
    </div>
    <script src="nit.js"></script>
</body>
</html>
