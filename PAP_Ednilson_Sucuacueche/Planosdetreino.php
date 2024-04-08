<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="x-icon" href="img/man.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
       
   
      background-color: #f0f0f0;
      background-image: url('background_image.jpg'); /* Substitua 'background_image.jpg' pelo caminho da sua imagem de fundo */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
 

    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 3px solid #ccc;
      border-radius: 5px;
      text-align: center;
    }

    .progress-bar {
      width: 100%;
      height: 20px;
      background-color: #f0f0f0;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .progress {
      height: 100%;
      background-color: #4caf50;
      border-radius: 10px;
      width: 0;
      transition: width 1s ease-in-out;
    }

    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    .btn {
      background-color: #4caf50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #45a049;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .success-message {
      background-color: #f0f0f0;
      border: 3px solid #4caf50;
      border-radius: 5px;
      padding: 10px;
      margin-top: 20px;
      opacity: 0;
      transform: translateY(-20px);
      transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .success-message.show {
      opacity: 1;
      transform: translateY(0);
    }

    select, input[type="radio"] {
      margin: 10px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    select:focus, input[type="radio"]:focus {
      outline: none;
      box-shadow: 0 0 5px #4caf50;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    @media screen and (max-width: 480px) {
      .container {
        margin: 20px;
        padding: 10px;
      }

      .progress-bar {
        height: 10px;
        margin-bottom: 10px;
      }

      .btn {
        font-size: 14px;
        padding: 8px 16px;
      }
    }
  </style>
</head>

<body>
  <?php include_once 'header.php'; ?>

  <div class="container">
    <h2>Plano Fitness</h2>

    <div class="progress-bar">
      <div class="progress"></div>
    </div>

    <form id="fitnessForm">
      <div class="step active">
        <h3>Fitness Goal</h3>
        <p>Insira sua meta:</p>
        <select name="goal" required>
          <option disabled selected value="">Select...</option>
          <option value="Ganhar massa muscular"><i class="fas fa-dumbbell"></i> Ganhar massa muscular</option>
          <option value="Perder peso"><i class="fas fa-weight"></i> Perder peso</option>
          <option value="Manter forma"><i class="fas fa-running"></i> Manter forma</option>
        </select>

        <button type="button" class="btn" onclick="nextStep()">Next</button>
      </div>

      <div class="step">
        <h3>Experience Level</h3>
        <p>Select your experience level:</p>
        <select name="experience" required>
          <option disabled selected value="">Select...</option>
          <option value="beginner">Principiante</option>
          <option value="intermediate">Intermediário</option>
          <option value="advanced">Avançado</option>
        </select>

        <button type="button" class="btn" onclick="previousStep()">Back</button>
        <button type="button" class="btn" onclick="nextStep()">Next</button>
      </div>

      <div class="step">
        <h3>Training Location</h3>
        <p>Select your training location:</p>
        <input type="radio" name="location" value="gym" required>Com equipamento<br>
        <input type="radio" name="location" value="home">Sem equipamento<br>

        <button type="button" class="btn" onclick="previousStep()">Back</button>
        <button type="submit" class="btn">Submit</button>
      </div>
    </form>

    <div id="programContainer"></div>
    <div id="successMessage" class="success-message">Fitness program generated successfully!</div>
  </div>
  <script>
    let currentStep = 0;
    const progressBar = document.querySelector('.progress');
    const form = document.getElementById('fitnessForm');
    const steps = Array.from(document.querySelectorAll('.step'));

    // Define a collection of fitness programs with their table data
    const fitnessPrograms = [
      {
        goal: 'Ganhar massa muscular',
        experience: 'beginner',
        location: 'home',
        tableData: {
          Monday: {
            muscleGroup: 'Peito',
            exercises: 'Supino reto, supino inclinado, cruzamento de cabos',
            sets: 4,
            repetitions: '8-12'
          },
          Tuesday: {
            muscleGroup: 'Costas',
            exercises: 'Remada baixa, remada curvada, puxada na frente',
            sets: 4,
            repetitions: '8-12'
          },
          Wednesday: {
            muscleGroup: 'Ombros',
            exercises: 'Elevação lateral, elevação frontal, elevação posterior',
            sets: 4,
            repetitions: '8-12'
          },
          Thursday: {
            muscleGroup: 'Braços',
            exercises: 'Rosca direta, rosca alternada, tríceps testa',
            sets: 4,
            repetitions: '8-12'
          },
          Friday: {
            muscleGroup: 'Pernas',
            exercises: 'Agachamento, leg press, extensão de perna',
            sets: 4,
            repetitions: '8-12'
          },
          Saturday: {
            muscleGroup: 'Abdominais',
            exercises: 'Prancha, abdominal reto, oblíquo',
            sets: 4,
            repetitions: '12-15'
          }
        }
      },
      {
        goal: 'Ganhar massa muscular',
        experience: 'beginner',
        location: 'gym',
        tableData: {
          Monday: {
            muscleGroup: 'Cardio',
            exercises: 'Running, jumping jacks, burpees',
            sets: '3-4 sets of 10 minutes each',
            repetitions: 'N/A'
          },
          Tuesday: {
            muscleGroup: 'Full Body',
            exercises: 'Squats, push-ups, lunges',
            sets: 3,
            repetitions: '12-15'
          },
          Wednesday: {
            muscleGroup: 'Cardio',
            exercises: 'Cycling, high knees, mountain climbers',
            sets: '3-4 sets of 10 minutes each',
            repetitions: 'N/A'
          },
          Thursday: {
            muscleGroup: 'Core',
            exercises: 'Plank, Russian twists, bicycle crunches',
            sets: 3,
            repetitions: '12-15'
          },
          Friday: {
            muscleGroup: 'Cardio',
            exercises: 'Jump rope, jogging in place, box jumps',
            sets: '3-4 sets of 10 minutes each',
            repetitions: 'N/A'
          },
          Saturday: {
            muscleGroup: 'Full Body',
            exercises: 'Burpees, mountain climbers, squat jumps',
            sets: 3,
            repetitions: '12-15'
          }
        }
      },
      {
        goal: 'Manter forma',
        experience: 'advanced',
        location: 'gym',
        tableData: {
          Monday: {
            muscleGroup: 'Chest',
            exercises: 'Bench press, dumbbell flyes, cable crossovers',
            sets: 4,
            repetitions: '8-12'
          },
          Tuesday: {
            muscleGroup: 'Back',
            exercises: 'Deadlifts, pull-ups, bent-over rows',
            sets: 4,
            repetitions: '8-12'
          },
          Wednesday: {
            muscleGroup: 'Shoulders',
            exercises: 'Military press, lateral raises, upright rows',
            sets: 4,
            repetitions: '8-12'
          },
          Thursday: {
            muscleGroup: 'Arms',
            exercises: 'Barbell curls, tricep dips, hammer curls',
            sets: 4,
            repetitions: '8-12'
          },
          Friday: {
            muscleGroup: 'Legs',
            exercises: 'Squats, lunges, leg curls',
            sets: 4,
            repetitions: '8-12'
          },
          Saturday: {
            muscleGroup: 'Abs',
            exercises: 'Plank, Russian twists, hanging leg raises',
            sets: 4,
            repetitions: '12-15'
          }
        }
      },
      { 
        goal: 'Ganhar massa muscular',
  experience: 'intermediate',
  location: 'home',
  tableData: {
    Monday: {
      muscleGroup: 'Peito',
      exercises: 'Supino reto, supino inclinado, cruzamento de cabos',
      sets: 4,
      repetitions: '8-12'
    },
    Tuesday: {
      muscleGroup: 'descanço',
      exercises: 'Remada baixa, remada curvada, puxada na frente',
      sets: 4,
      repetitions: '8-12'
    },
    Wednesday: {
      muscleGroup: 'Ombros',
      exercises: 'Elevação lateral, elevação frontal, elevação posterior',
      sets: 4,
      repetitions: '8-12'
    },
    Thursday: {
      muscleGroup: 'Braços',
      exercises: 'Rosca direta, rosca alternada, tríceps testa',
      sets: 4,
      repetitions: '8-12'
    },
    Friday: {
      muscleGroup: 'Pernas',
      exercises: 'Agachamento, leg press, extensão de perna',
      sets: 4,
      repetitions: '8-12'
    },
    Saturday: {
      muscleGroup: 'Abdominais',
      exercises: 'Prancha, abdominal reto, oblíquo',
      sets: 4,
      repetitions: '12-15'
    }
  }
},
,
      { 
        goal: 'Perder peso',
  experience: 'beginner',
  location: 'gym',
  tableData: {
    Monday: {
      muscleGroup: 'Peito',
      exercises: 'Supino reto, supino inclinado, cruzamento de cabos',
      sets: 4,
      repetitions: '8-12'
    },
    Tuesday: {
      muscleGroup: 'descanço',
      exercises: 'Remada baixa, remada curvada, puxada na frente',
      sets: 4,
      repetitions: '8-12'
    },
    Wednesday: {
      muscleGroup: 'Ombros',
      exercises: 'Elevação lateral, elevação frontal, elevação posterior',
      sets: 4,
      repetitions: '8-12'
    },
    Thursday: {
      muscleGroup: 'Braços',
      exercises: 'Rosca direta, rosca alternada, tríceps testa',
      sets: 4,
      repetitions: '8-12'
    },
    Friday: {
      muscleGroup: 'Pernas',
      exercises: 'Agachamento, leg press, extensão de perna',
      sets: 4,
      repetitions: '8-12'
    },
    Saturday: {
      muscleGroup: 'Abdominais',
      exercises: 'Prancha, abdominal reto, oblíquo',
      sets: 4,
      repetitions: '12-15'
    }
  }
}
    ];

    function previousStep() {
      if (currentStep > 0) {
        steps[currentStep].classList.remove('active');
        currentStep--;
        steps[currentStep].classList.add('active');
        updateProgressBar();
      }
    }

    function nextStep() {
      const selectElement = steps[currentStep].querySelector('select');
      if (selectElement && !selectElement.value) {
        alert('Please select an option');
        return;
      }

      if (currentStep < steps.length - 1) {
        steps[currentStep].classList.remove('active');
        currentStep++;
        steps[currentStep].classList.add('active');
        updateProgressBar();
      }
    }

    function updateProgressBar() {
      const progressPercent = (currentStep / (steps.length - 1)) * 100;
      progressBar.style.width = `${progressPercent}%`;
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      // Retrieve user's selections
      const goal = document.querySelector('select[name="goal"]').value;
      const experience = document.querySelector('select[name="experience"]').value;
      const location = document.querySelector('input[name="location"]:checked').value;

      // Find the matching fitness program
      const selectedProgram = fitnessPrograms.find(
        (program) =>
          program.goal === goal && program.experience === experience && program.location === location
      );

      // Check if a program was found
      if (selectedProgram) {
        // Generate the table HTML based on the selected program's table data
        const tableHTML = generateTableHTML(selectedProgram.tableData);

        // Display the fitness program
        const programContainer = document.getElementById('programContainer');
        programContainer.innerHTML = tableHTML;
      } else {
        // No program found, display an error message
        const programContainer = document.getElementById('programContainer');
        programContainer.innerHTML = '<p>No fitness program found for your selections.</p>';
      }
    });

    function generateTableHTML(tableData) {
      const days = Object.keys(tableData);

      let tableHTML = '<table>';
      tableHTML += '<tr><th>Dia</th><th>Grupo muscular</th><th>Exercícios</th><th>Sets</th><th>Repetições</th></tr>';

      days.forEach((day) => {
        const { muscleGroup, exercises, sets, repetitions } = tableData[day];
        tableHTML += `<tr><td>${day}</td><td>${muscleGroup}</td><td>${exercises}</td><td>${sets}</td><td>${repetitions}</td></tr>`;
      });

      tableHTML += '</table>';
 

      return tableHTML;
  
    }

    updateProgressBar();

  </script>
</body>
</html>
