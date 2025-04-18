function updateDate() {
  const now = new Date();
  const formattedDate = now.toLocaleDateString(); // Shows only Date
  document.getElementById("currentTime").textContent = formattedDate;
}

updateDate(); // Initial call
setInterval(updateDate, 86400000); // Update every 24 hours (1 day)

document.addEventListener('DOMContentLoaded', function() {
  // Get BMI elements
  const bmiTabBtn = document.getElementById('bmi-tab-btn');
  const measurementsTabBtn = document.getElementById('measurements-tab-btn');
  const bmiSection = document.getElementById('bmi-section');
  const measurementsSection = document.getElementById('measurements-section');
  
  const metricBtn = document.getElementById('metric-btn');
  const imperialBtn = document.getElementById('imperial-btn');
  const metricForm = document.getElementById('metric-form');
  const imperialForm = document.getElementById('imperial-form');
  const calculateBtn = document.getElementById('calculate-btn');
  const resultDiv = document.getElementById('result');
  const bmiValue = document.getElementById('bmi-value');
  const bmiCategory = document.getElementById('bmi-category');
  const bmiDescription = document.getElementById('bmi-description');
  
  // Get measurements elements
  const cmBtn = document.getElementById('cm-btn');
  const inchBtn = document.getElementById('inch-btn');
  const saveMeasurementsBtn = document.getElementById('save-measurements-btn');
  const currentDate = document.getElementById('current-date');
  const currentChest = document.getElementById('current-chest');
  const currentWaist = document.getElementById('current-waist');
  const currentHip = document.getElementById('current-hip');
  
  let activeUnit = 'metric';
  let measurementUnit = 'cm';
  
  // Tab switching
  bmiTabBtn.addEventListener('click', function() {
      bmiTabBtn.classList.add('bg-blue-500', 'text-white');
      bmiTabBtn.classList.remove('text-gray-700');
      measurementsTabBtn.classList.remove('bg-blue-500', 'text-white');
      measurementsTabBtn.classList.add('text-gray-700');
      
      bmiSection.classList.remove('hidden');
      measurementsSection.classList.add('hidden');
  });
  
  measurementsTabBtn.addEventListener('click', function() {
      measurementsTabBtn.classList.add('bg-blue-500', 'text-white');
      measurementsTabBtn.classList.remove('text-gray-700');
      bmiTabBtn.classList.remove('bg-blue-500', 'text-white');
      bmiTabBtn.classList.add('text-gray-700');
      
      measurementsSection.classList.remove('hidden');
      bmiSection.classList.add('hidden');
  });
  
  // BMI unit switching
  metricBtn.addEventListener('click', function() {
      activeUnit = 'metric';
      metricBtn.classList.add('bg-blue-500', 'text-white');
      metricBtn.classList.remove('text-gray-700');
      imperialBtn.classList.remove('bg-blue-500', 'text-white');
      imperialBtn.classList.add('text-gray-700');
      
      metricForm.classList.remove('hidden');
      imperialForm.classList.add('hidden');
      resultDiv.classList.add('hidden');
  });
  
  imperialBtn.addEventListener('click', function() {
      activeUnit = 'imperial';
      imperialBtn.classList.add('bg-blue-500', 'text-white');
      imperialBtn.classList.remove('text-gray-700');
      metricBtn.classList.remove('bg-blue-500', 'text-white');
      metricBtn.classList.add('text-gray-700');
      
      imperialForm.classList.remove('hidden');
      metricForm.classList.add('hidden');
      resultDiv.classList.add('hidden');
  });
  
  // Measurement unit switching
  cmBtn.addEventListener('click', function() {
      measurementUnit = 'cm';
      cmBtn.classList.add('bg-blue-500', 'text-white');
      cmBtn.classList.remove('text-gray-700');
      inchBtn.classList.remove('bg-blue-500', 'text-white');
      inchBtn.classList.add('text-gray-700');
      
      document.getElementById('chest-size').placeholder = 'e.g., 95';
      document.getElementById('waist-size').placeholder = 'e.g., 80';
      document.getElementById('hip-size').placeholder = 'e.g., 100';
      
      // Convert existing values if needed
      convertMeasurements('in', 'cm');
  });
  
  inchBtn.addEventListener('click', function() {
      measurementUnit = 'in';
      inchBtn.classList.add('bg-blue-500', 'text-white');
      inchBtn.classList.remove('text-gray-700');
      cmBtn.classList.remove('bg-blue-500', 'text-white');
      cmBtn.classList.add('text-gray-700');
      
      document.getElementById('chest-size').placeholder = 'e.g., 37';
      document.getElementById('waist-size').placeholder = 'e.g., 31';
      document.getElementById('hip-size').placeholder = 'e.g., 39';
      
      // Convert existing values if needed
      convertMeasurements('cm', 'in');
  });
  
  function convertMeasurements(from, to) {
      const chestInput = document.getElementById('chest-size');
      const waistInput = document.getElementById('waist-size');
      const hipInput = document.getElementById('hip-size');
      
      if (chestInput.value) {
          if (from === 'cm' && to === 'in') {
              chestInput.value = (parseFloat(chestInput.value) / 2.54).toFixed(1);
          } else if (from === 'in' && to === 'cm') {
              chestInput.value = (parseFloat(chestInput.value) * 2.54).toFixed(1);
          }
      }
      
      if (waistInput.value) {
          if (from === 'cm' && to === 'in') {
              waistInput.value = (parseFloat(waistInput.value) / 2.54).toFixed(1);
          } else if (from === 'in' && to === 'cm') {
              waistInput.value = (parseFloat(waistInput.value) * 2.54).toFixed(1);
          }
      }
      
      if (hipInput.value) {
          if (from === 'cm' && to === 'in') {
              hipInput.value = (parseFloat(hipInput.value) / 2.54).toFixed(1);
          } else if (from === 'in' && to === 'cm') {
              hipInput.value = (parseFloat(hipInput.value) * 2.54).toFixed(1);
          }
      }
  }
  
  // Calculate BMI
  calculateBtn.addEventListener('click', function() {
      let bmi;
      let isValid = true;
      
      if (activeUnit === 'metric') {
          const height = parseFloat(document.getElementById('metric-height').value);
          const weight = parseFloat(document.getElementById('metric-weight').value);
          
          if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
              alert('Please enter valid height and weight values');
              isValid = false;
          } else {
              // BMI formula: weight (kg) / (height (m))²
              bmi = weight / Math.pow(height / 100, 2);
          }
      } else {
          const heightFt = parseFloat(document.getElementById('imperial-height-ft').value);
          const heightIn = parseFloat(document.getElementById('imperial-height-in').value);
          const weight = parseFloat(document.getElementById('imperial-weight').value);
          
          if (isNaN(heightFt) || isNaN(heightIn) || isNaN(weight) || 
              heightFt < 0 || heightIn < 0 || weight <= 0) {
              alert('Please enter valid height and weight values');
              isValid = false;
          } else {
              // Convert height to inches
              const totalInches = (heightFt * 12) + heightIn;
              // BMI formula for imperial: (weight (lbs) * 703) / (height (in))²
              bmi = (weight * 703) / Math.pow(totalInches, 2);
          }
      }
      
      if (isValid) {
          displayResult(bmi);
      }
  });
  
  function displayResult(bmi) {
      bmi = parseFloat(bmi.toFixed(1));
      bmiValue.textContent = bmi;
      
      resultDiv.classList.remove('hidden', 'bg-blue-100', 'bg-green-100', 'bg-yellow-100', 'bg-red-100');
      bmiCategory.classList.remove('text-blue-800', 'text-green-800', 'text-yellow-800', 'text-red-800');
      
      let category, description;
      
      if (bmi < 18.5) {
          category = 'Underweight';
          description = 'Your BMI suggests you are underweight. This may indicate nutritional deficiencies or other health issues. Consider consulting with a healthcare provider.';
          resultDiv.classList.add('bg-blue-100');
          bmiCategory.classList.add('text-blue-800');
      } else if (bmi >= 18.5 && bmi < 25) {
          category = 'Normal Weight';
          description = 'Your BMI is within the normal range. This suggests a healthy weight relative to your height. Maintain a balanced diet and regular physical activity.';
          resultDiv.classList.add('bg-green-100');
          bmiCategory.classList.add('text-green-800');
      } else if (bmi >= 25 && bmi < 30) {
          category = 'Overweight';
          description = 'Your BMI suggests you are overweight. Consider adopting healthier eating habits and increasing physical activity to reduce health risks.';
          resultDiv.classList.add('bg-yellow-100');
          bmiCategory.classList.add('text-yellow-800');
      } else {
          category = 'Obese';
          description = 'Your BMI indicates obesity, which is associated with increased health risks including heart disease and diabetes. Consider consulting with a healthcare provider for guidance.';
          resultDiv.classList.add('bg-red-100');
          bmiCategory.classList.add('text-red-800');
      }
      
      bmiCategory.textContent = category;
      bmiDescription.textContent = description;
      resultDiv.classList.remove('hidden');
  }
  
  // Save measurements
  saveMeasurementsBtn.addEventListener('click', function() {
      const chestSize = document.getElementById('chest-size').value;
      const waistSize = document.getElementById('waist-size').value;
      const hipSize = document.getElementById('hip-size').value;
      
      if (!chestSize && !waistSize && !hipSize) {
          alert('Please enter at least one measurement');
          return;
      }
      
      // Get current date
      const now = new Date();
      const dateString = now.toLocaleDateString();
      
      // Update displayed measurements
      currentDate.textContent = dateString;
      currentChest.textContent = chestSize ? `${chestSize} ${measurementUnit}` : '-';
      currentWaist.textContent = waistSize ? `${waistSize} ${measurementUnit}` : '-';
      currentHip.textContent = hipSize ? `${hipSize} ${measurementUnit}` : '-';
      
      // You could add code here to store the measurements in localStorage
      alert('Measurements saved!');
  });
});


// Exercise
document.addEventListener('DOMContentLoaded', function() {
  // Exercise data storage
  const exerciseTypes = ['Running', 'Cycling', 'Swimming', 'Jogging', 'Weight Training', 'Yoga', 'Other'];
  const colorMap = {
      'Running': {
          borderColor: 'rgb(59, 130, 246)', 
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
          bgClass: 'bg-blue-100'
      },
      'Cycling': {
          borderColor: 'rgb(16, 185, 129)', 
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          bgClass: 'bg-green-100'
      },
      'Swimming': {
          borderColor: 'rgb(245, 158, 11)', 
          backgroundColor: 'rgba(245, 158, 11, 0.1)',
          bgClass: 'bg-yellow-100'
      },
      'Jogging': {
          borderColor: 'rgb(139, 92, 246)', 
          backgroundColor: 'rgba(139, 92, 246, 0.1)',
          bgClass: 'bg-purple-100'
      },
      'Weight Training': {
          borderColor: 'rgb(236, 72, 153)', 
          backgroundColor: 'rgba(236, 72, 153, 0.1)',
          bgClass: 'bg-pink-100'
      },
      'Yoga': {
          borderColor: 'rgb(14, 165, 233)', 
          backgroundColor: 'rgba(14, 165, 233, 0.1)',
          bgClass: 'bg-sky-100'
      },
      'Other': {
          borderColor: 'rgb(156, 163, 175)', 
          backgroundColor: 'rgba(156, 163, 175, 0.1)',
          bgClass: 'bg-gray-100'
      }
  };
      
  // Week data
  const today = new Date();
  const labels = [];
  const dates = [];
  
  // Generate the last 7 days for chart labels
  for (let i = 6; i >= 0; i--) {
      const date = new Date(today);
      date.setDate(today.getDate() - i);
      
      const formattedDate = date.toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric'
      });
      
      labels.push(formattedDate);
      dates.push(date.toISOString().split('T')[0]); // Store as YYYY-MM-DD
  }

  // Initial exercise data
  const activityData = {
      'Running': [30, 0, 0, 0, 0, 30, 60],
      'Cycling': [0, 40, 0, 0, 45, 0, 0],
      'Swimming': [0, 0, 0, 25, 0, 20, 0],
      'Jogging': [0, 0, 30, 0, 0, 0, 30],
      'Weight Training': [0, 0, 0, 0, 0, 0, 0],
      'Yoga': [0, 0, 0, 0, 0, 0, 0],
      'Other': [0, 0, 0, 0, 0, 0, 0]
  };

  // Function to update summary totals
  function updateSummaryTotals() {
      exerciseTypes.forEach(type => {
          const totalElement = document.getElementById(`${type.toLowerCase()}-total`);
          if (totalElement) {
              const total = activityData[type].reduce((sum, value) => sum + value, 0);
              totalElement.textContent = `${total} min`;
          }
      });
      
      // Check if we need to add any missing summary cards
      const summaryContainer = document.getElementById('activity-summary');
      exerciseTypes.forEach(type => {
          const typeId = type.toLowerCase().replace(/\s+/g, '-');
          const existingCard = document.getElementById(`${typeId}-total`);
          
          if (!existingCard && activityData[type].some(value => value > 0)) {
              // Get color class from colorMap or default to gray
              const bgClass = colorMap[type]?.bgClass || 'bg-gray-100';
              
              // Create a new summary card
              const newCard = document.createElement('div');
              newCard.className = `p-3 ${bgClass} rounded-lg`;
              newCard.innerHTML = `
                  <div class="text-sm text-gray-600">${type}</div>
                  <div class="font-bold text-lg" id="${typeId}-total">
                      ${activityData[type].reduce((sum, value) => sum + value, 0)} min
                  </div>
                  <div class="text-xs text-gray-500">This week</div>
              `;
              summaryContainer.appendChild(newCard);
          }
      });
  }

  // Create datasets for chart
  function createChartDatasets() {
      const datasets = [];
      
      exerciseTypes.forEach(type => {
          // Only add to chart if there's data
          if (activityData[type].some(value => value > 0)) {
              datasets.push({
                  label: type,
                  data: activityData[type],
                  borderColor: colorMap[type].borderColor,
                  backgroundColor: colorMap[type].backgroundColor,
                  tension: 0.4
              });
          }
      });
      
      return datasets;
  }

  // Initialize chart
  const ctx = document.getElementById('exercise-chart').getContext('2d');
  const exerciseChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: createChartDatasets()
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  position: 'top',
              },
              title: {
                  display: true,
                  text: 'Exercise Duration (minutes) by Day'
              }
          },
          scales: {
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: 'Duration (minutes)'
                  }
              },
              x: {
                  title: {
                      display: true,
                      text: 'Date'
                  }
              }
          }
      }
  });
  
  // Function to update chart
  function updateChart() {
      exerciseChart.data.datasets = createChartDatasets();
      exerciseChart.update();
  }

  // Handle modal
  const modal = document.getElementById('exercise-modal');
  const addExerciseBtn = document.getElementById('add-exercise-btn');
  const cancelBtn = document.getElementById('cancel-btn');
  const exerciseForm = document.getElementById('exercise-form');
  
  // Set default date to today
  document.getElementById('exercise-date').valueAsDate = new Date();

  addExerciseBtn.addEventListener('click', function() {
      modal.classList.remove('hidden');
  });

  cancelBtn.addEventListener('click', function() {
      modal.classList.add('hidden');
  });

  // Close modal if clicking outside
  modal.addEventListener('click', function(e) {
      if (e.target === modal) {
          modal.classList.add('hidden');
      }
  });

  // Form submission
  exerciseForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const dateInput = document.getElementById('exercise-date').value;
      const type = document.getElementById('exercise-type').value;
      const duration = parseInt(document.getElementById('exercise-duration').value);
      
      // Format date for display
      const selectedDate = new Date(dateInput);
      const formattedDate = selectedDate.toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric',
          year: 'numeric'
      });
      
      // Add to table
      const tableBody = document.getElementById('activity-table-body');
      const newRow = tableBody.insertRow(0);
      
      newRow.innerHTML = `
          <td class="py-2 px-3 text-sm text-gray-800">${formattedDate}</td>
          <td class="py-2 px-3 text-sm text-gray-800">${type}</td>
          <td class="py-2 px-3 text-sm text-gray-800">${duration} min</td>
          <td class="py-2 px-3 text-sm text-gray-800">
              <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
              <button class="text-red-600 hover:text-red-800">Delete</button>
          </td>
      `;
      
      // Find index in dates array for chart update
      const simpleDate = selectedDate.toISOString().split('T')[0]; // YYYY-MM-DD
      const dateIndex = dates.indexOf(simpleDate);
      
      // Update chart data if the date is within our 7-day window
      if (dateIndex !== -1) {
          activityData[type][dateIndex] += duration;
          updateChart();
          updateSummaryTotals();
      }
      
      // Show success message
      const successMessage = document.createElement('div');
      successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg';
      successMessage.textContent = `${type} activity added: ${duration} minutes`;
      document.body.appendChild(successMessage);
      
      // Remove success message after 3 seconds
      setTimeout(() => {
          successMessage.remove();
      }, 3000);
      
      // Close modal and reset form
      modal.classList.add('hidden');
      exerciseForm.reset();
      document.getElementById('exercise-date').valueAsDate = new Date();
  });
  
  // Initialize summary totals on page load
  updateSummaryTotals();
});