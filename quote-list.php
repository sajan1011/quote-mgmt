<?php

include 'db-conn.php';
$query= "SELECT * FROM quote";
$stmt =  mysqli_prepare($conn, $query);

mysqli_execute($stmt);
$mysqli_result =  mysqli_stmt_get_result($stmt);
$data = [];

$datas = [];
while ($data = mysqli_fetch_assoc($mysqli_result)) {
    $datas[] = $data;
}

echo '<pre>';
// var_dump($mysqli_result);
// var_dump(mysqli_fetch_all($mysqli_result));
echo '</pre>';

?>

<h1 class="text-3xl text-gray-600 my-5">Hello Admin! 👋</h1>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">S.N</th>
                <th scope="col" class="px-6 py-3">Quote</th>
                <th scope="col" class="px-6 py-3">Author Name</th>
                <th scope="col" class="px-6 py-3">Created At</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($datas) >0):
            for ($j = 0; $j < count($datas); $j++): 
                $item = $datas[$j]; ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4"><?php echo $j + 1; ?></td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $item['quote']; ?>
                    </th>
                    <td class="px-6 py-4"><?php echo $item['author_name']; ?></td>
                    <td class="px-6 py-4"><?php echo $item['created_at']; ?></td> 
                </tr>
            <?php endfor;
            else: ?>
            <tr> 
                <td>No Quote Availiable</td>
            </tr>
            <?php endif;?>
        </tbody>
    </table>
</div>
