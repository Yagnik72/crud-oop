<!DOCTYPE html>
<html lang="en">

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD OOps</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- DataTables BS_4 - CSS -->
  <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />
</head>

<body> 

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"> <i class="fab fa-wolf-pack-battalion"></i>&nbsp;Navbar</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="text-center text-danger font-weight-normal my-3">CRUD using OOps</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <h4 class="mt-2 text-primary">All users in database</h4>
      </div>
      <div class="col-lg-6">
        <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addUserModel"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;
          Add New User</button>
        <a href="http://localhost/php/crud_oops/action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-lg fa-table fa-lg"></i> Export To Excel</a>
      </div>
    </div>
    <hr class="my-1">

    <div class="row">
      <div class="col-lg-12 ">
        <div class="table-responsive p-1" id="showUser">
          <!-- ajax View come -->
          <h3 class="text-center text-success" style="margin-top:150px">Loading....</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Add new User Modal -->
  <div class="modal fade" id="addUserModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModelLongTitle">Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body px-4">
          <form action="" method="post" id="form-data">
            <div class="form-group">
              <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="form-group">
              <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="form-group">
              <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="Add User">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit User Modal -->
  <div class="modal fade" id="editUserModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModelLongTitle">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body px-4">
          <form action="" method="post" id="edit-form-data">
            <div class="form-group">
              <input type="hidden" name="id" id="id">
              <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
            </div>
            <div class="form-group">
              <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone" required>
            </div>
            <div class="form-group">
              <input type="submit" name="insert" id="update" class="btn btn-primary btn-block" value="Update User">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

  <!-- jQuery - Ajax -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <!-- DataTables BS_4 -->
  <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>

  <!-- https://sweetalert2.github.io/#download:~:text=Or%20grab%20from%20jsdelivr%20CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function(){
      var ajaxUrl = "../action.php";

      showAllUsers()
      function showAllUsers(){
        $.ajax({
          url: ajaxUrl,
          type: "POST",
          data: {action:'view'},
          success: function(response){
            $('#showUser').html(response)
            $('table').DataTable({
              order: [0, 'desc']
            });
          }
        });
      }

      // insert ID
      $('#insert').click(function(e){
        if($('#form-data')[0].checkValidity()){
          e.preventDefault();
          $.ajax({
          url: ajaxUrl,
          type: "POST",
          data: $('#form-data').serialize()+"&action=insert",
          success: function(response){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User Added Successfully!',
                showConfirmButton: true
              })
              $('#addUserModel').modal('hide')
              $('#form-data').trigger('reset')
              showAllUsers()
          }
        });
        }
      });

      // Edit ID
      $('body').on( "click", '.editBtn', function(e){
          e.preventDefault();
          edit_id = $(this).attr('id');

            $.ajax({
              url: ajaxUrl,
              type: "POST",
              data: {
                edit_id: edit_id,
                action: 'edit'
              },
              success: function(response){
                data = JSON.parse(response);
                $('#editUserModel #id').val(data.id)
                $('#editUserModel #fname').val(data.first_name)
                $('#editUserModel #lname').val(data.last_name)
                $('#editUserModel #email').val(data.email)
                $('#editUserModel #phone').val(data.phone)
              }  
            });
      });

      // Update ID
      $('#update').click(function(e){
        if($('#edit-form-data')[0].checkValidity()){
          e.preventDefault();
          $.ajax({
          url: ajaxUrl,
          type: "POST",
          data: $('#edit-form-data').serialize()+"&action=update",
          success: function(response){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User updated Successfully!',
                showConfirmButton: true
              })
              $('#editUserModel').modal('hide')
              $('#edit-form-data').trigger('reset')
              showAllUsers()
          }
        });
        }
      });

      // Delete User
      $("body").on("click", ".deleteBtn", function (e) {
        e.preventDefault();

        var tr = $(this).closest("tr")
        delete_id = $(this).attr("id")

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {

            $(tr).css('background-color', '#ff6666');

            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )

            $.ajax({
              url: ajaxUrl,
              type: "POST",
              data: {
                delete_id: delete_id,
                action: "delete"
              },
              success: function (response) {
                $(tr).hide();
              }
            })
          }
        })

      })

      // View User
      $('body').on("click", ".infoBtn", function(e){
        e.preventDefault();
        info_id = $(this).attr("id")
          $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: {
              info_id: info_id,
              action: 'info'
            },
            success: function(response){
              data = JSON.parse(response);
              $('#editUserModel #id').val(data.id)
              $('#editUserModel #fname').val(data.first_name)
              $('#editUserModel #lname').val(data.last_name)
              $('#editUserModel #email').val(data.email)
              $('#editUserModel #phone').val(data.phone)

              Swal.fire({
                title: '<strong>User Info: ID('+data.id+')</strong>',
                type: 'info',
                html: '<b>First Name: </b>'+data.first_name+'<br><b>Last Name: </b>'+data.last_name+'<br>'+
                      '<b>Email: </b>'+data.email+'<br><b>Phone: </b>'+data.phone,
                showCancelButton: true
              });
            }  
          });
      });

    })
  </script>
</body>

</html>