
<?php  
require_once 'appointmentdb.php';

if (isset($_POST['register'])) {
    $specialty = $_POST['specialty'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date']; // ✅ renamed to match DB
    $appointment_time = $_POST['appointment_time'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO appointments (specialty, doctor_id, appointment_date, appointment_time, notes) 
            VALUES ('$specialty', '$doctor_id', '$appointment_date', '$appointment_time', '$notes')";

    $data = mysqli_query($conn, $sql);

    // if($data){
    //     echo "✅ Appointment booked successfully!";
    // } else {
    //     echo "❌ Failed to book appointment: " . mysqli_error($conn);
    // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar-icon {
            transition: color 0.3s;
        }
        .sidebar-icon:hover {
            color: #8b5cf6;
        }
        /* Removed hover transform effects */
        .calendar-day {
            width: 14.28%;
        }
        .appointment-indicator {
            width: 4px;
            height: 4px;
            background-color: #3b82f6;
            border-radius: 50%;
            margin: 2px auto 0;
          }
    </style>
</head>
<body class="bg-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Left Sidebar -->
        <div class="hidden sm:flex flex-col h-full py-4 sm:py-6 justify-between w-12 sm:w-16 items-center border-2 border-blue-200 bg-white fixed left-0 top-0 bottom-0">
            <a href="nit.php"><i class="fa-solid fa-heart-pulse text-2xl sm:text-3xl cursor-pointer text-[#f06419] hover:scale-110 transition-transform"></i></a>
            <a href="nit.php"><i class="fa-solid fa-house text-2xl sm:text-3xl cursor-pointer text-[#63E6BE] hover:scale-110 transition-transform"></i></a>
            <a href="appointment.php"><i class="fa-solid fa-calendar-days text-2xl sm:text-3xl cursor-pointer hover:scale-110 transition-transform"></i></a>
            <a href="runner.php"><i class="fa-solid fa-person-running text-2xl sm:text-3xl cursor-pointer hover:scale-110 transition-transform"></i></a>
            <a href="profile.html"><i class="fa-solid fa-user text-2xl sm:text-3xl cursor-pointer hover:scale-110 transition-transform"></i></a>
            <a href=""><i class="fa-solid fa-door-open text-2xl sm:text-3xl cursor-pointer hover:scale-110 transition-transform"></i></a>
        </div>
        

        <!-- Spacer div to account for fixed sidebar -->
        <div class="hidden sm:block w-20 flex-shrink-0"></div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-y-auto">
            <div class="container mx-auto px-4 py-6">
                <!-- Top Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Appointments Card -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-purple-200 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="far fa-calendar-check text-purple-500 text-xl"></i>
                                </div>
                                <h2 class="text-xl font-semibold">Appointments</h2>
                            </div>
                            <div class="flex flex-col items-center justify-center h-40 mb-6">
                                <div class="text-center mb-4">Take Appointment</div>
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-briefcase-medical text-gray-500 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        <button class="w-full py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                            Appointment
                        </button>
                    </div>
                
                    <!-- Call Consultancy Card -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-red-200 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-phone-alt text-red-500 text-xl"></i>
                                </div>
                                <h2 class="text-xl font-semibold">Call Consultancy</h2>
                            </div>
                            <div class="flex flex-col items-center justify-center h-40 mb-6">
                                <div class="text-center mb-2">Schedule</div>
                                <div class="text-center mb-2">4:00 PM</div>
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-gray-500 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        <button class="w-full py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                            Call
                        </button>
                    </div>
                
                    <!-- Medical Condition Card -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-gray-300 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-lungs text-green-500 text-xl"></i>
                                </div>
                                <h2 class="text-xl font-semibold">Medical Condition</h2>
                            </div>
                            <div class="flex flex-col items-center justify-center h-40 mb-6">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="far fa-heart text-gray-400 text-4xl"></i>
                                </div>
                                <div class="text-center mt-2">Normal</div>
                            </div>
                        </div>
                        <button class="w-full py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                            Action
                        </button>
                    </div>
                </div>
                
                <!-- Health Records Section -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm mb-8">
                    <h2 class="text-xl font-bold mb-6">Health Records</h2>
                    
                    <div class="flex flex-wrap gap-3 mb-6">
                      <button class="px-5 py-2 bg-purple-600 text-white rounded-full category-btn" data-category="heart">Heart</button>
                      <button class="px-5 py-2 bg-purple-500 text-white rounded-full category-btn" data-category="brain">Brain</button>
                      <button class="px-5 py-2 bg-purple-500 text-white rounded-full category-btn" data-category="kidney">Kidney</button>
                      <button class="px-5 py-2 bg-purple-500 text-white rounded-full category-btn" data-category="eyes">Eyes</button>
                    </div>
                    
                    <!-- Heart Content -->
                    <div class="category-content" id="heart-content">
                      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Heart Image -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                          <img src="img/heart.png" alt="Heart Illustration" class="w-full h-auto rounded" />
                        </div>
                        
                        <!-- Medical Reports -->
                        <div class="space-y-4">
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">CT Scan</div>
                            <img src="img/ct-scan.png" alt="CT Scan" class="w-full h-auto rounded" />
                          </div>
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">ECG</div>
                            <img src="img/ecg.png" alt="ECG" class="w-full h-auto rounded" />
                          </div>
                        </div>
                        
                        <!-- Heart Rate Chart -->
                        <div class="col-span-1 md:col-span-2">
                          <div class="bg-white border border-gray-200 rounded-lg p-3 h-full">
                            <div class="text-sm font-semibold mb-2">Heart Rate</div>
                            <img src="img/pulse.png" alt="Heart Rate Chart" class="w-full h-auto rounded" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- Health Metrics -->
                      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Blood Pressure</h3>
                          <p class="text-lg font-bold">130/90 mm Hg</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Pulse</h3>
                          <p class="text-lg font-bold">81 beats/min</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Oxygen</h3>
                          <p class="text-lg font-bold">93%</p>
                        </div>
                        
                        <!-- <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Foods to Avoid</h3>
                          <img src="/api/placeholder/150/80" alt="Unhealthy Foods" class="w-full h-auto rounded mt-1" />
                        </div> -->
                      </div>
                    </div>
                    
                    <!-- Brain Content -->
                    <div class="category-content hidden" id="brain-content">
                      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Brain Image -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                          <img src="img/brain.png" alt="Brain Illustration" class="w-full h-auto rounded" />
                        </div>
                        
                        <!-- Medical Reports -->
                        <div class="space-y-4">
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">MRI</div>
                            <img src="img/mri.png" alt="MRI" class="w-full h-auto rounded" />
                          </div>
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">EEG</div>
                            <img src="img/eeg.png" alt="EEG" class="w-full h-auto rounded" />
                          </div>
                        </div>
                        
                        <!-- Brain Activity Chart -->
                        <div class="col-span-1 md:col-span-2">
                          <div class="bg-white border border-gray-200 rounded-lg p-3 h-full">
                            <div class="text-sm font-semibold mb-2">Brain Activity</div>
                            <img src="img/brain-activity.png" alt="Brain Activity Chart" class="w-full h-auto rounded" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- Health Metrics -->
                      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Cognitive Health</h3>
                          <p class="text-lg font-bold">Excellent</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Memory</h3>
                          <p class="text-lg font-bold">98%</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Stress Level</h3>
                          <p class="text-lg font-bold">Low</p>
                        </div>
                        
                        <!-- <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Brain Boosting Foods</h3>
                          <img src="/api/placeholder/150/80" alt="Brain Foods" class="w-full h-auto rounded mt-1" />
                        </div> -->
                      </div>
                    </div>
                    
                    <!-- Kidney Content -->
                    <div class="category-content hidden" id="kidney-content">
                      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Kidney Image -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                          <img src="img/kidney2.png" alt="Kidney Illustration" class="w-full h-auto rounded" />
                        </div>
                        
                        <!-- Medical Reports -->
                        <div class="space-y-4">
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">Ultrasound</div>
                            <img src="img/ultrasound.png" alt="Ultrasound" class="w-full h-auto rounded" />
                          </div>
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">Creatinine Test</div>
                            <img src="img/kidney (1).png" alt="Creatinine Test" class="w-full h-auto rounded" />
                          </div>
                        </div>
                        
                        <!-- Kidney Function Chart -->
                        <div class="col-span-1 md:col-span-2">
                          <div class="bg-white border border-gray-200 rounded-lg p-3 h-full">
                            <div class="text-sm font-semibold mb-2">Kidney Function</div>
                            <img src="img/kidney.png" alt="Kidney Function Chart" class="w-full h-auto rounded" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- Health Metrics -->
                      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Creatinine</h3>
                          <p class="text-lg font-bold">0.9 mg/dL</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">GFR</h3>
                          <p class="text-lg font-bold">92 mL/min</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">BUN</h3>
                          <p class="text-lg font-bold">15 mg/dL</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Hydration Status</h3>
                          <p class="text-lg font-bold">Good</p>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Eyes Content -->
                    <div class="category-content hidden" id="eyes-content">
                      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Eyes Image -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                          <img src="img/eye.png" alt="Eyes Illustration" class="w-full h-auto rounded" />
                        </div>
                        
                        <!-- Medical Reports -->
                        <div class="space-y-4">
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">Retinal Scan</div>
                            <img src="img/eye-scan.png" alt="Retinal Scan" class="w-full h-auto rounded" />
                          </div>
                          <div class="bg-white border border-gray-200 rounded-lg p-3">
                            <div class="text-sm font-semibold mb-2">Visual Acuity</div>
                            <img src="img/gallery.png" alt="Visual Acuity" class="w-full h-auto rounded" />
                          </div>
                        </div>
                        
                        <!-- Eye Health Chart -->
                        <div class="col-span-1 md:col-span-2">
                          <div class="bg-white border border-gray-200 rounded-lg p-3 h-full">
                            <div class="text-sm font-semibold mb-2">Eye Pressure</div>
                            <img src="img/pressure.png" alt="Eye Pressure Chart" class="w-full h-auto rounded" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- Health Metrics -->
                      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Visual Acuity</h3>
                          <p class="text-lg font-bold">20/20</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Intraocular Pressure</h3>
                          <p class="text-lg font-bold">14 mmHg</p>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Color Vision</h3>
                          <p class="text-lg font-bold">Normal</p>
                        </div>
                        
                        <!-- <div class="bg-white border border-gray-200 rounded-lg p-4">
                          <h3 class="text-gray-500 text-sm mb-1">Eye Health Tips</h3>
                          <img src="/api/placeholder/150/80" alt="Eye Health Tips" class="w-full h-auto rounded mt-1" />
                        </div> -->
                      </div>
                    </div>
                </div>
                  
            </div>
        </div>
        
        <!-- Right Calendar Sidebar -->
        <div class="hidden lg:block w-80 bg-gray-100 p-4 overflow-y-auto">
            <div class="bg-gray-800 text-white rounded-t-lg p-4">
                <h2 class="text-xl font-bold mb-3">APPOINTMENT</h2>
                
                <div class="flex justify-between items-center">
                    <div class="text-lg">Calendar</div>
                    <select class="bg-gray-700 text-white rounded px-2 py-1 text-sm">
                        <option>2025</option>
                        <option>2024</option>
                    </select>
                </div>
            </div>
            
            <!-- Calendar View -->
            <div class="bg-black text-white p-4 rounded-b-lg mb-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">April 2025</h3>
                    <div class="flex space-x-2">
                        <button class="text-gray-400 hover:text-white" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                        <button class="text-gray-400 hover:text-white" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                
                <div class="flex text-xs text-gray-400 mb-2">
                    <div class="calendar-day text-center">Sun</div>
                    <div class="calendar-day text-center">Mon</div>
                    <div class="calendar-day text-center">Tue</div>
                    <div class="calendar-day text-center">Wed</div>
                    <div class="calendar-day text-center">Thu</div>
                    <div class="calendar-day text-center">Fri</div>
                    <div class="calendar-day text-center">Sat</div>
                </div>
                
                <!-- Calendar grid -->
                <div class="grid grid-cols-7 gap-1 mb-4" id="calendarGrid">
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
                
                <h3 class="text-lg font-bold mt-6 mb-4">Today's Appointments</h3>
                
                <div class="space-y-3">
                    <!-- Appointment 1 -->
                    <div class="bg-gray-800 rounded p-3 border-l-4 border-yellow-500">
                        <div class="flex items-center gap-3">
                            <div class="text-yellow-500">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <div>
                                <div class="font-medium">Rachel Greene</div>
                                <div class="text-xs text-gray-400">9:00 AM</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Appointment 2 -->
                    <div class="bg-gray-800 rounded p-3 border-l-4 border-green-500">
                        <div class="flex items-center gap-3">
                            <div class="text-green-500">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <div>
                                <div class="font-medium">John Doe</div>
                                <div class="text-xs text-gray-400">11:30 AM</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Appointment 3 -->
                    <div class="bg-gray-800 rounded p-3 border-l-4 border-purple-500">
                        <div class="flex items-center gap-3">
                            <div class="text-purple-500">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <div>
                                <div class="font-medium">Ben Affleck</div>
                                <div class="text-xs text-gray-400">2:15 PM</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Appointment 4 -->
                    <div class="bg-gray-800 rounded p-3 border-l-4 border-red-500">
                        <div class="flex items-center gap-3">
                            <div class="text-red-500">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <div>
                                <div class="font-medium">Karina</div>
                                <div class="text-xs text-gray-400">4:30 PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Patient Quick Access -->
            <div class="space-y-3">
                <div class="bg-gray-300 p-3 rounded flex items-center gap-3">
                    <div class="text-yellow-500">
                        <i class="fas fa-user-circle text-xl"></i>
                    </div>
                    <div class="font-medium">Rachel Greene</div>
                </div>
                
                <div class="bg-gray-300 p-3 rounded flex items-center gap-3">
                    <div class="text-green-500">
                        <i class="fas fa-user-circle text-xl"></i>
                    </div>
                    <div class="font-medium">John Doe</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add this modal HTML code right before the closing </body> tag -->
<div id="appointmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-lg w-full max-w-md p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Book an Appointment</h2>
      <button id="closeModal" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <form action="#" method="POST" id="appointmentForm">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="specialty">
          Specialty
        </label>
        <select name="specialty" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" id="specialty" required>
          <option value="">Select a specialty</option>
          <option value="heart">Heart</option>
          <option value="brain">Brain</option>
          <option value="kidney">Kidney</option>
          <option value="eyes">Eyes</option>
          <option value="general">General</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="doctor">
          Doctor
        </label>
        <select name="doctor_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" id="doctor" required>
          <option name="doctor" value="">Select a specialty first</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
          Date
        </label>
        <input name="appointment_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" id="date" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="time">
          Time Slot
        </label>
        <select name="appointment_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" id="time" required>
          <option name="appointment_time" value="">Select a time slot</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
          Notes (Optional)
        </label>
        <textarea name="notes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" id="notes" rows="3"></textarea>
      </div>
      
      <div class="flex justify-end">
        <button type="button" id="cancelAppointment" class="px-4 py-2 mr-2 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
          Cancel
        </button>
        <button name="register" type="submit" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition-colors">
          Book Appointment
        </button>
      </div>
    </form>
  </div>
</div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle active state on sidebar icons
        const sidebarIcons = document.querySelectorAll('.sidebar-icon');
        sidebarIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                sidebarIcons.forEach(i => i.classList.remove('bg-purple-100'));
                this.classList.add('bg-purple-100');
            });
        });
        
        // Category button active states
        const categoryButtons = document.querySelectorAll('.flex.flex-wrap.gap-3 button');
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                categoryButtons.forEach(b => b.classList.remove('bg-purple-600'));
                this.classList.add('bg-purple-600');
            });
        });
        
        // Calendar functionality
        const calendarGrid = document.getElementById('calendarGrid');
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        
        function generateCalendar(month, year) {
            // Clear previous calendar
            calendarGrid.innerHTML = '';
            
            // Update month/year display
            document.querySelector('.flex.justify-between.items-center h3').textContent = 
                new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });
            
            // Get first day of the month
            const firstDay = new Date(year, month, 1).getDay();
            
            // Get number of days in month
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            // Create empty cells for days before the first day of month
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'text-center py-1 text-xs text-gray-600';
                calendarGrid.appendChild(emptyDay);
            }
            
            // Create cells for each day of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'text-center py-1 text-xs';
                
                // Highlight current day
                if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                    dayCell.className += ' bg-purple-500 rounded-full';
                }
                
                dayCell.textContent = day;
                calendarGrid.appendChild(dayCell);
                
                // Make days clickable
                dayCell.addEventListener('click', function() {
                    // Remove highlight from all days
                    document.querySelectorAll('#calendarGrid div').forEach(cell => {
                        cell.classList.remove('bg-purple-500', 'rounded-full');
                    });
                    
                    // Highlight selected day
                    this.classList.add('bg-purple-500', 'rounded-full');
                });
            }
        }
        
        // Initialize calendar
        generateCalendar(currentMonth, currentYear);
        
        // Previous month button
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
        });
        
        // Next month button
        document.getElementById('nextMonth').addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
        });
        
        // Initialize the first category button as active
        if (categoryButtons.length > 0) {
            categoryButtons[0].classList.add('bg-purple-600');
        }
    
        // Get all category buttons and content sections
        const categoryContentButtons = document.querySelectorAll('.category-btn');
        const categoryContents = document.querySelectorAll('.category-content');
        
        // Add click event listeners to each button
        categoryContentButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the category from the data attribute
                const category = this.dataset.category;
                
                // Remove active class from all buttons and add to clicked button
                categoryContentButtons.forEach(btn => {
                    btn.classList.remove('bg-purple-600');
                    btn.classList.add('bg-purple-500');
                });
                this.classList.remove('bg-purple-500');
                this.classList.add('bg-purple-600');
                
                // Hide all content sections
                categoryContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show the selected content section
                document.getElementById(`${category}-content`).classList.remove('hidden');
            });
        });
    
        // Find appointment buttons and add event listeners
        const allButtons = document.querySelectorAll('button');
        allButtons.forEach(button => {
            if (button.textContent.trim() === 'Appointment') {
                button.addEventListener('click', function() {
                    // Show the modal
                    const appointmentModal = document.getElementById('appointmentModal');
                    if (appointmentModal) {
                        appointmentModal.classList.remove('hidden');
                        
                        // Set default date to today
                        const today = new Date();
                        const yyyy = today.getFullYear();
                        const mm = String(today.getMonth() + 1).padStart(2, '0');
                        const dd = String(today.getDate()).padStart(2, '0');
                        
                        const dateInput = document.getElementById('date');
                        if (dateInput) {
                            dateInput.value = `${yyyy}-${mm}-${dd}`;
                            dateInput.min = `${yyyy}-${mm}-${dd}`; // Prevent selecting past dates
                        }
                        
                        // Update time slots
                        updateTimeSlots();
                    }
                });
            }
        });
        
        // Make sure the close button and cancel button work
        const closeModal = document.getElementById('closeModal');
        const cancelAppointment = document.getElementById('cancelAppointment');
        
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                document.getElementById('appointmentModal').classList.add('hidden');
            });
        }
        
        if (cancelAppointment) {
            cancelAppointment.addEventListener('click', function() {
                document.getElementById('appointmentModal').classList.add('hidden');
            });
        }
        
        // Initialize specialty select change event
        const specialtySelect = document.getElementById('specialty');
        if (specialtySelect) {
            specialtySelect.addEventListener('change', updateDoctors);
        }
        
        // Initialize form submission handler
        const appointmentForm = document.getElementById('appointmentForm');
        // if (appointmentForm) {
        //     appointmentForm.addEventListener('submit', handleAppointmentSubmission);
        // }
        
        // Remove static patient entries
        const patientQuickAccessDiv = document.querySelector('.space-y-3');
        if (patientQuickAccessDiv && patientQuickAccessDiv.children.length > 0) {
            patientQuickAccessDiv.innerHTML = ''; // Clear static patient entries
        }
    });
    
    // Function to update time slots
    function updateTimeSlots() {
        const timeSelect = document.getElementById('time');
        
        if (!timeSelect) return;
        
        timeSelect.innerHTML = '<option value="">Select a time slot</option>';
        
        // Generate time slots from 8 AM to 7 PM with 1 hour gap
        for (let hour = 8; hour <= 19; hour++) {
            const formattedHour = hour.toString().padStart(2, '0');
            const option = document.createElement('option');
            option.value = `${formattedHour}:00`;
            
            // Format display text in 12-hour format
            let displayHour = hour;
            let amPm = 'AM';
            
            if (hour >= 12) {
                amPm = 'PM';
                if (hour > 12) displayHour = hour - 12;
            }
            
            option.textContent = `${displayHour}:00 ${amPm}`;
            timeSelect.appendChild(option);
        }
    }
    
    // Function to update doctors when specialty changes
    function updateDoctors() {
        const specialtySelect = document.getElementById('specialty');
        const doctorSelect = document.getElementById('doctor');
        
        if (!specialtySelect || !doctorSelect) return;
        
        const specialty = specialtySelect.value;
        doctorSelect.innerHTML = '<option value="">Select a doctor</option>';
        
        // Define all doctors by specialty
        const doctors = {
            heart: [
                { id: 1, name: "Dr. Camille Johnson" },
                { id: 2, name: "Dr. Marcus Chen" },
                { id: 11, name: "Dr. Robert Williams" }
            ],
            brain: [
                { id: 3, name: "Dr. Amelia Richards" },
                { id: 4, name: "Dr. Ethan Williams" },
                { id: 12, name: "Dr. Patricia Moore" }
            ],
            kidney: [
                { id: 5, name: "Dr. Olivia Martinez" },
                { id: 6, name: "Dr. Noah Thompson" },
                { id: 13, name: "Dr. Michael Davis" }
            ],
            eyes: [
                { id: 7, name: "Dr. Sophia Lee" },
                { id: 8, name: "Dr. Benjamin Wilson" },
                { id: 14, name: "Dr. Elizabeth Taylor" }
            ],
            general: [
                { id: 9, name: "Dr. Isabella Garcia" },
                { id: 10, name: "Dr. James Smith" },
                { id: 15, name: "Dr. Thomas Brown" }
            ]
        };
        
        // Populate doctors based on selected specialty
        if (doctors[specialty]) {
            doctors[specialty].forEach(doctor => {
                const option = document.createElement('option');
                option.value = doctor.id;
                option.textContent = doctor.name;
                doctorSelect.appendChild(option);
            });
        }
    }
    
    // Function to handle appointment form submission
    function handleAppointmentSubmission(e) {
        e.preventDefault();
        
        // Get form values
        const specialty = document.getElementById('specialty').value;
        const doctorId = document.getElementById('doctor').value;
        const doctorName = document.getElementById('doctor').options[document.getElementById('doctor').selectedIndex].text;
        const date = document.getElementById('date').value;
        const timeValue = document.getElementById('time').value;
        const timeText = document.getElementById('time').options[document.getElementById('time').selectedIndex].text;
        const notes = document.getElementById('notes').value;
        
        // Create a new appointment element
        const appointmentDiv = document.createElement('div');
        
        // Generate random color for the appointment
        const colors = ['yellow', 'green', 'purple', 'red', 'blue'];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];
        appointmentDiv.className = `bg-gray-800 rounded p-3 border-l-4 border-${randomColor}-500 mb-3`;
        
        // Create the inner HTML structure
        appointmentDiv.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="text-${randomColor}-500">
                    <i class="fas fa-user-circle text-xl"></i>
                </div>
                <div>
                    <div class="font-medium">${doctorName}</div>
                    <div class="text-xs text-gray-400">${timeText}</div>
                    <div class="text-xs text-gray-400">${specialty} appointment</div>
                </div>
            </div>
        `;
        
        // Find the today's appointments container and add the new appointment
        const appointmentsHeader = document.querySelector('h3.text-lg.font-bold.mt-6.mb-4');
        if (appointmentsHeader) {
            const appointmentsContainer = appointmentsHeader.nextElementSibling;
            if (appointmentsContainer) {
                appointmentsContainer.appendChild(appointmentDiv);
            }
        }
        
        // Also add to patient quick access if not already there
        addToPatientQuickAccess(doctorName, randomColor);
        
        // Update the calendar to highlight the selected day
        updateCalendarWithAppointment(date);
        
        // Close the modal
        document.getElementById('appointmentModal').classList.add('hidden');
        
        // Show success message
        alert('Appointment booked successfully!');
        
        // Reset the form
        document.getElementById('appointmentForm').reset();
    }
    
    // Function to add doctor to the quick access sidebar
    function addToPatientQuickAccess(doctorName, color) {
        const patientQuickAccessDiv = document.querySelector('.space-y-3');
        if (!patientQuickAccessDiv) return;
        
        // Check if this doctor is already in the quick access
        const existingEntries = patientQuickAccessDiv.querySelectorAll('.font-medium');
        for (let entry of existingEntries) {
            if (entry.textContent.trim() === doctorName) {
                return; // Doctor already in quick access
            }
        }
        
        // Create new quick access entry
        const quickAccessEntry = document.createElement('div');
        quickAccessEntry.className = 'bg-gray-300 p-3 rounded flex items-center gap-3';
        quickAccessEntry.innerHTML = `
            <div class="text-${color}-500">
                <i class="fas fa-user-circle text-xl"></i>
            </div>
            <div class="font-medium">${doctorName}</div>
        `;
        
        patientQuickAccessDiv.appendChild(quickAccessEntry);
    }
    
    // Function to highlight days with appointments in the calendar
    function updateCalendarWithAppointment(dateString) {
        const appointmentDate = new Date(dateString);
        const day = appointmentDate.getDate();
        const month = appointmentDate.getMonth();
        const year = appointmentDate.getFullYear();
        
        // Only update if the appointment is in the currently displayed month
        const currentMonthElement = document.querySelector('.flex.justify-between.items-center h3');
        const currentMonthText = currentMonthElement.textContent;
        const [monthName, yearText] = currentMonthText.split(' ');
        
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const currentMonth = months.indexOf(monthName);
        const currentYear = parseInt(yearText);
        
        if (month === currentMonth && year === currentYear) {
            // Find the day cell in the calendar
            const calendarCells = document.querySelectorAll('#calendarGrid div');
            
            // Skip empty cells at the beginning and find the matching day
            const firstDay = new Date(year, month, 1).getDay();
            const targetCellIndex = firstDay + day - 1;
            
            if (targetCellIndex >= firstDay && targetCellIndex < calendarCells.length) {
                // Get the target cell
                const targetCell = calendarCells[targetCellIndex];
                
                // Add or update appointment indicator
                let indicator = targetCell.querySelector('.appointment-indicator');
                
                if (!indicator) {
                    // Create a new indicator dot
                    indicator = document.createElement('div');
                    indicator.className = 'appointment-indicator';
                    targetCell.appendChild(indicator);
                }
            }
        }
    }
   </script>
</body>
</html>


