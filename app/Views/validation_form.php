<html>
<head>
    <title>RumahCode.org Register Form Validation</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
    <style>
    .note
    {
        text-align: center;
        height: 80px;
        background: -webkit-linear-gradient(left, #0072ff, #8811c5);
        color: #fff;
        font-weight: bold;
        line-height: 80px;
    }
    .form-content
    {
        padding: 5%;
        border: 1px solid #ced4da;
        margin-bottom: 2%;
    }
    .form-control{
        border-radius:1.5rem;
    }
    .btnSubmit
    {
        border:none;
        border-radius:1.5rem;
        padding: 1%;
        width: 20%;
        cursor: pointer;
        background: #0062cc;
        color: #fff;
    }
</style>
</head>
<body>
	<form method="post">
		<div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>
                      Contoh Validasi Form Pendaftaran Menggunakan Bootstrap dan codeigniter 4
                  </p>
              </div>

              <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="User ID" value=""  id="UserId" name="UserId"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama User" value=""  id="NamaUser" name="NamaUser"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="E-Mail" value=""  id="EMail" name="EMail"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" value=""  id="Password" name="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Konfirmasi Password" value=""  id="KonfirmasiPassword" name="KonfirmasiPassword"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Umur" value=""  id="Umur" name="Umur"/>
                    </div>
                </div>
                <div class="col-md-6">
                 <?= $validation->listErrors() ?>
             </div>
         </div>
         <button type="submit" class="btnSubmit">Daftar</button>
     </div>
 </div>
</div>
</form>
</body>
</html>