<?php
/*
 * Created on Tue Jan 04 2022
 *
 *  Devlan - devlan.co.ke 
 *
 * hello@devlan.info
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2022 Devlan
 *
 * 1. GRANT OF LICENSE
 * Devlan hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from Devlan. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from Devlan.
 *
 * 2. COPYRIGHT 
 * The Software is owned by Devlan and protected by copyright law and international copyright treaties. 
 * You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 * 3. RESTRICTIONS ON USE
 * You may not, and you may not permit others to
 * (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 * (b) modify, distribute, or create derivative works of the Software;
 * (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 * otherwise exploit the Software.  
 *
 * 4. TERM
 * This License is effective until terminated. 
 * You may terminate it at any time by destroying the Software, together with all copies thereof.
 * This License will also terminate if you fail to comply with any term or condition of this Agreement.
 * Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 * 5. NO OTHER WARRANTIES. 
 * Devlan  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * Devlan SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 * EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 * SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 * ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 * INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 * SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 * THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 * HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 * 6. SEVERABILITY
 * In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 * affect the validity of the remaining portions of this license.
 *
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL DEVLAN  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF DEVLAN HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL DEVLAN  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */
session_start();
require_once('../partials/head.php');
require_once('../config/codeGen.php');
require_once('../config/config.php');
if (isset($_POST['add_room'])) {
    $room_id = $room_id;
    $room_number = $_POST['room_number'];
    $room_price = $_POST['room_price'];

    $query = 'INSERT INTO rooms(room_id, room_number, room_price)
         VALUES (?,?,?)';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sss',
        $room_id,
        $room_number,
        $room_price
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Room added";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Update Room */

/* Delete Room */

?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/nav.php'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Rooms </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rooms</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="container-fluid">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal">Add Room</button>
                        </div>
                        <hr>
                        <!-- Add Modal -->
                        <div class="modal fade" id="add_modal">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Fill All Values </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Room Number</label>
                                                        <input type="text" required name="room_number" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Room Rate (Price)</label>
                                                        <input type="text" required name="room_price" class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="add_room" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        <div class="row">
                            <div class="col-12">
                                <table id="" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Room Number</th>
                                            <th>Room Price</th>
                                            <th>Room Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM rooms";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($room = $res->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $room->room_number; ?></td>
                                                <td><?php echo $room->room_price; ?></td>
                                                <td><?php echo $room->room_status; ?></td>
                                                <td>
                                                    <a class="badge badge-primary" data-toggle="modal" href="#edit-<?php echo $room->room_id; ?>">
                                                        <i class="fas fa-edit"></i>
                                                        Update
                                                    </a>
                                                    <!-- Update Modal -->
                                                    <div class="modal fade" id="edit-<?php echo $room->room_id; ?>">
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Fill All Values </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Room Number</label>
                                                                                    <input type="hidden" value="<?php echo $room->room_id; ?>" required name="room_id" class="form-control">
                                                                                    <input type="text" value="<?php echo $room->room_number; ?>" required name="room_number" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Room Rate (Price)</label>
                                                                                    <input type="text" value="<?php echo $room->room_price; ?>" required name="room_price" class="form-control">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="update_room" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <a class="badge badge-danger" data-toggle="modal" href="#delete-<?php echo $room->room_id; ?>">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Delete Moda -->
                                                    <div class="modal fade" id="delete-<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST">
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $room->room_number; ?></h4>
                                                                        <br>
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" name="room_id" value="<?php echo $room->room_id; ?>">
                                                                        <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                        <input type="submit" name="delete" value="Delete" class="text-center btn btn-danger">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php require_once('../partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>