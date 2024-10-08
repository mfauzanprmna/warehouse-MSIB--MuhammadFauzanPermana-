<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/r-3.0.3/datatables.min.css" rel="stylesheet">
    <title>WereHouse</title>

    <style>
        .disabled-button {
            pointer-events: none;
            opacity: 0.6;
            background-color: gray;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container my-3">
        <?php echo $content; ?>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/r-3.0.3/datatables.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElement = document.getElementById('liveToast');
            if (toastElement) {
                var toast = new bootstrap.Toast(toastElement);
                toast.show();
            }
        });

        $(document).ready(function() {
            $('.dataTable').DataTable();
        });
    </script>
</body>
</body>

</html>