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
        <table>
            <thead>
                <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>The Programs</th>
                        <th>Nationality</th>
                        <th>Colleges</th>
                        <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($data['records']) && is_array($data['records'])) {
                    foreach ($data['records'] as $record) {
                        echo "<tr>
                                <td>{$record['fields']['year']}</td>
                                <td>{$record['fields']['semester']}</td>
                                <td>{$record['fields']['programs']}</td>
                                <td>{$record['fields']['nationality']}</td>
                                <td>{$record['fields']['college']}</td>
                                <td>{$record['fields']['students']}</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>