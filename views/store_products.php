<?php
/*
 * Created on Mon Nov 08 2021
 *
 *  Devlan - devlan.co.ke 
 *
 * hello@devlan.info
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2021 Devlan
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
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
checklogin();
/* Add Product  */

if (isset($_POST['add_product'])) {
    $product_id = $product_id;
    $product_name = $_POST['product_name'];
    $product_category_id = $_POST['product_category_id'];
    $product_wholesale_price = $_POST['product_wholesale_price'];
    $product_retail_price = $_POST['product_retail_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_access_level = $_SESSION['user_access_level'];

    $query = 'INSERT INTO products (product_id,product_name ,product_category_id,product_wholesale_price,product_retail_price,product_quantity,product_access_level)
    VALUES (?,?,?,?,?,?,?)';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssssss',
        $product_id,
        $product_name,
        $product_category_id,
        $product_wholesale_price,
        $product_retail_price,
        $product_quantity,
        $product_access_level

    );
    $stmt->execute();
    if ($stmt) {
        $success = "$product_name Details Added & Assigned To Store : $product_access_level ";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}

/* Update Product  */

if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_wholesale_price = $_POST['product_wholesale_price'];
    $product_retail_price = $_POST['product_retail_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_access_level = $_SESSION['user_access_level'];

    $query = 'UPDATE products SET
     product_name =? ,
     product_wholesale_price =?,
     product_retail_price =?,
     product_quantity =?, 
     product_access_level =?  
     WHERE product_id =?  ';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssss',

        $product_name,
        $product_wholesale_price,
        $product_retail_price,
        $product_quantity,
        $product_access_level,
        $product_id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "$product_name, Updated";
    } else {
        //inject alert that task failed
        $err = 'Please Try Again Or Try Later';
    }
}
require_once('../partials/head.php');
?>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?php require_once('../partials/store_header.php');
            ?>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                <div class="container-xl wide-lg">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-3">
                                    <div class="nk-block-head-content">
                                        <nav>
                                            <ul class="breadcrumb breadcrumb-arrow">
                                                <li class="breadcrumb-item"><a href="store_home">Home</a></li>
                                                <li class="breadcrumb-item active">Products</li>
                                            </ul>
                                        </nav>
                                        <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                            <div>
                                                <h2 class="nk-block-title fw-normal">Manage Product</h2>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                            </div>
                            <div class="text-right">
                                <a href="#add_modal" data-toggle="modal" class="btn btn-white btn-outline-light"><em class="icon ni ni-plus"></em><span>Register New Product</span></a>
                            </div>
                            <hr>
                            <!-- Add Modal -->
                            <div class="modal fade" id="add_modal">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Register New Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Product Name</label>
                                                            <input type="text" required name="product_name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Product Category Name</label>
                                                            <select name="product_category_id" class="form-select form-control form-control-lg" data-search="on">
                                                                <?php
                                                                $ret = "SELECT * FROM  product_categories";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($categories = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $categories->category_id; ?>"><?php echo $categories->category_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Purchase Price (Ksh)</label>
                                                            <input type="number" required name="product_wholesale_price" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Retail Sale Price (Ksh)</label>
                                                            <input type="number" required name="product_retail_price" class="form-control">
                                                        </div>
                                                        <?php
                                                                $ret = "SELECT * FROM  users WHERE user_id='$user_id'";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($user = $res->fetch_object()) {
                                                                ?>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Product Quantity</label>
                                                            <input type="number" required name="product_quantity" class="form-control">
                                                            <input type="text" hidden required name="product_access_level" value ="<?php echo $user->user_access_level?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add_product" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-block">
                                <div class="card card-bordered card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Category</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Quantity</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Purchase Price</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Retail Price</span></th>
                                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                                                <span class="sub-text">Action</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $store = $_SESSION['user_access_level'];
                                                        $ret = "SELECT * FROM  products p INNER JOIN product_categories pc
                                                            ON pc.category_id = p.product_category_id AND p.product_access_level = '$store'  ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($products = $res->fetch_object()) {
                                                        ?>
                                                            <tr class="nk-tb-item">
                                                                <td class="nk-tb-col tb-col-mb">
                                                                    <span class="tb-amount"><?php echo $products->product_name; ?></span>
                                                                </td>
                                                                <td class="nk-tb-col tb-col-mb">
                                                                    <span class="tb-amount"><?php echo $products->category_name; ?></span>
                                                                </td>
                                                                <td class="nk-tb-col tb-col-mb">
                                                                    <span class="tb-amount"><?php echo $products->product_quantity; ?></span>
                                                                </td>
                                                                <td class="nk-tb-col tb-col-mb">
                                                                    <span class="tb-amount">Ksh <?php echo $products->product_wholesale_price; ?></span>
                                                                </td>
                                                                <td class="nk-tb-col tb-col-mb">
                                                                    <span class="tb-amount">Ksh <?php echo $products->product_retail_price; ?></span>
                                                                </td>

                                                                <td class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <div class="drodown">
                                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li><a data-toggle="modal" href="#update-<?php echo $products->product_id; ?>"><em class="icon ni ni-edit"></em><span>Update</span></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <!-- Edit Profile Modal -->
                                                                <div class="modal fade" id="update-<?php echo $products->product_id; ?>">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Update <?php echo $products->product_name; ?></h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form method="post" enctype="multipart/form-data" role="form">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-md-12">
                                                                                                <label for="">Product Name</label>
                                                                                                <input type="text" value="<?php echo $products->product_name; ?>" required name="product_name" class="form-control">
                                                                                                <input type="hidden" value="<?php echo $products->product_id; ?>" required name="product_id" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Purchase Price (Ksh)</label>
                                                                                                <input type="number" value="<?php echo $products->product_wholesale_price; ?>" required name="product_wholesale_price" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Retail Sale Price (Ksh)</label>
                                                                                                <input type="number" required value="<?php echo $products->product_retail_price; ?>" name="product_retail_price" class="form-control">
                                                                                            </div>
                                                                                            <div class="form-group col-md-4">
                                                                                                <label for="">Product Quantity</label>
                                                                                                <input type="number" required value="<?php echo $products->product_quantity; ?>" name="product_quantity" class="form-control">
                                                                                                <input type="text" hidden required name="product_access_level" value ="<?php echo $user->user_access_level?>" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="text-right">
                                                                                        <button type="submit" name="update_product" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Modal -->
                                                            </tr>
                                                        <?php } }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <?php require_once('../partials/staff_footer.php'); ?>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>