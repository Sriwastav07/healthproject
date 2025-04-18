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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Health Monitoring Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#2d85fe",
              "primary-light": "#e6f0ff",
            },
          },
        },
      };
    </script>
  </head>
  <body class="bg-blue-50 text-gray-800 flex">
    <!-- Fixed Sidebar -->
    <div class="flex flex-col sm:flex-row flex-grow">
      <!-- Sidebar for Desktop -->
      <div class="hidden sm:flex flex-col h-screen py-8 justify-between w-20 items-center bg-white fixed left-0 top-0 bottom-0 shadow-lg">
        <div class="flex flex-col items-center space-y-1">
          <a href="#" class="p-3 rounded-full">
            <i class="fa-solid fa-heart-pulse text-3xl sidebar-icon text-[#f06419]"></i>
          </a>
        </div>
        
        <div class="flex flex-col items-center space-y-10">
          <a href="nit.php" class="p-3 rounded-full">
            <i class="fa-solid fa-house text-3xl sidebar-icon"></i>
          </a>
          <a href="appointment.php" class="p-3 rounded-full">
            <i class="fa-solid fa-calendar-days text-3xl sidebar-icon"></i>
          </a>
          <a href="runner.php" class="p-3 rounded-full sidebar-active">
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


    <!-- Main Content -->
    <div class="ml-20 p-8 w-full">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Health Dashboard</h1>
      </div>

      <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
      >
        <!-- Medication Reminders Card -->
        <div
          class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
              Medication Reminders
            </h2>
            <div
              class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center text-primary"
            >
              <i class="fas fa-pills"></i>
            </div>
          </div>
          <ul class="space-y-3">
            <li
              class="flex justify-between items-center py-3 border-b border-blue-50"
            >
              <div class="flex flex-col">
                <span class="font-medium">Vitamin D</span>
                <span class="text-sm text-gray-500">8:00 AM</span>
              </div>
              <span
                class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium"
                >Completed</span
              >
            </li>
            <li
              class="flex justify-between items-center py-3 border-b border-blue-50"
            >
              <div class="flex flex-col">
                <span class="font-medium">Blood Pressure Med</span>
                <span class="text-sm text-gray-500">12:30 PM</span>
              </div>
              <span
                class="px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium"
                >Upcoming</span
              >
            </li>
            <li class="flex justify-between items-center py-3">
              <div class="flex flex-col">
                <span class="font-medium">Probiotic</span>
                <span class="text-sm text-gray-500">8:00 PM</span>
              </div>
              <span
                class="px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium"
                >Upcoming</span
              >
            </li>
          </ul>
          <button
            class="mt-4 w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white py-3 px-4 rounded-lg transition duration-300"
          >
            <i class="fas fa-plus"></i>
            <span>Add Medication</span>
          </button>
        </div>

        <!-- Fitness Goals Card -->
        <div
          class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Fitness Goals</h2>
            <div
              class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center text-primary"
            >
              <i class="fas fa-dumbbell"></i>
            </div>
          </div>
          <ul class="space-y-3" id="fitness-listul">
            <li
              class="flex justify-between items-center py-3 border-b border-blue-50"
            >
              <div class="flex flex-col">
                <span class="font-medium">Morning Walk</span>
                <span class="text-sm text-gray-500">30 minutes, 7:00 AM</span>
              </div>
              <span
                class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium"
                >Completed</span
              >
            </li>
            <li
              class="flex justify-between items-center py-3 border-b border-blue-50"
            >
              <div class="flex flex-col">
                <span class="font-medium">Strength Training</span>
                <span class="text-sm text-gray-500">45 minutes, 6:00 PM</span>
              </div>
              <span
                class="px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium"
                >Upcoming</span
              >
            </li>
            <li class="flex justify-between items-center py-3">
              <div class="flex flex-col">
                <span class="font-medium">Yoga Session</span>
                <span class="text-sm text-gray-500">20 minutes, 9:00 PM</span>
              </div>
              <span
                class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-medium"
                >Missed</span
              >
            </li>
          </ul>
          <button
            class="mt-4 w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white py-3 px-4 rounded-lg transition duration-300"
            id="add-fitness"
          >
            <i class="fas fa-plus"></i>
            <span>Add Fitness Goal</span>
          </button>
        </div>

        <!-- Health Stats Card -->
        <div
          class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Health Stats</h2>
            <div
              class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center text-primary"
            >
              <i class="fas fa-chart-line"></i>
            </div>
          </div>
          <div class="flex justify-between mb-6">
            <div class="flex flex-col items-center">
              <span class="text-2xl font-semibold text-primary">7.5</span>
              <span class="text-sm text-gray-500">Sleep (hrs)</span>
            </div>
            <div class="flex flex-col items-center">
              <span class="text-2xl font-semibold text-primary">8,462</span>
              <span class="text-sm text-gray-500">Steps</span>
            </div>
            <div class="flex flex-col items-center">
              <span class="text-2xl font-semibold text-primary">72</span>
              <span class="text-sm text-gray-500">Heart Rate</span>
            </div>
          </div>
          <div class="mt-4">
            <div class="flex justify-between mb-2">
              <span class="text-sm">Daily Goal Progress</span>
              <span class="text-sm">75%</span>
            </div>
            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
              <div class="h-full bg-primary w-3/4 rounded-full"></div>
            </div>
          </div>
        </div>

        <!-- Notifications Card -->
        <div
          class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Notifications</h2>
            <div
              class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center text-primary"
            >
              <i class="fas fa-bell"></i>
            </div>
          </div>
          <div class="space-y-4">
            <div class="flex gap-4 py-3 border-b border-blue-50">
              <div
                class="w-8 h-8 bg-primary-light rounded-full flex items-center justify-center text-primary flex-shrink-0"
              >
                <i class="fas fa-pills"></i>
              </div>
              <div>
                <p class="mb-1">Time to take your Blood Pressure medication</p>
                <p class="text-xs text-gray-500">12:30 PM Today</p>
              </div>
            </div>
            <div class="flex gap-4 py-3 border-b border-blue-50">
              <div
                class="w-8 h-8 bg-primary-light rounded-full flex items-center justify-center text-primary flex-shrink-0"
              >
                <i class="fas fa-dumbbell"></i>
              </div>
              <div>
                <p class="mb-1">Strength Training session is scheduled</p>
                <p class="text-xs text-gray-500">6:00 PM Today</p>
              </div>
            </div>
            <div class="flex gap-4 py-3">
              <div
                class="w-8 h-8 bg-primary-light rounded-full flex items-center justify-center text-primary flex-shrink-0"
              >
                <i class="fas fa-heartbeat"></i>
              </div>
              <div>
                <p class="mb-1">Weekly health report is now available</p>
                <p class="text-xs text-gray-500">Yesterday, 9:00 AM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Current date and time functionality
          function getCurrentDateTime() {
            const now = new Date();
            return {
              date: now.toLocaleDateString(),
              time: now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
              hour: now.getHours(),
              minute: now.getMinutes()
            };
          }
          
          // Initialize medication data
          const medications = [
            { id: 1, name: "Vitamin D", time: "8:00 AM", status: "completed", taken: true },
            { id: 2, name: "Blood Pressure Med", time: "12:30 PM", status: "pending", taken: false },
            { id: 3, name: "Probiotic", time: "8:00 PM", status: "pending", taken: false }
          ];
          
          // Initialize fitness data
          const fitnessGoals = [
            { id: 1, name: "Morning Walk", details: "30 minutes, 7:00 AM", status: "completed", completed: true },
            { id: 2, name: "Strength Training", details: "45 minutes, 6:00 PM", status: "pending", completed: false },
            { id: 3, name: "Yoga Session", details: "20 minutes, 9:00 PM", status: "missed", completed: false }
          ];
          
          // Add new medication functionality
          const addMedicationBtn = document.querySelector('button:nth-of-type(1)');
          addMedicationBtn.addEventListener('click', function() {
            const medName = prompt("Enter medication name:");
            if (!medName) return;
            
            const medTime = prompt("Enter time (e.g. 3:00 PM):");
            if (!medTime) return;
            
            const newMed = {
              id: medications.length + 1,
              name: medName,
              time: medTime,
              status: "pending",
              taken: false
            };
            
            medications.push(newMed);
            
            // Create and append new medication item
            const medList = document.querySelector('.medication-list') || document.querySelector('ul:nth-of-type(1)');
            const li = document.createElement('li');
            li.className = "flex justify-between items-center py-3 border-b border-blue-50";
            li.dataset.id = newMed.id;
            
            li.innerHTML = `
              <div class="flex flex-col">
                <span class="font-medium">${newMed.name}</span>
                <span class="text-sm text-gray-500">${newMed.time}</span>
              </div>
              <span class="px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium medication-status">
                Upcoming
              </span>
            `;
            
            medList.appendChild(li);
            
            // Add click event to mark as taken
            li.addEventListener('click', function() {
              const medId = parseInt(this.dataset.id);
              const med = medications.find(m => m.id === medId);
              if (med) {
                med.taken = !med.taken;
                med.status = med.taken ? "completed" : "pending";
                
                const statusEl = this.querySelector('.medication-status');
                if (med.taken) {
                  statusEl.textContent = "Completed";
                  statusEl.className = "px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium medication-status";
                } else {
                  statusEl.textContent = "Upcoming";
                  statusEl.className = "px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium medication-status";
                }
              }
            });
            
            // Set up notification
            scheduleNotification(newMed.name, newMed.time);
          });
          
          // Add new fitness goal functionality
          const addFitnessBtn = document.querySelector('#add-fitness');
          addFitnessBtn.addEventListener('click', function() {
            const fitnessName = prompt("Enter fitness activity:");
            if (!fitnessName) return;
            
            const fitnessDuration = prompt("Enter duration (in minutes):");
            if (!fitnessDuration) return;
            
            const fitnessTime = prompt("Enter time (e.g. 3:00 PM):");
            if (!fitnessTime) return;
            
            const newFitness = {
              id: fitnessGoals.length + 1,
              name: fitnessName,
              details: `${fitnessDuration} minutes, ${fitnessTime}`,
              status: "pending",
              completed: false
            };
            
            fitnessGoals.push(newFitness);
            
            // Create and append new fitness item
            const fitnessList = document.querySelector('.fitness-list') || document.querySelector('#fitness-listul');
            const li = document.createElement('li');
            li.className = "flex justify-between items-center py-3 border-b border-blue-50";
            li.dataset.id = newFitness.id;
            
            li.innerHTML = `
              <div class="flex flex-col">
                <span class="font-medium">${newFitness.name}</span>
                <span class="text-sm text-gray-500">${newFitness.details}</span>
              </div>
              <span class="px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium fitness-status">
                Upcoming
              </span>
            `;
            
            fitnessList.appendChild(li);
            
            // Add click event to mark as completed
            li.addEventListener('click', function() {
              const fitnessId = parseInt(this.dataset.id);
              const fitness = fitnessGoals.find(f => f.id === fitnessId);
              if (fitness) {
                fitness.completed = !fitness.completed;
                fitness.status = fitness.completed ? "completed" : "pending";
                
                const statusEl = this.querySelector('.fitness-status');
                if (fitness.completed) {
                  statusEl.textContent = "Completed";
                  statusEl.className = "px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium fitness-status";
                } else {
                  statusEl.textContent = "Upcoming";
                  statusEl.className = "px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium fitness-status";
                }
              }
            });
            
            // Set up notification
            scheduleNotification(`Fitness: ${newFitness.name}`, fitnessTime);
          });
          
          // Add click functionality to existing medication items
          document.querySelectorAll('.medication-list li, ul:nth-of-type(1) li').forEach((li, index) => {
            li.dataset.id = medications[index].id;
            li.addEventListener('click', function() {
              const medId = parseInt(this.dataset.id);
              const med = medications.find(m => m.id === medId);
              if (med) {
                med.taken = !med.taken;
                med.status = med.taken ? "completed" : "pending";
                
                const statusEl = this.querySelector('.med-status') || this.querySelector('[class*="status"]');
                if (med.taken) {
                  statusEl.textContent = "Completed";
                  statusEl.className = "px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium medication-status";
                } else {
                  statusEl.textContent = "Upcoming";
                  statusEl.className = "px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium medication-status";
                }
              }
            });
          });
          
          // Add click functionality to existing fitness items
          document.querySelectorAll('.fitness-list li, ul:nth-of-type(2) li').forEach((li, index) => {
            li.dataset.id = fitnessGoals[index].id;
            li.addEventListener('click', function() {
              const fitnessId = parseInt(this.dataset.id);
              const fitness = fitnessGoals.find(f => f.id === fitnessId);
              if (fitness) {
                fitness.completed = !fitness.completed;
                fitness.status = fitness.completed ? "completed" : "pending";
                
                const statusEl = this.querySelector('.fitness-status') || this.querySelector('[class*="status"]');
                if (fitness.completed) {
                  statusEl.textContent = "Completed";
                  statusEl.className = "px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium fitness-status";
                } else {
                  statusEl.textContent = "Upcoming";
                  statusEl.className = "px-3 py-1 bg-primary-light text-primary rounded-full text-xs font-medium fitness-status";
                }
              }
            });
          });
          
          // Function to schedule notifications
          function scheduleNotification(title, timeStr) {
            // Parse the time string to get hours and minutes
            let [time, period] = timeStr.split(' ');
            let [hours, minutes] = time.split(':').map(Number);
            
            if (period === 'PM' && hours < 12) {
              hours += 12;
            } else if (period === 'AM' && hours === 12) {
              hours = 0;
            }
            
            // Get current date
            const now = new Date();
            const notificationTime = new Date(
              now.getFullYear(),
              now.getMonth(),
              now.getDate(),
              hours,
              minutes
            );
            
            // If the time has already passed today, schedule for tomorrow
            if (notificationTime < now) {
              notificationTime.setDate(notificationTime.getDate() + 1);
            }
            
            // Calculate ms until notification time
            const msUntilNotification = notificationTime - now;
            
            // Schedule notification
            setTimeout(() => {
              // Check if browser supports notifications
              if ("Notification" in window) {
                if (Notification.permission === "granted") {
                  new Notification(`Health Reminder: ${title}`, {
                    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966334.png',
                    body: `It's time for your scheduled activity: ${title}`
                  });
                } else if (Notification.permission !== "denied") {
                  Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                      new Notification(`Health Reminder: ${title}`, {
                        icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966334.png',
                        body: `It's time for your scheduled activity: ${title}`
                      });
                    }
                  });
                }
              }
              
              // Fallback alert if notifications not available
              alert(`Health Reminder: It's time for ${title}`);
            }, msUntilNotification);
            
            console.log(`Notification for "${title}" scheduled at ${timeStr} (in ${Math.round(msUntilNotification/60000)} minutes)`);
          }
          
          // Auto-check if any medications/activities are due
          function checkSchedule() {
            const now = getCurrentDateTime();
            const currentTimeStr = now.time;
            
            medications.forEach(med => {
              if (!med.taken && timeCompare(med.time, currentTimeStr)) {
                // Create notification
                if (Notification.permission === "granted") {
                  new Notification(`Medication Reminder`, {
                    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966334.png',
                    body: `It's time to take your ${med.name}`
                  });
                }
              }
            });
            
            fitnessGoals.forEach(fitness => {
              if (!fitness.completed && fitness.details.includes(currentTimeStr)) {
                // Create notification
                if (Notification.permission === "granted") {
                  new Notification(`Fitness Reminder`, {
                    icon: 'https://cdn-icons-png.flaticon.com/512/2966/2966334.png',
                    body: `Time for your ${fitness.name} session`
                  });
                }
              }
            });
            
            // Helper function to compare times
            function timeCompare(time1, time2) {
              const t1 = new Date(`1/1/2000 ${time1}`);
              const t2 = new Date(`1/1/2000 ${time2}`);
              
              // Return true if times are within 5 minutes of each other
              return Math.abs(t1 - t2) < 300000; // 5 minutes in milliseconds
            }
          }
          
          // Request notification permission
          if ("Notification" in window) {
            Notification.requestPermission();
          }
          
          // Check schedule every minute
          setInterval(checkSchedule, 60000);
          
          // Initial check
          checkSchedule();
        });
      </script>
  </body>
</html>
