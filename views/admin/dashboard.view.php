<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/admin-header.php'); ?>

<?php $rooms = [] ?>
<?php $bookingsCount = [] ?>

<?php foreach ($rooms_usage as $usage): ?>
    <?php array_push($rooms, $usage['room_id']) ?>
    <?php array_push($bookingsCount, $usage['bookings']) ?>
<?php endforeach; ?>

<section>
    <h2>Room Bookings Statistics</h2>
    <div class="chart-container">
        <canvas id="barChart" style="max-width: 750px;"></canvas>
        <canvas id="pieChart"  style="max-width: 750px;"></canvas>
    </div>
</section>

<section>
    <h2>Most Popular Rooms</h2>
    <div class="overflow-auto">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Room</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>

            <?php foreach ($popular_rooms as $i => $room): ?>
                <tr>
                    <td>#<?= $i + 1 ?></td>
                    <td> <?= "s40-" . $room['room_id'] ?> </td>
                    <td> <?= $room['count'] ?> </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>

<section>
    <h2>Today's Bookings</h2>
    <div class="overflow-auto">
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Timeslot</th>
                </tr>
            </thead>

            <?php foreach ($bookings_today as $booking): ?>
                <tr>
                    <td> <?= "s40-" . $booking['room_id'] ?> </td>
                    <td> <?= $booking['s'] . " - " . $booking['e'] ?> </td>
                </tr>
            <?php endforeach; ?>


            <tfoot>
                <tr>
                    <td>Total Bookings</td>
                    <td><?= count($bookings_today) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>

<section>
    <h2>This Week's Bookings</h2>
    <div class="overflow-auto">
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Timeslot</th>
                </tr>
            </thead>

            <?php foreach ($bookings_week as $booking): ?>
                <tr>
                    <td> <?= "s40-" . $booking['room_id'] ?> </td>
                    <td> <?= $booking['date'] ?> </td>
                    <td> <?= $booking['s'] . " - " . $booking['e'] ?> </td>
                </tr>
            <?php endforeach; ?>


            <tfoot>
                <tr>
                    <td>Total Bookings</td>
                    <td><?= count($bookings_week) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>



<!-- Chart.js -->
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