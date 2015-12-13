 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('5',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>Radicación</h3>
                  <p>Cartera</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-checkmark-outline"></i>
                </div>
                <a href="{{route('rad')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif