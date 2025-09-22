<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f4f4f4; }
        .btn { padding: 8px 15px; background: green; color: white; border: none; cursor: pointer; }
        .btn:hover { background: darkgreen; }
    </style>
</head>
<body>
    <h2>📂 Import Data Siswa (CSV)</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file_csv" accept=".csv" required>
        <button type="submit" name="preview" class="btn">Preview</button>
    </form>

    <?php
    if (isset($_POST['preview'])) {
        $fileName = $_FILES['file_csv']['tmp_name'];

        if ($_FILES['file_csv']['size'] > 0) {
            echo "<form action='import_csv.php' method='post'>";
            echo "<table>";
            echo "<tr><th>Nama</th><th>NIS</th><th>Kelas</th><th>Tanggal Lahir</th></tr>";

            $file = fopen($fileName, "r");
            $isFirstRow = true;

            while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                if ($isFirstRow) { // lewati header
                    $isFirstRow = false;
                    continue;
                }

                echo "<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "<td>".$row[5]."</td>";
                echo "</tr>";

                // simpan data ke hidden input untuk dikirim ke import_csv.php
                echo "<input type='hidden' name='nama[]' value='".$row[0]."'>";
                echo "<input type='hidden' name='tgl_lahir[]' value='".$row[1]."'>";
                echo "<input type='hidden' name='almat[]' value='".$row[2]."'>";
                echo "<input type='hidden' name='telp[]' value='".$row[3]."'>";
                echo "<input type='hidden' name='username[]' value='".$row[4]."'>";
                echo "<input type='hidden' name='password[]' value='".$row[5]."'>";
            }

            fclose($file);
            echo "</table>";
            echo "<br><button type='submit' class='btn'>Simpan ke Database</button>";
            echo "</form>";
        } else {
            echo "<p style='color:red;'>❌ File kosong atau tidak valid!</p>";
        }
    }
    ?>
</body>
</html>
