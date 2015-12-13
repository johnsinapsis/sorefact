 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('2',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Liquidación</h3>
                  <p>Facturación</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calculator"></i>
                </div>
                <a href="{{route('liq')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif