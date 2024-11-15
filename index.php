<?php
$linkURL= "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
$response = file_get_contents($linkURL);
if ($response === false) {
    die("Error: Unable to retrieve data from the API.");
}

echo "<pre>";
print_r($response);
echo "</pre>";
$data = json_decode($response, true);

if ($data === null) {
    die("Error: Unable to decode JSON. Check the API response format.");
}
echo "<pre>";
print_r($data); // Inspect the structure of the parsed data
echo "</pre>";
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
        <h1>University of Bahrain - Student Nationalities</h1>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Nationality</th>
                    <th>Program</th>
                    <th>College</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($data['records']) && is_array($data['records'])) {
                    foreach ($data['records'] as $record) {
                        echo "<tr>
                                <td>{$record['student_id']}</td>
                                <td>{$record['nationality']}</td>
                                <td>{$record['program']}</td>
                                <td>{$record['college']}</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>