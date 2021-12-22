<?php
$uploadfile = "";
echo "Uploading ";
$temperature='';
echo $_FILES["file"]["caption"];
if(!empty($_GET['data']))
{
    $temperature=$_GET['data'];

echo $temperature;
if(!empty($temperature))
{ 
    $attendance = fopen("action.txt","w") or die("Unable to open file!");
                            $txt = $temperature;
                            fwrite($attendance, $txt);
                            $txt = "";
                            fwrite($attendance, $txt);
                            fclose($attendance);
                             }
                             else{
                                echo "no logs";
                             }
}

if(strlen(basename($_FILES["imageFile"]["name"])) > 0)
{
         $uploadfile = basename($_FILES["imageFile"]["name"]);
  if(move_uploaded_file($_FILES["imageFile"]["tmp_name"], $uploadfile))
         {
         @chmod($uploadfile,0777); echo " Ok! ";
        $datum = mktime(date('H')+0, date('i'), date('s'), date('m'), date('d'), date('y'));
        if (file_exists("upload/".date('Y_m_d', $datum) )) 
        {
         print("Directory already exists.\n");
         } else {
         mkdir("upload/".date('Y_m_d', $datum));
         copy("index1.php","upload/".date('Y_m_d', $datum)."/index.php");
         print("Directory creating.\n");
         }
        echo "saved ";
        copy($uploadfile,"upload/".date('Y_m_d', $datum)."/".date('Y.m.d_H-i-s', $datum).".jpg");
 }}

include ("../../../src/common/DBConnection.php");
// $conn=new DBConnection();

// $camera=$conn->execute("INSERT INTO `entrance`(temperature,image) VALUE('".$temperature."','".date('Y.m.d_H-i-s', $datum)."')");
// if($camera)
// {
// echo "Successifull";
// }
// else
// {
// echo "Failed";
// }

// $sel="SELECT * FROM entrance order by sid desc";
// $qry=mysqli_query($conn1,$sel);
// if($row=mysqli_fetch_array($qry)){
//     $id=$row['sid'];

    $upd="INSERT INTO entrance (image) VALUES('".date('Y.m.d_H-i-s', $datum)."')";
    $upqry=mysqli_query($conn1,$upd);
    if ($upqry) {
        echo "image added";
    }else{
        echo "image not added";
    }


// }else{
//     echo "data not found";
// }
