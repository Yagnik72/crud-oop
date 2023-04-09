<?php

require 'db.php';

$db = new Database();

// Show Listing
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'view' ) {

    $output = '';
    $data = $db->read();
    $column = 1;
    if ( $db->totalRowCount() > 0 ) {
        $output .= '<table class="table table-striped table-sm table-bordered">
                  <thead class="text-center">
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </thead>
                  <tbody>';

        foreach ( $data as $row ) {
            $output .= ' <tr class="text-center text-secondary">
            <td>'.$row[ 'id' ].'</td>
            <td>'.$row[ 'first_name' ].'</td>
            <td>'.$row[ 'last_name' ].'</td>
            <td>'.$row[ 'email' ].'</td>
            <td>'.$row[ 'phone' ].'</td>
            <td>
              <a href="#" title="View Details" class="text-success infoBtn" id="'.$row[ 'id' ].'" ><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
              <a href="#" title="Edit Details" class="text-primary editBtn" id="'.$row[ 'id' ].'" data-toggle="modal" data-target="#editUserModel"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
              <a href="#" title="View Details" class="text-danger deleteBtn" id="'.$row[ 'id' ].'" ><i class="fas fa-trash fa-lg"></i></a>&nbsp;&nbsp;
            </td> ';
            $column++;
          }
          $output .= "</tbody>
          </table>";
    } else {
        $output .= "<h3 class='text-center text-secondary mt-5'>:( Not any user Found</h3>";
    }
    echo $output;
}

// insert data
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'insert' ) {
 
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  
  return $db->insert($fname, $lname, $email, $phone);
}

// edit data
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'edit' && $_POST[ 'edit_id' ]  != "" ) {

  $id = $_POST['edit_id'];
  
  $row = $db->getUserById($id);  
  echo json_encode($row);
}

// update data
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'update' ) {
 
  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  
  return $db->update($id, $fname, $lname, $email, $phone);
}

// delete data
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'delete' ) {

  $id = $_POST['delete_id'];
  
  return $db->delete($id);
}

// view data
if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'info' && $_POST[ 'info_id' ]  != "" ) {

  $id = $_POST['info_id'];
  
  $row = $db->getUserById($id);  
  echo json_encode($row);
}

// export data
if ( isset( $_GET[ 'export' ] ) && $_GET[ 'export' ] == 'excel' ) {
  header("Content-type: application/xls");
  header("Content-Disposition: attachment; filename=users.xls");
  header("Pragma: no-cache"); 
  header("Expires: 0");

  $data = $db->read();  

  echo '<table border="1">';
  //make the column headers what you want in whatever order you want
  echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr>';
  //loop the query data to the table in same order as the headers
  foreach ( $data as $row ) {
      echo "<tr><td>".$row['id']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td></tr>";
  }
  echo '</table>';

}