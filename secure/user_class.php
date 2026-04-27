<?php
class userClass{



// Admin Login


      public function adminLogin($username, $password)
     {

        
          $db = getDB();
          //$hash_password= hash('sha256', $password);
          $stmt = $db->prepare("SELECT * FROM user WHERE username=:username  AND  password=:password");  
          $stmt->bindParam(":username", $username,PDO::PARAM_STR) ;
          $stmt->bindParam(":password", $password,PDO::PARAM_STR) ;
          $stmt->execute();
          $count=$stmt->rowCount();
          $data=$stmt->fetch(PDO::FETCH_OBJ);
          $db = null;
          if($count )
          {
               
                return true;
          }
          else
          {
            $url='../index.php';

header("Refresh:3, $url"); // Redirecting To Home Page
echo "Please Fill in your Username or Password Correctly";
               return false;
          }    
     }



/* User Registration */
     public function userRegistration($username, $password, $fname, $phone, $email, $recovery_id, $now, $position, $permission, $ban)
     {
          try{
          $db = getDB();
          $st = $db->prepare("SELECT * FROM user WHERE username=:username");  
          $st->bindParam("username", $username,PDO::PARAM_STR);
          //$st->bindParam("password", $password,PDO::PARAM_STR);
          $st->execute();
          $count=$st->rowCount();
          if($count<1)
          {
          $stmt = $db->prepare("INSERT INTO user(username,password,fullname,phone,email,position,permission,ban,reset_key) VALUES(:username,:hash_password,:fname,:phone,:email,:position,:permission,:ban,:recovery_id)");  
         $hash_password= hash('sha256', $password);
          $stmt->bindParam(":hash_password", $hash_password,PDO::PARAM_STR) ;
          $stmt->bindParam(":username", $username,PDO::PARAM_STR);
          $stmt->bindParam(":fname", $fname,PDO::PARAM_STR) ;
          $stmt->bindParam(":phone", $phone,PDO::PARAM_STR) ;
          $stmt->bindParam(":email", $email,PDO::PARAM_STR) ;
          $stmt->bindParam(":ban", $ban,PDO::PARAM_STR) ;
          $stmt->bindParam(":position", $position,PDO::PARAM_STR) ;
          $stmt->bindParam(":permission", $permission,PDO::PARAM_STR) ;
          $stmt->bindParam(":recovery_id", $recovery_id,PDO::PARAM_STR) ;
            $stmt->execute();
          $uid=$db->lastInsertId();
  
          $db = null;
          $_SESSION['uid']=$uid;
          return true;

          }
          else
          {
          $db = null;
          return false;
          }
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }




/* Add Terminal */
/*     public function addTerminal($tname, $taddress, $tstate, $tcity, $tmanager, $datecreated, $remark)
     {
          try{
          $db = getDB();
          $st = $db->prepare("SELECT * FROM terminal WHERE tname=:tname");  
          $st->bindParam("tname", $tname,PDO::PARAM_STR);
          $st->execute();
          $count=$st->rowCount();
          if($count<1)
          {
          $stmt = $db->prepare("INSERT INTO terminal(tname,tstate,tcity,taddress,tmanager,datecreated,remark) VALUES(:tname,:tstate,:tcity,:taddress,:tmanager,:datecreated,:remark)");  
          $stmt->bindParam(":tname", $tname,PDO::PARAM_STR);
          $stmt->bindParam(":tstate", $tstate,PDO::PARAM_STR) ;
          $stmt->bindParam(":tcity", $tcity,PDO::PARAM_STR) ;
          $stmt->bindParam(":taddress", $taddress,PDO::PARAM_STR) ;
          $stmt->bindParam(":tmanager", $tmanager,PDO::PARAM_STR) ;
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":remark", $remark,PDO::PARAM_STR) ;
            $stmt->execute();
          $tid=$db->lastInsertId();
  
          $db = null;
          $_SESSION['t_id']=$tid;
          return true;

          }
          else
          {
          $db = null;
          return false;
          }
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }

*/



/* Add Bus */
     public function addBus($busno, $model, $avseats, $terminal_name, $status, $datecreated, $remark)
     {
          try{
          $db = getDB();
          $st = $db->prepare("SELECT * FROM bus WHERE busno=:busno");  
          $st->bindParam("busno", $busno,PDO::PARAM_STR);
          $st->execute();
          $count=$st->rowCount();
          if($count<1)
          {
          $stmt = $db->prepare("INSERT INTO bus(busno,model,avseats,terminal_name,status,datecreated,remark) VALUES(:busno,:model,:avseats,:terminal_name,:status,:datecreated,:remark)");  
          $stmt->bindParam(":busno", $busno,PDO::PARAM_STR);
          $stmt->bindParam(":model", $model,PDO::PARAM_STR) ;
          $stmt->bindParam(":avseats", $avseats,PDO::PARAM_STR) ;
          $stmt->bindParam(":terminal_name", $terminal_name,PDO::PARAM_STR) ;
          $stmt->bindParam(":status", $status,PDO::PARAM_STR) ;
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":remark", $remark,PDO::PARAM_STR) ;
            $stmt->execute();
          $bid=$db->lastInsertId();
  
          $db = null;
          $_SESSION['bus_id']=$bid;
          return true;

          }
          else
          {
          $db = null;
          return false;
          }
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }





/* Add Product */
     public function addProduct($pcode, $pname, $pdesc, $pleft, $saleprice, $datecreated, $remark)
     {
          try{
          $db = getDB();
          $st = $db->prepare("SELECT * FROM product WHERE pname=:pname");  
          $st->bindParam("pname", $pname,PDO::PARAM_STR);
          $st->execute();
          $count=$st->rowCount();
          if($count<1)
          {
          $stmt = $db->prepare("INSERT INTO product(pcode,pname,pdesc,pleft,saleprice,datecreated,createdby) VALUES(:pcode,:pname,:pdesc,:pleft,:saleprice,:datecreated,:createdby)");  
          $stmt->bindParam(":pcode", $pcode,PDO::PARAM_STR);
          $stmt->bindParam(":pname", $pname,PDO::PARAM_STR);
          $stmt->bindParam(":pdesc", $pdesc,PDO::PARAM_STR) ;
          $stmt->bindParam(":pleft", $pleft,PDO::PARAM_STR) ;
          $stmt->bindParam(":saleprice", $saleprice,PDO::PARAM_STR) ;
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":createdby", $remark,PDO::PARAM_STR) ;
            $stmt->execute();
          $pid=$db->lastInsertId();
  
          $db = null;
          $_SESSION['pid']=$pid;
          return true;

          }
          else
          {
          $db = null;
          return false;
          }
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }




/* Add Stock */
     public function addStock($pname, $pcode, $saleprice, $qty, $stockprice, $totalcost, $transcode, $purchasedate, $updatedby, $pid, $newpleft)
     {
          try{
          $db = getDB();
          $stmt = $db->prepare("UPDATE product SET pleft = :pleft, saleprice = :saleprice, dateupdated = :dateupdated, updatedby = :updatedby 
               WHERE pid = :pid");  
          $stmt->bindParam(":pleft", $newpleft,PDO::PARAM_STR);
          $stmt->bindParam(":saleprice", $saleprice,PDO::PARAM_STR) ;
          $stmt->bindParam(":dateupdated", $purchasedate,PDO::PARAM_STR) ;
          $stmt->bindParam(":updatedby", $updatedby,PDO::PARAM_STR) ;
          $stmt->bindParam(":pid", $pid,PDO::PARAM_STR) ;
            
            $stmt->execute();
if($stmt->rowCount() > 0){
            echo $stmt->rowCount(). "record updated successfully";



            $stmt = $db->prepare("INSERT INTO stock(pname,pcode,qty,stockprice,totalcost,transcode,purchasedate,updatedby) VALUES(:pname,:pcode,:qty,:stockprice,:totalcost,:transcode,:purchasedate,:updatedby)");  
          $stmt->bindParam(":pname", $pname,PDO::PARAM_STR);
          $stmt->bindParam(":pcode", $pcode,PDO::PARAM_STR) ;
          $stmt->bindParam(":qty", $qty,PDO::PARAM_STR) ;
          $stmt->bindParam(":stockprice", $stockprice,PDO::PARAM_STR) ;
          $stmt->bindParam(":totalcost", $totalcost,PDO::PARAM_STR);
          $stmt->bindParam(":transcode", $transcode,PDO::PARAM_STR) ;
          $stmt->bindParam(":purchasedate", $purchasedate,PDO::PARAM_STR) ;
          $stmt->bindParam(":updatedby", $updatedby,PDO::PARAM_STR) ;
            $stmt->execute(); 
          $sid=$db->lastInsertId();
  
          $db = null;
          //$_SESSION['r_id']=$rid;
          return true;
          
         }
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
          $db = null;
     }






/* Add to Cart */
     public function addCart($pname, $saleprice, $transcode, $qty, $totalcost, $datecreated, $status, $pid, $newpleft, $newpsold, $updatedby, $staff )
     {
          try{
          $db = getDB();
          $stmt = $db->prepare("UPDATE product SET pleft = :pleft, psold = :psold, dateupdated = :dateupdated, updatedby = :updatedby 
               WHERE pid = :pid");  
          $stmt->bindParam(":pleft", $newpleft,PDO::PARAM_STR);
          $stmt->bindParam(":psold", $newpsold,PDO::PARAM_STR);
          $stmt->bindParam(":dateupdated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":updatedby", $updatedby,PDO::PARAM_STR) ;
          $stmt->bindParam(":pid", $pid,PDO::PARAM_STR) ;
            
            $stmt->execute();
if($stmt->rowCount() > 0){
            
            $stmt = $db->prepare("INSERT INTO sale(pname,pid,qty,saleprice,totalcost,transcode,datecreated,status,staff) VALUES(:pname,:pid,:qty,:saleprice,:totalcost,:transcode,:datecreated,:status,:staff)");  
          $stmt->bindParam(":pname", $pname,PDO::PARAM_STR);
          $stmt->bindParam(":pid", $pid,PDO::PARAM_STR) ;
          $stmt->bindParam(":qty", $qty,PDO::PARAM_STR) ;
          $stmt->bindParam(":saleprice", $saleprice,PDO::PARAM_STR) ;
          $stmt->bindParam(":totalcost", $totalcost,PDO::PARAM_STR);
          $stmt->bindParam(":transcode", $transcode,PDO::PARAM_STR) ;
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":status", $status,PDO::PARAM_STR) ;
          $stmt->bindParam(":staff", $staff,PDO::PARAM_STR) ;
            $stmt->execute(); 
          $sid=$db->lastInsertId();
  
          $db = null;
          //$_SESSION['r_id']=$rid;
          return true;
          
         }
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
          $db = null;
     }


/* Add Hire */
     public function addHire($busno, $model, $avseats, $driver_assigned, $purpose, $location, $amount, $date_of_hire, $date_of_return, $status, $datecreated, $remark)
     {
          try{
          $db = getDB();
          $stmt = $db->prepare("INSERT INTO hire(bus_no,bus_model,available_seats,driver_assigned,date_of_hire,date_of_return,amount,purpose,location,status,datecreated,remark) VALUES(:bus_no,:busmodel,:available_seats,:driver_assigned,:date_of_hire,:date_of_return,:amount,:purpose,:location,:status,:datecreated,:remark)");  
          $stmt->bindParam(":bus_no", $bus_no,PDO::PARAM_STR);
          $stmt->bindParam(":bus_model", $model,PDO::PARAM_STR);
          $stmt->bindParam(":available_seats", $avseats,PDO::PARAM_STR);
          $stmt->bindParam(":driver_assigned", $driver_assigned,PDO::PARAM_STR);
          $stmt->bindParam(":date_of_hire", $date_of_hire,PDO::PARAM_STR);
          $stmt->bindParam(":date_of_return", $date_of_return,PDO::PARAM_STR);
          $stmt->bindParam(":amount", $amount,PDO::PARAM_STR);
          $stmt->bindParam(":purpose", $purpose,PDO::PARAM_STR);
          $stmt->bindParam(":location", $location,PDO::PARAM_STR) ;
          $stmt->bindParam(":status", $status,PDO::PARAM_STR);
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":remark", $remark,PDO::PARAM_STR) ;
            $stmt->execute();
          $hid=$db->lastInsertId();
  
          $db = null;
          $_SESSION['hire_id']=$hid;
          return true;
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }



     /* Assign Bus */
     public function assignBus($busno, $bus_model, $totalseats, $route, $route_id, $amount, $departuredate, $departuretime, $drivername, $terminal, $terminal_destination, $status, $datecreated, $remark, $driver_id, $busstatus)
     {
          try{
          $db = getDB();
          $stmt = $db->prepare("INSERT INTO availability(bus_no,bus_model,route_id,route,available_seats,total_seats,departuredate,departuretime,amount,driver_name,terminal_name,terminal_destination,status,datecreated,remark) VALUES(:bus_no,:bus_model,:route_id,:route,:available_seats,:total_seats,:departuredate,:departuretime,:amount,:driver_name,:terminal_name,:terminal_destination,:status,:datecreated,:remark)");  
          $stmt->bindParam(":bus_no", $busno,PDO::PARAM_STR);
          $stmt->bindParam(":bus_model", $bus_model,PDO::PARAM_STR);
          $stmt->bindParam(":route_id", $route_id,PDO::PARAM_STR);
          $stmt->bindParam(":route", $route,PDO::PARAM_STR);
          $stmt->bindParam(":available_seats", $totalseats,PDO::PARAM_STR);
          $stmt->bindParam(":total_seats", $totalseats,PDO::PARAM_STR);
          $stmt->bindParam(":departuredate", $departuredate,PDO::PARAM_STR);
          $stmt->bindParam(":departuretime", $departuretime,PDO::PARAM_STR);
          $stmt->bindParam(":amount", $amount,PDO::PARAM_STR);
          $stmt->bindParam(":driver_name", $drivername,PDO::PARAM_STR) ;
          $stmt->bindParam(":terminal_name", $terminal,PDO::PARAM_STR) ;
          $stmt->bindParam(":terminal_destination", $terminal_destination,PDO::PARAM_STR) ;
          $stmt->bindParam(":status", $status,PDO::PARAM_STR);
          $stmt->bindParam(":datecreated", $datecreated,PDO::PARAM_STR) ;
          $stmt->bindParam(":remark", $remark,PDO::PARAM_STR) ;
            $stmt->execute();
          $asb=$db->lastInsertId();
           
     
         $db = null;
          $_SESSION['av_id']=$asb;
          return true;


          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }



/* Assign Terminal Manager 
     public function assignTerminalmanager($terminal, $manager, $permission)
     {
          try{
          $db = getDB();
          $stmt = $db->prepare("UPDATE admin SET terminal=':terminal',permission=':permission' WHERE fullname=':fullname'");  
          $stmt->bindParam(":terminal", $terminal,PDO::PARAM_STR);
          $stmt->bindParam(":permission", $permission,PDO::PARAM_STR) ;
          $stmt->bindParam(":fullname", $manager,PDO::PARAM_STR) ;
            $stmt->execute();
          return true;
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }
*/











}



?>