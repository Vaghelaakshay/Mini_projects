<?php 
 include "database.php";
$obj = new database();

$colname="info.id ,info.name ,info.lang ,info.exp ,city.CTname ";
$join=" `city` ON info.cityname = city.id";
$limit=3;

$obj->select('info',$colname,$join,null,null,$limit);
$result= $obj->getResult();
echo "<table border='1' witdh='500px'>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Language</th>
            <th>Total experience</th>
            <th>City</th>
        </tr>";
foreach ($result as list("id"=>$Dataid,"name"=>$name,"lang"=>$lang,"exp"=>$experience,"CTname"=>$citys)) {
    //echo "$Dataid-$name-$lang-$experience-$citys </br>";
    

    echo "<tr>
            <td>$Dataid</td>
            <td>$name</td>
            <td>$lang</td>
            <td>$experience</td>
            <td>$citys</td>
        </tr>";
       
}
echo"</table>";
echo "<a href='./form.php'>Add New User</a>";
$obj->pagination('info',null,null,$limit);
