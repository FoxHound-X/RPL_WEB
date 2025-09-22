<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impor Data Guru (CSV)</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="import-container">
        <h2><i class="fas fa-upload"></i> Impor Data Guru (CSV)</h2>
        <form method="post" enctype="multipart/form-data" class="import-form">
            <input type="file" name="file_csv" accept=".csv" required>
            <button type="submit" name="preview" class="btn">Preview</button>
        </form>

        <?php
        if (isset($_POST['preview'])) {
            $fileName = $_FILES['file_csv']['tmp_name'];

            if ($_FILES['file_csv']['size'] > 0) {
                echo "<form action='admin/impordata/import_csv.php' method='post'>";
                echo "<table class='import-table'>";
                echo "<tr><th>Nama Guru</th><th>Tanggal Lahir</th><th>Alamat</th><th>Telepon</th><th>Username</th><th>Password</th></tr>";

                $file = fopen($fileName, "r");
                $isFirstRow = true;

                while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                    if ($isFirstRow) { // lewati header
                        $isFirstRow = false;
                        continue;
                    }

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row[0]) . "</td>"; // nama_guru
                    echo "<td>" . htmlspecialchars($row[1]) . "</td>"; // tgl_lahir
                    echo "<td>" . htmlspecialchars($row[2]) . "</td>"; // alamat
                    echo "<td>" . htmlspecialchars($row[3]) . "</td>"; // telp
                    echo "<td>" . htmlspecialchars($row[4]) . "</td>"; // username
                    echo "<td>" . htmlspecialchars($row[5]) . "</td>"; // password
                    echo "</tr>";

                    // simpan data ke hidden input untuk dikirim ke import_csv.php
                    echo "<input type='hidden' name='nama_pegawai[]' value='" . htmlspecialchars($row[0]) . "'>";
                    echo "<input type='hidden' name='tgl_lahir[]' value='" . htmlspecialchars($row[1]) . "'>";
                    echo "<input type='hidden' name='almat[]' value='" . htmlspecialchars($row[2]) . "'>";
                    echo "<input type='hidden' name='telp[]' value='" . htmlspecialchars($row[3]) . "'>";
                    echo "<input type='hidden' name='username[]' value='" . htmlspecialchars($row[4]) . "'>";
                    echo "<input type='hidden' name='password[]' value='" . htmlspecialchars($row[5]) . "'>";
                }

                fclose($file);
                echo "</table>";
                echo "<br><button type='submit' class='btn'>Simpan ke Database</button>";
                echo "</form>";
            } else {
                echo "<div class='error-message'><i class='fas fa-exclamation-circle'></i> File kosong atau tidak valid!</div>";
            }
        }
        ?>
    </div>
    <!-- CSS tetap sama -->
</body>
</html>

    <style>
        /* Modular CSS for Import Page */
        .import-container {
            background: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .import-container h2 {
            margin: 0 0 20px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .import-form {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .import-form input[type="file"] {
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #218838;
        }

        .import-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .import-table th,
        .import-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .import-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .import-table td {
            color: #555;
        }

        .error-message {
            color: #dc3545;
            margin: 20px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .import-container {
                margin: 10px;
                padding: 15px;
            }

            .import-form {
                flex-direction: column;
            }

            .import-table th,
            .import-table td {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>

</html>