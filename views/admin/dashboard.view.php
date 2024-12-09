<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/admin-header.php'); ?>

<?php $rooms = [] ?>
<?php $bookingsCount = [] ?>

<section>
    <h3>Room Bookings Statistics</h3>
    <ul>
        <?php foreach ($rooms_usage as $usage): ?>
            <!-- <li>Room ID: <?php echo htmlspecialchars($usage['room_id']); ?> | Total Bookings: <?php echo htmlspecialchars($usage['bookings']); ?></li> -->
            <?php array_push($rooms, $usage['room_id']) ?>
            <?php array_push($bookingsCount, $usage['bookings']) ?>
        <?php endforeach; ?>
    </ul>
    <div class="chart-container">
        <canvas id="barChart" style="max-width: 750px;"></canvas>
        <canvas id="pieChart" width="200" height="100" style="max-width: 750px;"></canvas>
    </div>
</section>

<script>
    const xValues = <?= json_encode($rooms) ?>;
    const yValues = <?= json_encode($bookingsCount) ?>;
    const colors = [
        "#25CCF7","#FD7272","#54a0ff","#00d2d3",
        "#1abc9c","#2ecc71","#3498db","#9b59b6","#34495e",
        "#16a085","#27ae60","#2980b9","#8e44ad","#2c3e50",
        "#f1c40f","#e67e22","#e74c3c","#ecf0f1","#95a5a6",
        "#f39c12","#d35400","#c0392b","#bdc3c7","#7f8c8d",
        "#55efc4","#81ecec","#74b9ff","#a29bfe","#dfe6e9",
        "#00b894","#00cec9","#0984e3","#6c5ce7","#ffeaa7",
        "#fab1a0","#ff7675","#fd79a8","#fdcb6e","#e17055",
        "#d63031","#feca57","#5f27cd","#54a0ff","#01a3a4"
    ];

    const barChart = new Chart("barChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: colors,
                data: yValues
            }]
        },
        options: {
            "legend": {
                "display": false
            },

            scales: {
                yAxes:
                [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    const pieChart = new Chart("pieChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets:
        [{
            backgroundColor: colors,
            data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Most Booked Rooms"
        }
    }
    });
</script>

<?php require base_path('views/partials/footer.php'); ?>