 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('10',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-fuchsia-active">
                <div class="inner">
                  <h3>Refacturación</h3>
                  <p>Facturación</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-paper-outline"></i>
                </div>
                <a href="{{route('ref')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif