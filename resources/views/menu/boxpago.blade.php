 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('11',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-fuchsia-active">
                <div class="inner">
                  <h3>Pagos</h3>
                  <p>Cartera</p>
                </div>
                <div class="icon">
                  <i class="ion-cash"></i>
                </div>
                <a href="{{route('pago')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif