<!DOCTYPE html>
<html>

<head>
    <title>Electricity Bill</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Electricity Bill </h1>
        <?php
        $r1 = 3.50;
        $r2 = 4.00;
        $r3 = 5.20;
        $r4 = 6.50;
        $bill = 0;

        function get_month_name($month)
        {
            $month_names = [
                1 => 'January',
                2 => 'February',
                3 => 'March'
            ];
            return $month_names[$month] ?? '';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $units = (int)$_POST['units'];
            $name = $_POST['name'];
            $month = isset($_POST['month']) ? $_POST['month'] : '';
            $mnth = get_month_name($month);

            if ($units <= 50) {
                $bill = $units * $r1;
            } elseif ($units > 50 && $units <= 150) {
                $bill = 50 * $r1 + ($units - 50) * $r2;
            } elseif ($units > 150 && $units <= 250) {
                $bill = 50 * $r1 + 100 * $r2 + ($units - 150) * $r3;
            } else {
                $bill = 50 * $r1 + 100 * $r2 + 100 * $r3 + ($units - 250) * $r4;
            }
        }
        ?>
        <form id="billCalculatorForm" action="" method="POST">
            <div class="form-group">
                <label for="units">Enter Name:</label>
                <input type="text" class="form-control" id="name" name="name" required><br>
                <label for="units">Enter units consumed:</label>
                <input type="number" class="form-control" id="units" name="units" required><br>
                <div class="dropdown">
                    <label for="month">Select Month:</label>
                    <select class="form-control" name="month" id="month" required>
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                    </select>
                </div>
            </div><br>
            <button type="submit" class="btn btn-primary" name="calculate" onclick="processPayment()">Pay Now</button>
        </form>
        <?php if (isset($_POST['calculate'])) : ?>
            <div id="result" class="mt-4">
                <div id="successMessage">
                    <div class="alert alert-success mt-3" role="alert">
                        <p>Hello <?php echo $name; ?></p>
                        <p>Your bill amount is <?php echo $bill; ?></p>
                        <p>For the month <?php echo $mnth; ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function processPayment() {
            var name = document.getElementById("name").value;
            var units = document.getElementById("units").value;
            var month = document.getElementById("month").value;
            var mnth = "";
            if (month === "1") {
                mnth = "January";
            } else if (month === "2") {
                mnth = "February";
            } else if (month === "3") {
                mnth = "March";
            }

            var bill = 0;
            var r1 = 3.50;
            var r2 = 4.00;
            var r3 = 5.20;
            var r4 = 6.50;

            if (units <= 50) {
                bill = units * r1;
            } else if (units > 50 && units <= 150) {
                bill = 50 * r1 + (units - 50) * r2;
            } else if (units > 150 && units <= 250) {
                bill = 50 * r1 + 100 * r2 + (units - 150) * r3;
            } else {
                bill = 50 * r1 + 100 * r2 + 100 * r3 + (units - 250) * r4;
            }

            var successMessageDiv = document.getElementById("successMessage");
            successMessageDiv.innerHTML = '<div class="alert alert-success mt-3" role="alert">' +
                '<p>Hello ' + name + '</p>' +
                '<p>Your bill amount is ' + bill + '</p>' +
                '<p>For the month ' + mnth + '</p>' +
                '</div>';
        }
    </script>
</body>

</html>
