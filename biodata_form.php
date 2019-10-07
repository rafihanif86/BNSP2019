<?php 
	include "connection.php";
    include "header_administrator.php";

    $id = $name = $noTelp = $email = $id_R= $edit = null;
    
    if(isset($_GET['edit']) and isset($_GET['id'])){
        $edit=$_GET['edit'];
        $id = $_GET['id'];
        $result=mysql_query("SELECT * FROM biodata WHERE id = $id ");
        while ($row1=mysql_fetch_array($result)){
            $name = $row1["name"];
            $email = $row1["email"];
            $noTelp = $row1["noTelp"];
            $id= $row1["id"];
        }
    }

    if(isset($_GET['name']) and isset($_GET['noTelp']) and isset($_GET['email'])){
        $name = $_GET['name'];
        $email = $_GET['email'];
        $noTelp = $_GET['noTelp'];
    }

    if(isset($_POST["reset"])){
        $id = $_POST["id"];
        $name=$_POST["name"];
        $email=$_POST["email"];
        $noTelp = $_POST["noTelp"];
        if($id != null){
            echo "
            <script>
                if (confirm('Do you want clean this form?')) {
                    location.replace('biodata_form.php');
                } else {
                    location.replace('biodata_form.php?edit=true&id=$id');
                }
            </script>";
        }else{
            echo "
            <script>
                if (confirm('Do you want clean this form?')) {
                    location.replace('biodata_form.php');
                } else {
                    location.replace('biodata_form.php?name=$name&noTelp=$noTelp&email=$email');
                }
            </script>";
        }
        
    }

    if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $noTelp = $_POST["noTelp"];
        $id = $_POST["id"];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($name and $noTelp and $email) != null){
                $query1="INSERT INTO biodata (name,noTelp,email) VALUES ('".$name."','".$noTelp."','".$email."');";
                $sql_insert1 = mysql_query($query1,$conn);
                echo "<script>alert('Data Berhasil Ditambahkan')
                location.replace('index.php')</script>";
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
        }else{
            $query1="UPDATE biodata set name = '$name',noTelp = '$noTelp', email = '$email' where id = $id;";
            $sql_insert1 = mysql_query($query1,$conn);
            echo "<script>alert('Data Berhasil Diubah')
                location.replace('index.php')</script>";
        }
    }

    if(isset($_POST["reset"])){
        $name = $email = $noTelp = null;
    }

    

?>
<SCRIPT LANGUAGE="JavaScript">
    if($id_vendor=null){
        document.frm.id1.hidden = "hidden";
        document.frm.id2.hidden = "hidden";
    }else{
        document.frm.id1.hidden = "";
        document.frm.id1.hidden = "";
    }
<!-- 	
function controlCK(str) {	
	document.frm.submit.disabled = !str;
}
//  End -->
</script>
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Form Biodata</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Biodata</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Form</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Biodata Form</strong> Elements
                                </div>
                                <div class="card-body card-block">
                                <form action="biodata_form.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label" class="id1">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $id; ?></p>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Enter Your Name" class="form-control" value="<?php echo $name; ?>"><small class="form-text text-muted">Please enter your name</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email </label></div>
                                            <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo $email; ?>"><small class="help-block form-text">Please enter your email</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone Number</label></div>
                                            <div class="col-12 col-md-9"><input type="number" id="phone" name="noTelp" placeholder="Enter Phone Number" class="form-control" value="<?php echo $noTelp; ?>"><small class="form-text text-muted">Please enter your phone number</small></div>
                                            <input type="text" id="edit" name="edit" hidden="hidden" value="<?php echo $edit; ?>">
                                            <input type="text" id="id" name="id" hidden="hidden" value="<?php echo $id; ?>">
                                        </div>
                                        
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-sm" name="reset">
                                            <i class="fa fa-ban"></i> Clean
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>

            </div><!-- .animated -->
        </div><!-- .content -->

    <div class="clearfix"></div>

    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2019 Admin BNSP
                </div>
                <div class="col-sm-6 text-right">
                    Designed by <a href="#">Peserta BNSP2019</a>
                </div>
            </div>
        </div>
    </footer>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
