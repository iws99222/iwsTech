<!-- THIS FILE IS THE RESPONSIBLE FOR FILE UPLOADING 
 
NO NEED TO INCLUDE THE CONNECTION HERE, WE ARE JUST GOING TO UPLOAD IN THIS FILE
-->
<?php

    /*
    VERY IMPORTANT HINT:
        - This file will be included in other pages (e.g. insertProduct.php)
        - The image will be received from another page via $_FILES['productImage']
        - We will extract info and move the file to a permanent folder (e.g., /uploads)
        - Then we return the file name to be inserted into the DB
        - the 'newImageFileName' will be the name of the uploaded image
      each time i am adding or editing a product image, i will be updating the productImage = $newImageFileName 
    */
     
      print_r($fileImage); /* => [name] => img12.jpg [full_path] => img12.jpg [type] => image/jpeg [tmp_name] => C:\wamp64\tmp\phpA1EE.tmp [error] => 0 [size] => 33073 */
      // getting the original name of the file 
      $fileName = $_FILES['fileImage']['name'];
      // refering to the temp file path before it's moving to a permanent location
      $fileTempName = $_FILES['fileImage']['tmp_name'];
      // getting the MIME type such as image/jpeg
      $fileType = $_FILES['fileImage']['type'];
     // this for ensuring that file uploaded successfully,  (0 = no error)
      $fileError = $_FILES['fileImage']['error'];
      // getting the file size in bytes, in order to check the image if too large
      $fileSize = $_FILES['fileImage']['size'];


      // nnw we want to split the file name by . as a delimeter
      // suppose the file name is iws.jpg, it became {iws,jpg}
      $fileExtension = explode('.' , $fileName);
      echo '<p>'.$fileExtension[1].'</p>';

      // now we need to get the actual extention. by getting the last index 
      // from the file externsion : {iws,jpg} => we want to get the last which is 'jpg'
      $actualFileExtension = end($fileExtension);
      echo 'Actual Extension: '. $actualFileExtension.'';

      // now we will create the allowed file extensions to be uploaded
      $allowed_extensions = array('jpg', 'jpeg' , 'png', 'webp', 'avif');
      // now we want to check if the chosen file actual extension if
      // included in the allowed extensions. must be end with .png or .jpg .....
      if(in_array($actualFileExtension , $allowed_extensions)){
        // now the chosen file is allowed to be uploaded
        // we want to ensure that the file has no error
        if($fileError === 0){
            // now we ensured that the file has no errors
            // so we are ready to generate a new file name to the image
            $newImageFileName =uniqid('' , true).'.'.$actualFileExtension;
            // the folder which we want place the image inside
            $productImagesDestination = '../drawables/uploaded-images/'.$newImageFileName; // 
            move_uploaded_file($fileTempName , $productImagesDestination);
            echo 'Successfully uploaded issa!!';
        }else{
            // something went wrong with the chosen file
            echo 'Something went wrong with the chosen file';
        }
      }else{
        // else. the file is not allowed to be uploaded (if not image)
        echo 'File not allowed to be uploaded';
      }
    