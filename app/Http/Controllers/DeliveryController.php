<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{

    public function admin_test_login_admin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin_revenue_statistical');
        }
        else{
            return Redirect::to('/')->send();

        }
    }

    public function admin_add_delivery(){
        $this->admin_test_login_admin();
        $province = Province::orderBy('province_id','ASC')->get();
        return view('admin.delivery.admin_add_delivery')
                    ->with('province',$province);
    }

    public function admin_select_delivery(Request $request){  //chọn thành phố
        $this->admin_test_login_admin();
        $data = $request->all();
        if($data['action']){
            $show = '';
            if($data['action']=="province"){
                $select_district = District::where('province_id',$data['id'])->orderBy('district_id','ASC')->get();
                $show.='<option>--Chọn quận huyện--</option>';
                foreach($select_district as $key => $district)
                    $show.='<option value="'.$district->district_id.'">'.$district->district_name.'</option>';
            }else{
                $select_ward = Ward::where('district_id',$data['id'])->orderBy('ward_id','ASC')->get();
                $show.='<option>--Chọn xã phường--</option>';
                foreach($select_ward as $key => $ward)
                    $show.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
            }
        }
        echo $show;
    }

    public function admin_submit_add_delivery(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $delivery = new Delivery();
        $delivery->province_id = $data['province']; //data bên ajax logout
        $delivery->district_id = $data['district'];
        $delivery->ward_id = $data['ward'];
        $delivery->delivery_fee = $data['fee'];
        $delivery->save();

    }

    public function admin_list_delivery(){
        $this->admin_test_login_admin();
        $n=1;
        $delivery = Delivery::orderBy('delivery_id','DESC')->get();
        $show = '';
        $show.='
            <div class=row>
                <div id="man" class="col">
                    <div class="card">
                        <table class="m-3" id="datatable">
                            <thead>
                                <tr class="text-dark">
                                    <th class="text-center">STT</th>
                                    <th class="pl-2 text-center">Thành phố</th>
                                    <th class="pl-2 text-center">Quận - Huyện</th>
                                    <th class="pl-2 text-center">Xã - Phường - Thị trấn</th>
                                    <th class="pl-2 text-center">Phí vận chuyển</th>
                                </tr>
                            </thead>
                            <tbody>';
                                foreach ($delivery as $key => $show_delivery){
                                    $show.='
                                    <tr>
                                        <td class="text-center">'.$n++.'</td>
                                        <td class="text-center">'.$show_delivery->province->province_name.'</td>
                                        <td class="text-center">'.$show_delivery->district->district_name.'</td>
                                        <td class="text-center">'.$show_delivery->ward->ward_name.'</td>
                                        <td contenteditable data-delivery_id="'.$show_delivery->delivery_id.'" class="edit_fee_delivery text-center">'.number_format($show_delivery->delivery_fee, 0, ',', '.').'</td>
                                    </tr>';
                                }$show.='
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>';
        echo $show;                     /* ->province bên model delivery */
    }

    public function admin_edit_delivery(Request $request){
        $this->admin_test_login_admin();
        $data = $request->all();
        $delivery = Delivery::find($data['delivery_id']);
        $delivery_money = rtrim($data['delivery_money'],'.'); //data bên ajax logout
        $delivery->delivery_fee = $delivery_money;
        $delivery->save();
    }

//END ADMIN




//CLIENT
    public function client_select_delivery(Request $request){  //chọn thành phố
        $data = $request->all();
        if($data['action']){
            $show = '';
            if($data['action']=="province"){
                $select_district = District::where('province_id',$data['id'])->orderBy('district_id','ASC')->get();
                $show.='<option style="text-align: start">--Chọn quận huyện--</option>';
                foreach($select_district as $key => $district)
                    $show.='<option value="'.$district->district_id.'" style="text-align: start">'.$district->district_name.'</option>';
            }else{
                $select_ward = Ward::where('district_id',$data['id'])->orderBy('ward_id','ASC')->get();
                $show.='<option style="text-align: start">--Chọn xã phường thị trấn--</option>';
                foreach($select_ward as $key => $ward)
                    $show.='<option value="'.$ward->ward_id.'" style="text-align: start">'.$ward->ward_name.'</option>';
            }
        }
        echo $show;
    }

    public function client_submit_delivery(Request $request){
        $data = $request->all();
        if($data['province_id']){
            $delivery = Delivery::with('province')->with('district')->with('ward')
                                ->where('province_id',$data['province_id'])
                                ->where('district_id',$data['district_id'])
                                ->where('ward_id',$data['ward_id'])
                                ->get();
            foreach ($delivery as $key => $fee_delivery) {
                Session::put('fee_delivery',$fee_delivery->delivery_fee);
                Session::put('id_province',$fee_delivery->province_id);
                Session::put('name_province',$fee_delivery->province->province_name);
                Session::put('id_district',$fee_delivery->district_id);
                Session::put('name_district',$fee_delivery->district->district_name);
                Session::put('id_ward',$fee_delivery->ward_id);
                Session::put('name_ward',$fee_delivery->ward->ward_name);
                Session::save();
            }
        $info_order_address = $data['info_order_address'];
        session::put('info_order_address',$info_order_address);
        }
    }
}
