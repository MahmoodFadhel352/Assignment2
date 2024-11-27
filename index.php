<?php
$linkURL= "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
$response = file_get_contents($linkURL);
if ($response === false) {
    die("Error: Unable to retrieve data from the API.");
}
$data = json_decode($response, true);

if ($data === null) {
    die("Error: Unable to decode JSON. Check the API response format.");
}
$records=$data['records'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Students Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.5.4/dist/pico.min.css">
</head>
<body>
<main>
<?php
        // Render table
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Year</th>';
        echo '<th>Semester</th>';
        echo '<th>The Programs</th>';
        echo '<th>Nationality</th>';
        echo '<th>Colleges</th>';
        echo '<th>Number of Students</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($records as $record) {
            $fields = $record['record']['fields'] ?? [];
            echo '<tr>';
            echo '<td>' . ($fields['year'] ?? 'N/A') . '</td>';
            echo '<td>' . ($fields['semester'] ?? 'N/A') . '</td>';
            echo '<td>' . ($fields['the_programs'] ?? 'N/A') . '</td>';
            echo '<td>' . ($fields['nationality'] ?? 'N/A') . '</td>';
            echo '<td>' . ($fields['colleges'] ?? 'N/A') . '</td>';
            echo '<td>' . ($fields['number_of_students'] ?? 'N/A') . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        ?>
    </main>
</body>
</html>