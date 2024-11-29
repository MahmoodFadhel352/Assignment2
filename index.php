<?php
//API where we get the data
$linkURL= "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
//fetch the data from the API request
$response = file_get_contents($linkURL);
//decode the data that brought in JSON
$data = json_decode($response, true);

//Check if the data was retrieved
if ($data === null) {
    die("Error: Unable to decode JSON. Check the API response format.");
}
$records = $data['results'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Pico responsive styling -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <title>UOB Students Data</title>
</head>
<body>
    <!-- Responsive table fo Horizontal scrolling-->
    <main style="overflow-x: auto;">
        <h1 style="text-align:center;">UOB Students Data</h1>
    <table>
        <!-- Table header display-->
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Programs</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <!--Table main content where we display the fetched data-->
            <tbody>
                <?php
                // Loop display the rows 
                foreach ($records as $record) {
                        echo "<tr>
                        <td>{$record['year']}</td>
                        <td>{$record['semester']}</td>
                        <td>{$record['the_programs']}</td>
                        <td>{$record['nationality']}</td>
                        <td>{$record['colleges']}</td>
                        <td>{$record['number_of_students']}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>


    </main>
</body>
</html>