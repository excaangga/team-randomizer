<!DOCTYPE html>
<html>

<?php
// Turn off error for indexing array's key
// P.S. for myself: Don't use it again if u r unsure which error will pop next
    error_reporting(0);
?>

<head>
    <title>Praktikum 9</title>
</head>

<body>
    <form action="" method="post">
        Jumlah Tim: <input type="text" name="numOfGroup" placeholder="input">
        <br>
        List Nama:
        <br>
        <textarea name="nameList" id="nameList" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" name="submitForm">
    </form>


</body>

<?php
if (isset($_POST["submitForm"])) {
    $k = 1; //preventing division by 0 exception
    $k = (int) $_POST["numOfGroup"];
    $nameList = explode("\n", $_POST['nameList']);
    $n = count($nameList);
    shuffle($nameList); //shuffling array of names
    $divRes = $n / $k;
    $modRes = $n % $k;
    if ($modRes == 0) {
        for ($i = 0; $i < $k; $i++) { //iteration for each group
            $slicedList = array_slice($nameList, 0, $divRes); //extract the array
            echo "Tim ke-" . $i + 1 . " ";
            for ($j = 0; $j < $divRes; $j++) { //iteration for each team's members
                echo $slicedList[$j] . " ";
            }
            array_splice($nameList, 0, $divRes); //remove the extracted array
            echo "<br>";
        }
    } else if ($modRes != 0) {
        $mainArray = array(); //declare a bigger scope array
        for ($i = 0; $i < $k; $i++) {
            $slicedList = array_slice($nameList, 0, $divRes);
            $mainArray[$i] = $slicedList; //store current sliced list to main array
            array_splice($nameList, 0, $divRes); //remove the extracted array
        }
        for ($i = 0; $i < $modRes; $i++) {
            $remainderItem = array_slice($nameList, 0, 1);
            array_push($mainArray[$i], $remainderItem[0]);
            array_splice($nameList, 0, 1);
        }
        for ($i = 0; $i < $k; $i++) {
            echo "Tim ke-" . $i + 1 . " ";
            for ($j = 0; $j < $divRes; $j++) { //iteration for each team's members
                echo $mainArray[$i][$j] . " ";
            }
            echo "<br>";
        }
    }
}
?>

</html>