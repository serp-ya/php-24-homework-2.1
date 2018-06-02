<?php 
$json = file_get_contents(__DIR__ . '/data.json');
$data = json_decode($json, true);

function checkDataExistAndShow($data, $exist = true) {
    if ($exist) {
        $condition = isset($data) && !empty($data);
        return $condition ? $data : '';
    } 
    
    return !isset($data) && empty($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    
<?php if (checkDataExistAndShow($data, false)): ?>
    <h3>
        Нет данных
    </h3>
<?php 
    exit(); 
    endif;
?>


<table>

    <thead>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Адрес</td>
        <td>Телефон</td>
    </thead>


    <?php foreach ($data as $item): ?>
        <tr>
            <td>
                <?php echo checkDataExistAndShow($item['firstName'] ); ?>
            </td>

            <td>
                <?php echo checkDataExistAndShow($item['lastName']); ?>
            </td>

            <td>
                <?php echo checkDataExistAndShow($item['address']); ?>
            </td>

            <td>
                <?php echo checkDataExistAndShow($item['phoneNumber']); ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
    
</body>
</html>
