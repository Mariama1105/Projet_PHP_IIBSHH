<?php
// 1. Fetch Patients per Month
$patientsResult = mysqli_query($connexion, "
    SELECT m.nom_mois, COUNT(u.id_user) AS count
    FROM mois m
    LEFT JOIN users u ON u.mois_inscr = m.id_mois AND u.id_r = 4
    GROUP BY m.id_mois, m.nom_mois
    ORDER BY m.id_mois
");

$months = [];
$patientCounts = [];
while($row = mysqli_fetch_assoc($patientsResult)) {
    $months[] = $row['nom_mois'];
    $patientCounts[] = $row['count'];
}

// 2. Fetch Doctors by Specialty
$doctorsResult = mysqli_query($connexion, "
    SELECT s.libelle_spe, COUNT(*) AS count 
    FROM users u
    JOIN specialite s ON u.specialite = s.id_specialite
    WHERE u.id_r = (SELECT id_role FROM role WHERE libelle_role = 'medecin')
    GROUP BY s.libelle_spe
");

$specialties = [];
$doctorCounts = [];
while($row = mysqli_fetch_assoc($doctorsResult)) {
    $specialties[] = $row['libelle_spe'];
    $doctorCounts[] = $row['count'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            margin: 30px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Medical Statistics Dashboard</h1>
        
        <!-- Patients by Month Chart -->
        <div class="chart-container">
            <h2>Patients by Month</h2>
            <canvas id="patientsChart"></canvas>
        </div>
        
        <!-- Doctors by Specialty Chart -->
        <div class="chart-container">
            <h2>Doctors by Specialty</h2>
            <canvas id="doctorsChart"></canvas>
        </div>
    </div>

    <script>
        // Patients by Month - Bar Chart
        const patientsCtx = document.getElementById('patientsChart');
        new Chart(patientsCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($months) ?>,
                datasets: [{
                    label: 'Number of Patients',
                    data: <?= json_encode($patientCounts) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Patients'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });

        // Doctors by Specialty - Pie Chart
        const doctorsCtx = document.getElementById('doctorsChart');
        new Chart(doctorsCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($specialties) ?>,
                datasets: [{
                    data: <?= json_encode($doctorCounts) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} (${context.percent}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>