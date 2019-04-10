<?php

namespace App\Http\Controllers;

use App\Dealer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DealerController extends Controller
{
    function __construct()
    {

    }

    function index(Request $request)
    {
        if(!empty($request->search)){
            $dealers=Dealer::where('dealer_id','like','%'.$request->search."%")
                             ->orWhere('name','like','%'.$request->search."%")
                             ->orWhere('email','like','%'.$request->search."%")
                             ->orWhere('state','like','%'.$request->search."%")
                             ->orWhere('city','like','%'.$request->search."%")
                             ->orWhere('zip','like','%'.$request->search."%")
                             ->orWhere('address','like','%'.$request->search."%")
                             ->orWhere('lead_email','like','%'.$request->search."%")
                             ->orderBy('updated_at','desc')
                             ->paginate()->appends(['_token' => $request->_token,
                                                    'search' =>$request->search
                                                   ]);
        }
        else{
            $dealers=Dealer::orderBy('updated_at','desc')->paginate();
        }

        //dd($dealers);
        return view('admin/dealer/dealers',compact('dealers'));
    }

    function create()
    {
        return view('admin/dealer/adddealer');
    }

    function store(Request $request)
    {
        $request->validate([
            'dealer_id' => 'required|unique:dealer,dealer_id,NULL,id,deleted_at,NULL',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:dealer,email,NULL,id,deleted_at,NULL',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'fax' => 'required',
            'zip' => 'required',
            'website' => 'required',
        ]);

        $dealer = new Dealer;

        $dealer->dealer_id = $request->dealer_id;
        $dealer->name = $request->name;
        $dealer->phone = $request->phone;
        $dealer->email = $request->email;
        $dealer->address = $request->address;
        $dealer->state = $request->state;
        $dealer->city = $request->city;
        $dealer->zip = $request->zip;
        $dealer->fax = $request->fax;
        $dealer->website = $request->website;
        $dealer->ga_tag = $request->gatag;
        $dealer->google_conversion_id = $request->google_conversion_id;
        $dealer->google_conversion_label = $request->google_conversion_label;
        $dealer->is_featured =isset( $request->isfeatured)?1:0;
        $dealer->price_off = isset( $request->priceshow)?1:0;
		$dealer->trial_status =isset( $request->trial_status)?1:0;
        $dealer->client_status = isset( $request->client_status)?1:0;
        $dealer->feed_type =  $request->marketcheck;
        $dealer->call_tracking_no = $request->call_track_no??'';
        $dealer->lead_email =  $request->lead_email??'';
        $dealer->dealer_slug = str_slug($request->name);

        if($dealer->save()){
            return redirect('admin/dealers')->with('success', 'You have successfully added a new dealer.');
        }
        else{
            return redirect('admin/dealers')->with('fail', 'Oops! Something went wrong.');;
        }

    }

    function edit(Request $request,$id)
    {
        $dealer=Dealer::where('id',$id)->get();

        return view('admin/dealer/editdealer',compact('dealer'));
    }

    function update(Request $request)
    {

        $dealer=Dealer::find($request->id);
        if(!empty($request->dealer_id))
        $dealer->dealer_id = $request->dealer_id;
        $dealer->name = empty($request->name)?'car-dealer-solution':$request->name;
        $dealer->phone = empty($request->phone)?'car-dealer-solution-phone':$request->phone;
        $dealer->email = empty($request->email)?'car-dealer-solution-email':$request->email;
        $dealer->address = empty($request->address)?'car-dealer-solution-address':$request->address;
        $dealer->state = empty($request->state)?'car-dealer-solution-state':$request->state;
        $dealer->city = empty($request->city)?'car-dealer-solution-city':$request->city;
        $dealer->fax = empty($request->fax) ?'car-dealer-solution-fax':$request->fax;
        $dealer->zip = empty($request->zip) ?'car-dealer-solution-zip':$request->zip;
        $dealer->website = empty($request->website)?'car-dealer-solution-website':$request->website;
        $dealer->ga_tag = empty($request->gatag)?'':$request->gatag;
        $dealer->google_conversion_id = empty($request->google_conversion_id)?'':$request->google_conversion_id;
        $dealer->google_conversion_label = empty($request->google_conversion_label)?'':$request->google_conversion_label;
        $dealer->is_featured =isset( $request->isfeatured)?1:0;
        $dealer->price_off = isset( $request->priceshow)?1:0;
		$dealer->trial_status =isset( $request->trial_status)?1:0;
        $dealer->client_status = isset( $request->client_status)?1:0;
        $dealer->feed_type = $request->marketcheck;
        $dealer->call_tracking_no = empty($request->call_track_no)?'':$request->call_track_no;
        $dealer->lead_email =  $request->lead_email??'';
        $dealer->dealer_slug =  !empty($request->name)?str_slug($request->name):"car-dealer-solution-".$dealer->dealer_id;

        if($dealer->save()){
            return redirect('admin/dealers')->with('success', 'Successfully updated.');;
        }
        else{
            return redirect('admin/dealers')->with('fail', 'Oops! Something went wrong.');;
        }
    }

    function destroy(Request $request,$id){
        $dealer=Dealer::find($id);

        if($dealer->delete()){
            return redirect('admin/dealers')->with('success', 'The dealer account was removed successfully.');;
        }
        else{
            return redirect('admin/dealers')->with('fail', 'Oops! Something went wrong.');;
        }

    }

    function addDealerThroughApi(){
        $url = 'http://marketcheck-prod.apigee.net/v1/dealers?api_key=eEbgeVxClqDiiRElPfWg0UYPPDuocsWJ&latitude=43.1856307&longitude=-77.7565881&radius=100&limit=100';
        $client = new Client();
        $res = $client->get($url);
        $status = $res->getStatusCode(); // 200
        $response = $res->getBody();//
    }
}
