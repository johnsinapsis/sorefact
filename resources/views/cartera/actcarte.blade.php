  <section class="col-lg-5 connectedSortable">
               <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                 
                  <i class="fa fa-television"></i>
                  <h3 class="box-title">
                    Total Cartera
                  </h3>
                </div>
                <div class="box-body">
                  <div  style="height: 250px; width: 100%;">
                    
                    Totaliza solo facturas que se encuentren en estado radicado
                    <div class="jumbotron" style = "height:240px; background-color:black;" align="center">
                      <h4><strong>Cartera al día de Hoy</strong></h4>
                      <h1><strong>{{number_format($cartera->totcarte())}}</strong></h1> 
                      <strong> 
                         </strong>
                    </div>
                    
                  </div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border bg-light-blue-gradient">
                 
                </div>
              </div>
              <!-- /.box -->
   </section>