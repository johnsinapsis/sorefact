 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('8',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Configuración</h3>
                  <p>Facturación</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-gear"></i>
                </div>
                <a href="{{route('config')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif