<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
 

//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$slider= Slider::find()->where(['isDeleted' => '0',"estatus"=>"Activo"])->orderBy(["orden" => SORT_ASC])->limit(7)->all();
//News::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_DESC])->limit(100)->all();
$this->title = 'SAE - Sistema Administrativo Contable';
?>
 
 

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   



        <!-- Begin Page Content -->

        <div class="container-fluid">



          <!-- Page Heading -->

          <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h5 mb-0 text-gray-800">Buzón</h1>

            
          </div>



          

          <!-- Content Row -->



          <div class="row">


          Página Temporalmente no disponible.



            

          </div>



         

      <!-- End of Main Content -->



      <!-- Footer -->

      <footer class="sticky-footer bg-white">

        <div class="container my-auto">

          <div class="copyright text-center my-auto">

            <span>Copyright &copy; ACEP SISTEMAS 2020</span>

          </div>

        </div>

      </footer>

      <!-- End of Footer -->



    </div>

    <!-- End of Content Wrapper -->



  </div>

  <!-- End of Page Wrapper -->



  <!-- Scroll to Top Button-->

  <a class="scroll-to-top rounded" href="#page-top">

    <i class="fas fa-angle-up"></i>

  </a>



  <!-- Logout Modal-->

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>

          <button class="close" type="button" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">×</span>

          </button>

        </div>

        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <a class="btn btn-primary" href="login.html">Logout</a>

        </div>

      </div>

    </div>

  </div>



  <!-- Button trigger modal -->

 

  <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Búsqueda de productos</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        ...

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <button type="button" class="btn btn-primary">Agregar</button>

      </div>

    </div>

  </div>

</div>

 
<style>

 
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  display: flex;
  align-items: center;
}

.tableFixHead          { overflow-y: auto; height: 400px; }
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }

#cliente

{

  -moz-appearance:textfield;

  -webkit-appearance: none; 

}



#cliente::-webkit-inner-spin-button, 

#cliente::-webkit-outer-spin-button { 

  -webkit-appearance: none; 

  margin: 0; 

}

  </style>

  



  <!-- Bootstrap core JavaScript-->

  <script src="<?= URL::base() ?>/vendor/jquery/jquery.min.js"></script>

  <script src="<?= URL::base() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  

  <!-- Core plugin JavaScript-->

  <script src="<?= URL::base() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  

  

  <!-- Custom scripts for all pages-->

  <script src="<?= URL::base() ?>/js/sb-admin-2.min.js"></script>

  

  <!-- Page level plugins -->

  <script src="<?= URL::base() ?>/vendor/chart.js/Chart.min.js"></script>

  

  <!-- Page level custom scripts -->

  <script src="<?= URL::base() ?>/js/demo/chart-area-demo.js"></script>

  <script src="<?= URL::base() ?>/js/demo/chart-pie-demo.js"></script>

  

  <script src="<?= URL::base() ?>/js/plugins/bootstrap3-typeahead.min.js"></script>

  <script src="<?= URL::base() ?>/js/print.min.js"></script>



  

 
  
</body>



</html>