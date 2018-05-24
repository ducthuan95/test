<?php
    require_once "includes/connect.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM nhacungcap WHERE id = '$id' ";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) >0 ) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['id'];
                $name = $row['TenNCC'];
                $adress = $row['DiaChi'];
                $telephone = $row['SDT'];
                $Email = $row['Email'];
            }
        } else {
            header('Location:nhacc_list.php');
        }
    } else {
        header('Location:nhacc_list');
    }
    $error=" ";
    if(isset($_POST['submit']))
    {
        $name = $_POST['cate_name'];
        $adress = $_POST['adress'];
        $telephone = $_POST['telephone'];
        $Email = $_POST['Email'];
        $sql1="SELECT TenNCC FROM nhacungcap WHERE TenNCC='$name' AND id<>$id";
        $reslut2=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($reslut2)>0)
        {
            $error="Tên nhà cung cấp đã tồn tại";
        }else 
        {
            $sql3="UPDATE nhacungcap SET TenNCC ='$name', DiaChi = '$adress', SDT ='$telephone', Email = '$Email' WHERE id=$id";
        
            if(mysqli_query($conn,$sql3))
            {
            header('Location:nhacc_list.php');
            }        
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/head.php'; ?>
</head>

<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        <?php include 'includes/header.php'; ?>
        <?php include 'includes/slide.php'; ?>
        <div class="page-wrapper">
           <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Sửa Nhà Cung Cấp</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Sửa Nhà Cung Cấp</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="nhacc_edit.php?id=<?php echo $id; ?>" method="post">
                                    <p style = "color:red"><?=$error?></p>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Tên Nhà Cung Cấp <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" value="<?=$name?>" name="cate_name" placeholder="Tên Nhà Cung Cấp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Địa Chỉ <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" value="<?=$adress?>" name="adress" placeholder="Địa Chỉ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Số Điện Thoại <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" value="<?=$telephone?>" name="telephone" placeholder="Số Điện Thoại">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Email <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" value="<?=$Email?>" name="Email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="submit" class="btn btn-primary">Thêm Mới</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>

</body>

</html>